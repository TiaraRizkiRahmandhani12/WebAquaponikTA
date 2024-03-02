<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pakan.update', ['id' => 1]) }}">
                        @csrf
                        <h3 style="margin-bottom: 20px">Setting Jam Pemberian Pakan Ikan Otomatis</h3>
                        <table>
                            <tr>
                                <td><label for="jam_pertama" style="margin-right: 15px">Jam Pertama</label></td>
                                <td><input type="time" id="jam_pertama" name="jam_pertama"
                                        value="{{ $pakan->jam_pertama ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td><label for="jam_kedua" style="margin-right: 15px">Jam Kedua</label></td>
                                <td><input type="time" id="jam_kedua" name="jam_kedua"
                                        value="{{ $pakan->jam_kedua ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td><label for="jam_ketiga" style="margin-right: 15px">Jam Ketiga</label></td>
                                <td><input type="time" id="jam_ketiga" name="jam_ketiga"
                                        value="{{ $pakan->jam_ketiga ?? '' }}"></td>
                            </tr>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-success">Success</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
