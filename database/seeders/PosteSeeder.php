<?php

namespace Database\Seeders;

use App\Models\Poste;
use Illuminate\Database\Seeder;

class PosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postes = ['SERVEUR', 'GESTIONNAIRE'];

        foreach ($postes as  $poste) {
            $p = Poste::where('libelle', $poste)->first();
            if($p == null){
                Poste::create(['libelle' => $poste]);
            }
        }
    }
}
