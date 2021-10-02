<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableClient extends Model
{

    protected $guarded = ['id'];

    use HasFactory;
    
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
