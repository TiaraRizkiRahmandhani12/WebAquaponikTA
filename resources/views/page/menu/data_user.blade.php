<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <div class="col-md-4">
                            <form method="POST" action="{{ route('search.user') }}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari..." name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($userCount < 2)
                            <div class="col-md-2 text-right">
                                <a href="{{ route('formAdd.user') }}" class="btn btn-primary">Tambah User</a>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: center">
                                    <th>Username <i class="bi bi-arrow-down-up" onclick="sortTable('username')"></i></th>
                                    <th>Status <i class="bi bi-arrow-down-up" onclick="sortTable('status')"></i></th>
                                    <th>Email <i class="bi bi-arrow-down-up" onclick="sortTable('email')"></i></th>
                                    <th>No. HP <i class="bi bi-arrow-down-up" onclick="sortTable('no_hp')"></i></th>
                                    <th>Alamat <i class="bi bi-arrow-down-up" onclick="sortTable('alamat')"></i></th>
                                    <th>Foto <i class="bi bi-arrow-down-up" onclick="sortTable('foto')"></i></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr style="text-align: center">
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_hp }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td><img src="{{ asset('storage/' . substr($user->foto, 7)) }}" alt="Foto"
                                                width="50"></td>
                                        </td>
                                        <td>
                                            <a href="{{ route('formEdit.user', ['id' => $user->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('delete.user', ['id' => $user->id]) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    function sortTable(column) {
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector('.table'); // ganti '.table' dengan selector yang sesuai
        switching = true;
        dir = 'asc'; // awalnya urutkan secara ascending
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].querySelector(`td:nth-child(${columnIndex(column)})`);
                y = rows[i + 1].querySelector(`td:nth-child(${columnIndex(column)})`);
                if (dir == 'asc') {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == 'desc') {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == 'asc') {
                    dir = 'desc';
                    switching = true;
                }
            }
        }
    }

    function columnIndex(columnName) {
        let headers = document.querySelectorAll('th');
        for (let i = 0; i < headers.length; i++) {
            if (headers[i].innerText.trim().toLowerCase() === columnName.toLowerCase()) {
                return i + 1;
            }
        }
        return -1;
    }
</script>
