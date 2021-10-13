<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Personnel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commandes()
    {
       return $this->hasMany(Commande::class);
    }

}
