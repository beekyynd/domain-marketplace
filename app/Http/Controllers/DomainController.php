<?php

namespace App\Http\Controllers;

use App\Models\Domain;

use Illuminate\Http\Request;

use App\Http\Requests\StoreDomainRequest;

use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
       
        $domains = Domain::all(); 
 
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
     * Store a newly created resource in storage.
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
 
         $domains = Domain::where('url', 'like', '%' . $search . '%')->get(); 
 
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

        $tags = $domain->tags;

        $keywords = $request->input('keywords');

        $logo = $request->input('logo');

        if($domain->price !="") {

        $price = $domain->price;

        $commission = $domain->commission;

        }

        else {

        $price = $request->input('price');

        $commission = 0.1 * $price;

        }

        if(!empty($request->input('tag'))) {

            $tags = implode(",", $request->input('tag'));
        }

        if($request->input('logo') ==="") {

            $logo = $domain->logo_url;
        }

        $update->update([
            'tags' => $tags,
            'keywords' => $keywords,
            'price' => $price,
            'commission' => $commission,
            'logo_url' => $logo,
        ]);

        return redirect()->route('dashboard.domains')->with('success','Domain updated successfully'); 
    
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
 
        return redirect()->route('dashboard.domains')->with('success','Domain deleted successfully');
    }
}
