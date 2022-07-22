@extends('layouts.base', ['title' => 'Detail commande '])

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libelle</th>
                    <th>Categorie</th>
                    <th>Prix</th>
                    <th>Quantite</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($commande['plat_commandes'] as $item)
                    @php
                        $plat = $item['plat'];
                        $total += $item['quantite'] * $plat['prix'];
                    @endphp
                    <tr>
                        <td>
                            <img height="50px" width="50px" src="{{$plat['images'][0]['chemin']}}" alt="Image plat">
                        </td>
                        <td class="text-bold">{{$plat['categorie']['libelle']}}</td>
                        <td class="text-uppercase">{{$plat['libelle']}}</td>
                        <td>{{number_format($plat['prix'], 0, '.', ' ')}} FCFA</td>
                        <td>x {{$item['quantite']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><h2>Total</h2></td>
                    <td >
                        <h3 class="text-danger">{{number_format($total, 0, '.', ' ')}} FCFA</h3>
                    </td>
                    <td><a href="{{route('print.commande', ['id' => $commande['id']])}}" class="btn btn-success">Imprimer la facture</a></td>
                </tr>
            </tbody>
        </table>
        <div class="row mt-5">
            <div class="col">
                <div class="fs-2">
                    <h5 class="text-primary">{{$commande['table_client']['numero_table']}} </h5>
                    @php
                        $date = Carbon\Carbon::parse($commande['date_de_commande'])->locale('fr')->isoFormat('lll');
                    @endphp
                </div>
                <div>
                    <span>{{$date}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
