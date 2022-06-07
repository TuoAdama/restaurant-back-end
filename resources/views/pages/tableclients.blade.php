@extends('layouts.base', ['title' => 'List des tables'])

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
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="my-3">
        <form action="{{ route('tableclients.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control @error('numero_table') is-invalid @enderror" placeholder="Numéro de table"
                        name="numero_table">
                    @error('libelle')
                        <div class="valid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Ajouter une table</button>
            </div>
        </form>
    </div>

    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Date de création</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($tables as $table)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ ucfirst($table->numero_table) }}</td>
                    <td>{{ $table->created_at }}</td>
                    <td>
                        {{-- <a href="#" data-id="{{ $table->id }}" class="edit-plat"><i
                                class="fs-3 fa-solid fa-edit"></i></a> --}}
                        <a href="#" data-id="{{ $table->id }}" class="delete-plat"><i
                                class="fs-3 ml-3 fa-solid fa-trash text-danger"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tables->links() }}
@endsection

@push('javascript')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var modelname = "tableclients";
    </script>
@endpush
