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
                        <td>{{ $commande->created_at }}</td>
                        <td>{{ $commande->commande->table_client->numero_table }}</td>
                        <td><img height="25px" width="25px" src="{{ asset($commande->plat->images->first()->chemin) }}"
                                alt="">
                        </td>
                        <td>{{ ucfirst($commande->plat->libelle) }}</td>
                        <td>{{ $commande->quantite }}</td>
                        @php
                            $etat = $commande->commande->etat->libelle;
                        @endphp
                        <td class="{{ $etat == 'PRET' ? 'text-success' : 'text-danger' }}">
                            <select data-id="{{ $commande->commande->id }}" @change="updateEtat" name="status"
                                class="form-control" style="width: 65%">
                                @foreach ($etats as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ $etat->id == $commande->commande->etat->id ? 'selected' : '' }}
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
