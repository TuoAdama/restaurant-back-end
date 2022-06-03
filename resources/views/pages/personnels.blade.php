@extends('layouts.base', ['title' => 'Personnels'])

@push('css')
    <script defer src="https://kit.fontawesome.com/d0186bbfb8.js" crossorigin="anonymous"></script>
@endpush

@section('content')
    <table class="table table-striped" id="dataTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>avatar</th>
                <th scope="col">Nom</th>
                <th scope="col">Sexe</th>
                <th scope="col">Commandes</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@push('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endpush
