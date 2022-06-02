@extends('layouts.base', ['title' => 'Commandes'])

@section('content')
    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Date</th>
                <th>Table</th>
                <th scope="col">Images</th>
                <th scope="col">Plats</th>
                <th scope="col">Quantite</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($commandes as $commande)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{$commande->created_at}}</td>
                    <td>{{$commande->commande->table_client->numero_table}}</td>
                    <td><img height="25px" width="25px" src="{{asset($commande->plat->images->first()->chemin)}}" alt=""></td>
                    <td>{{$commande->plat->name}}</td>
                    <td>{{$commande->quantite}}</td>
                    @php
                        $etat = $commande->commande->etat->libelle;
                    @endphp
                    <td class="{{$etat == 'PRET' ? 'text-success':'text-danger'}}">{{$commande->commande->etat->libelle}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
