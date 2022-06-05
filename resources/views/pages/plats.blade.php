@extends('layouts.base', ['title' => 'Menus'])

@push('css')
    <script defer src="https://kit.fontawesome.com/d0186bbfb8.js" crossorigin="anonymous"></script>
@endpush

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
                    <th>Actions</th>
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
                        <td>
                            {{-- <a href="#" data-id="{{ $plat->id }}" class="edit-plat"><i
                                    class="fs-3 fa-solid fa-edit"></i></a> --}}
                            <a href="#" data-id="{{ $plat->id }}" class="delete-plat"><i
                                    class="fs-3 ml-3 fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $plats->links() }}


    <form action="{{ route('plats.store') }}" method="POST" id="form-plat" enctype="multipart/form-data"
        style="display: none">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <div class="mb-3 row">
            <div class="form-group col">
                <label for="#" class="form-label">Libelle:</label>
                <input type="text" class="form-control" name="libelle" value="{{ old('libelle') }}" required>
            </div>
            <div class="form-group col">
                <label for="#" class="form-label">Prix:</label>
                <input type="number" class="form-control" value="{{ old('prix') }}" name="prix" required>
            </div>
        </div>
        <div class="mb-4">
            <div class="form-group">
                <label for="#" class="form-label">Categorie:</label>
                <select name="categorie_id" class="form-control" required>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ ucfirst($categorie->libelle) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-group">
                <input required name="images[]" placeholder="choisir des images" type="file" class="form-control-file"
                    accept=".jpg, .jpeg, .png" multiple>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="mx-2 my-3 btn btn-primary">Valider</button>
        </div>
    </form>

@endsection

@push('javascript')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var modelname = "plats";
    </script>
@endpush
