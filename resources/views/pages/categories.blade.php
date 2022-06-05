@extends('layouts.base', ['title' => 'Categories'])

@push('css')
    <script defer src="https://kit.fontawesome.com/d0186bbfb8.js" crossorigin="anonymous"></script>
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="my-3">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="libelle"
                        name="libelle">
                    @error('libelle')
                        <div class="valid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Ajouter un catégorie</button>
            </div>
        </form>
    </div>

    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Libelle</th>
                <th scope="col">Date de création</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($categories as $categorie)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ ucfirst($categorie->libelle) }}</td>
                    <td>{{ $categorie->created_at }}</td>
                    <td>
                        {{-- <a href="#" data-id="{{ $categorie->id }}" class="edit-plat"><i
                                class="fs-3 fa-solid fa-edit"></i></a> --}}
                        <a href="#" data-id="{{ $categorie->id }}" class="delete-plat"><i
                                class="fs-3 ml-3 fa-solid fa-trash text-danger"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection


@push('javascript')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var modelname = "categories";
    </script>
@endpush
