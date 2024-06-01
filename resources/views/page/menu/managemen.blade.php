<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="margin-bottom: 20px">To Do List</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Item <i class="bi bi-arrow-down-up" onclick="sortTable('item')"></i>
                                </th>
                                <th>
                                    Status <i class="bi bi-arrow-down-up" onclick="sortTable('status')"></i>
                                </th>
                                <th>
                                    Updated <i class="bi bi-arrow-down-up" onclick="sortTable('craeted_at')"></i>
                                </th>
                                <th>Action <i class="bi bi-arrow-down-up" onclick="sortTable('craeted_at')"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todolist as $item)
                                <tr>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-primary{{ $item->action == 'Pending' ? ' disabled' : '' }}"
                                            href="{{ route('control.updateToDoList', $item->item) }}">
                                            {{ $item->action }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @auth
        @if (auth()->user()->status === 'Admin')
            <div class="row" style="margin-bottom: 40px;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('pakan.update') }}">
                                @csrf
                                <h3 style="margin-bottom: 20px">Feeding Time</h3>
                                <table>
                                    <tr>
                                        <td><label for="jam_pertama" style="margin-right: 15px">First</label></td>
                                        <td><input type="time" id="jam_pertama" name="jam_pertama"
                                                value="{{ $pakan->jam_pertama ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="jam_kedua" style="margin-right: 15px">Second</label></td>
                                        <td><input type="time" id="jam_kedua" name="jam_kedua"
                                                value="{{ $pakan->jam_kedua ?? '' }}"></td>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('schedule.update') }}">
                                @csrf
                                <h3 style="margin-bottom: 20px">Automatic Reminder Scheduling</h3>
                                <label>Every {{ $schedule->every }} days</label>
                                <input value="{{ $schedule->every }}" type="number" class="form-control" name="every"
                                    id="">
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endauth
    @endif
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
