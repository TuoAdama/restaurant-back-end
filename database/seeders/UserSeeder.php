<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\Poste;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'nom' => 'Tuo',
                'prenom' => 'Adama',
                'email' => 'tuoadama@gmail.com',
                'password' => 'tuoadama',
                'role_id' => 1,
                'sexe' => 'M',
                'poste' => 'GESTIONNAIRE',
                'date_de_naissance' => '1998-06-28',
            ]
        ];


        foreach ($data as $personnel) {

            $user = User::where('email', $personnel['email'])->first();

            if ($user == null) {

                $nom = $personnel['nom'];
                $prenom = $personnel['prenom'];
                $user = User::create([
                    'name' => $nom . ' ' . $prenom,
                    'email' => $personnel['email'],
                    'avatar' => 'users/default.png',
                    'password' => Hash::make($personnel['password']),
                ]);

                $pers = new Personnel();
                $pers->nom = $nom;
                $pers->prenom = $prenom;
                $pers->sexe = $personnel['sexe'];
                $pers->date_de_naissance = $personnel['date_de_naissance'];

                $pers->poste_id = Poste::where('libelle', $personnel['poste'])->first()->id;
                $pers->user_id = $user->id;

                $pers->save();

            }
        };
    }
}
