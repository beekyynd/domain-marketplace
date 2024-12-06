<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'reference', 'amount', 'description', 'owner_id', 'finished'];

public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}

}
