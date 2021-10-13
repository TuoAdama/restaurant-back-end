<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    use HasFactory;

    public function plat()
    {
        return $this->hasMany(Plat::class);
    }


}
