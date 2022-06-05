<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Database\Seeder;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etats = ['EN COURS','PRET'];

        foreach ($etats as $etat) {
            $et = Etat::where('libelle', $etat)->first();
            if($et == null){
                Etat::create(['libelle' => $etat]);
            }
        }
    }
}
