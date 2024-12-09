<?php

namespace App\Http\Controllers;

use App\Models\Domain;

use Illuminate\Http\Request;

use App\Http\Requests\StoreDomainRequest;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
       
        $domains = Domain::where('status','available')->get(); 
 
        return view('index', compact('domains'));

    }

    /**
     * Show user stats.
     */

     public function dashboard()

     {
        $userid = Auth::id(); // get user id

        $stats = Domain::where('id',$userid)->get(); // get domains associated with user

        return view('dashboard.overview', compact('stats'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created domain
     */
    public function store(StoreDomainRequest $request)
    {

        $domain = Domain::where('url', $request->url)->first();

        if($domain) {

            return redirect()->back()->withErrors(['error' => 'Domain already exists']);
        }

        Domain::create($request->validated()); 
 
        return redirect()->route('dashboard.domains');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {

    
        return view('domains.show', compact('domain'));

    }

    /**
     * Browse domains
     */

     public function browse()

     {
 
         // filter based on user selection
 
         if (request('type') ==="short" || request('type') ==="premium" || request('type') ==="all") {

             $domains = Domain::where('status','available')->get(); 

         }

         else {

            abort(403);
         }
  
         return view('domains.browse-domains', compact('domains'));
 
     }
 

    /**
     * Display domains from search
     */

     public function search(Request $request)
     {

         $search = $request->query('search');

         if (empty($search)) {

            abort(403);
         }

         $request->validate([

            'search' => 'required|string|max:7',
         ],
         [
            'search.max' => 'Sorry! You can only enter a string of 7 characters',
         ]
         
         );
 
         $domains = Domain::where('url', 'like', '%' . $search . '%')->where('status', 'available')->get(); 
 
         return view('domains.search', compact('domains', 'search'));
 
     }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {

        $userid = Auth::id(); // get user id

        if($userid != $domain->id) {

            abort(401, 'Unauthorized access'); // unathorized resource
        }

        if($domain->status ==="sold") {

            abort(401, 'Unauthorizes access'); // unathorized resource
        }

        return view('dashboard.edit-domain', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain)
    {

        $domain = Domain::where('url', $domain->url)->first();

        $update = Domain::where('url', $domain->url);

        $keywords = $request->input('keywords');

        $key = config('services.gpt.key');

        $api_url = "https://api.openai.com/v1/chat/completions";

$headers = array(

    "Content-Type: application/json",
    "Authorization: Bearer $key"
);

$data = array(

    "model" => "gpt-3.5-turbo",
    "messages" => array(
        array("role" => "system", "content" => "You are an assistant who speaks English."),
        array("role" => "user", "content" => "Give me 2 best uses for the domain name $domain->url in a numbered list, formatted in HTML. Each list should have at minimum of 100 words and do not use the word lastly in the final list. Immediately begin with the list and nothing else. Use line breaks and each heading should be bolded. It must be formatted in HTML")
    )
);

$ch = curl_init($api_url);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

$result = json_decode($response, true);


        $request->validate([

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($domain->ideas !="") {

            $idea = $domain->ideas;
    
            }
    
            else {
    
            $idea = $result['choices'][0]['message']['content'];
    
            }

        if($domain->price !="") {

        $price = $domain->price;

        }

        else {

        $price = $request->input('price');

        }

        if(!empty($request->input('tag'))) {

            $tags = implode(",", $request->input('tag'));

        }

        else {

            $tags = $domain->tags;
        }

        // Check if a new logo file is uploaded

        if ($request->hasFile('logo')) {

            // Delete the old logo if it exists (optional)

            if ($domain->logo_url && Storage::exists($domain->logo_url)) {

                Storage::delete($domain->logo_url);
            }

            // Store the new logo and get its path

            $logoPath = $request->file('logo')->store('domains', 'public');

            // Update the domain logo with the new path

        }

        else {

            $logoPath = $domain->logo_url;
        }

        $update->update([
            'tags' => $tags,
            'keywords' => $keywords,
            'price' => $price,
            'ideas' =>$idea,
            'logo_url' => $logoPath,
        ]);

        return redirect()->route('dashboard.domains')->with('status','updated'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {

        $checkAuth = Domain::where('url', $domain->url)->first();

        if(Auth::id() !== $checkAuth->id) {

            abort(401);
        }

        $domain = Domain::where('url', $domain->url);

        $domain->delete();
 
        return redirect()->route('dashboard.domains')->with('status','deleted');
    }
}
