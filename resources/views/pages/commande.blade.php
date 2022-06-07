@extends('layouts.base', ['title' => 'Commandes'])

@push('css')
    <script src="{{ asset('assets/js/alpine.js') }}" defer></script>
@endpush

@section('content')
    <div x-data="data">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Date</th>
                    <th>Table</th>
                    <th>Montant</th>
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
                        <td>{{ $commande->date_de_commande }}</td>
                        <td>{{ $commande->table_client->numero_table }}</td>
                        @php
                            $total = 0;
                            foreach($commande->plat_commandes as $pc){
                                $total += $pc->quantite * $pc->plat->prix;
                            }

                        @endphp
                        <td>{{$total}}</td>
                        @php
                            $etat = $commande->etat->libelle;
                        @endphp
                        <td class="{{ $etat == 'PRET' ? 'text-success' : 'text-danger' }}">
                            <select data-id="{{ $commande->id }}" @change="updateEtat" name="status"
                                class="form-control" style="width: 65%">
                                @foreach ($etats as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ $etat->id == $commande->etat->id ? 'selected' : '' }}
                                        class="{{ $etat->libelle == 'PRET' ? 'text-success' : 'text-danger' }}">
                                        {{ $etat->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('javascript')
    <script src="{{asset('assets/js/notify.js')}}"></script>
    <script src="{{asset('assets/js/notifications.js')}}"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                init() {
                    console.log('OK');
                },

                async updateEtat(e) {
                    var response = await fetch('/api/commandes/changeEtat', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            etat_id: e.target.value,
                            commande_id: e.target.dataset.id,
                        })
                    })

                    response = await response.json();

                    console.log(response);

                    showNotification('alert-success','Changement effectué avec succes',"top", "right", "", "")
                },

                toggle() {
                    this.open = !this.open
                }
            }))
        })
    </script>
@endpush
