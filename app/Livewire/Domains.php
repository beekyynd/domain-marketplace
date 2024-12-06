<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Domain;

use Illuminate\Support\Facades\Auth;

class Domains extends Component
{

    public string $filter = "";

    public string $search = "";

    public function render()
    {
        
        $domains = Domain::where('id', Auth::id())->when($this->filter !=="", function($query) {
            
            $query->where('id', Auth::id())->where('status', $this->filter);
        
        })->when($this->search !=="", function($query) {
            
            $query->where('id', Auth::id())->where('url', 'like', '%' . $this->search . '%');
        
        })->orderBy('domain_id','desc')->paginate(5); // get domains associated with user
         
        return view('livewire.domains', ['domains' => $domains]);
    }

}

