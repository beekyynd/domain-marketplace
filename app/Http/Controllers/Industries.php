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

        $domains = Domain::where('tags', 'like', '%' . $tag . '%')->get(); 

        $count = Domain::where('tags', 'like', '%' . $tag . '%')->count(); 

        return view('domains.industries', compact('domains', 'tag', 'count'));

    }


}
