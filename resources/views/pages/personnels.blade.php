@extends('layouts.base', ['title' => 'Personnels'])

@push('css')
    <script defer src="https://kit.fontawesome.com/d0186bbfb8.js" crossorigin="anonymous"></script>
@endpush

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="my-4">
        <button class="btn btn-primary" id="add-btn">Ajouter un personnel</button>
    </div>
    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>avatar</th>
                <th scope="col">Nom</th>
                <th scope="col">Sexe</th>
                <th scope="col">Commandes</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($personnels as $personnel)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td><img height="30px" width="30px" src="{{ asset('storage/' . $personnel->user->avatar) }}"></td>
                    <td>{{ $personnel->user->name }}</td>
                    <td>{{ $personnel->sexe }}</td>
                    <td><a href="{{ route('commandes', ['id' => $personnel->id]) }}"><i
                                class="fa-solid fa-up-right-from-square"></i></a></td>
                    <td><a href="#" data-id="{{ $personnel->user->id }}" class="delete-plat"><i
                        class="fs-3 ml-3 fa-solid fa-trash text-danger"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $personnels->links() }}


    <form action="{{ route('personnels.store') }}" method="POST" id="form" enctype="multipart/form-data"
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
                <label for="#" class="form-label">Nom:</label>
                <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" required>
            </div>
            <div class="form-group col">
                <label for="#" class="form-label">Prenom:</label>
                <input type="text" class="form-control" value="{{ old('prenom') }}" name="prenom" required>
            </div>
        </div>
        <div class="mb-4">
            <label for="#" class="form-label">Email:</label>
            <input type="email" class="form-control" value="{{ old('email') }}" name="email" required>
        </div>
        <div class="mb-4">
            <div class="row">
                <div class="form-group col-6">
                    <select name="poste_id" id="poste" class="form-control">
                        @foreach ($postes as $poste)
                            <option value="{{ $poste->id }}">{{ ucfirst($poste->libelle) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <select name="sexe" id="sexe" class="form-control">
                        @foreach ($sexes as $key => $value)
                            <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="form-group">
                <label for="#" class="form-label">Mot de passe:</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="mb-4">
            <div class="form-group">
                <label for="#" class="form-label">Confirmation du mot de passe:</label>
                <input type="password" class="form-control" name="password_confirmation">
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
        var modelname = "personnels";
    </script>
@endpush
