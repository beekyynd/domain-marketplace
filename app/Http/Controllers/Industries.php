<?php

namespace App\Http\Controllers;

use App\Models\Domain;

class Industries extends Controller
{

    /**
     * Display domains in industry
     */

    public function show($tag)
    {

        $domains = Domain::where('tags', 'like', '%' . $tag . '%')->where('status', 'available')->get(); 

        $count = Domain::where('tags', 'like', '%' . $tag . '%')->where('status', 'available')->count(); 

        return view('domains.industries', compact('domains', 'tag', 'count'));

    }


}
