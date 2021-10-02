<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }

    public function commandes()
    {
       return $this->hasMany(Commande::class);
    }

}
