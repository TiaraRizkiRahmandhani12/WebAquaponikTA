<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">YANG INI JGN DIAPUS DULUUUU</h5>
                    <!-- Form untuk username dan password -->
                    <form method="POST" action="{{ route('storeProfile') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">LU BUAT DISINI AJA</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
