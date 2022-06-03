@extends('layouts.base', ['title' => 'Menus'])

@section('content')
    <div class="row">
        <button id="add-plat-btn" class="m-3 btn btn-primary">Ajouter un element à la liste</button>
    </div>
    <div class="row p-3">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Images</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date de création</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($plats as $plat)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td><img height="30px" width="30px" src="{{ asset($plat->images->first()->chemin) }}"></td>
                        <td>{{ ucfirst($plat->libelle) }}</td>
                        <td>{{ $plat->prix }}</td>
                        <td>{{ $plat->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <form action="#" id="form-plat" enctype="multipart/form-data" style="display: none">
        @csrf
        <div class="row">
            <div class="form-group col-3">
                <label for="#" class="form-label">Libelle:</label>
                <input type="text" class="form-control" name="libelle">
            </div>
            <div class="form-group col-3">
                <label for="#" class="form-label">Prix:</label>
                <input type="text" class="form-control" name="prix">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="#" class="form-label">Categorie:</label>
                <select name="categorie_id" class="form-control">
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ ucfirst($categorie->libelle) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <input type="file" class="form-control" accept=".jpg, .jpeg, .png">
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mx-2 my-3 btn btn-primary">Valider</button> 
        </div>
    </form>
@endsection

{{ $plats->links() }}

@push('javascript')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endpush
