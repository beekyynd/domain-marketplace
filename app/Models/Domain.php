<?php

namespace App\Models;

use App\Domains;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getFillable()
    {
        
        if (Auth::check() && Auth::user()->is_admin) {

            return ['url', 'id', 'price', 'tags', 'owner', 'keywords', 'status', 'verified', 'logo_url', 'ideas'];
        }

        return ['url', 'id', 'price', 'tags', 'owner', 'keywords', 'logo_url', 'commission', 'ideas'];

    }

        public function fill(array $attributes)

        {
            $this->fillable = $this->getFillable();

            return parent::fill($attributes);
        }

    protected $primaryKey = 'domain_id';

    protected $casts = [

        'status' => Domains::class,
    ];

}
