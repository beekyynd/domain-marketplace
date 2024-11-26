<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'id', 'price', 'tags', 'keywords', 'logo_url', 'commission'];

    protected $primaryKey = 'domain_id';

}
