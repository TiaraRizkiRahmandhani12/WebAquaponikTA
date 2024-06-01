<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title text-center">Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset(Storage::url(Auth::user()->foto)) }}" class="img-fluid rounded-circle"
                                alt="Profile Picture" style="width: 150px; height: 150px;">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" value="{{ Auth::user()->username }}"
                                readonly style="background-color: #2A3038">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" value="{{ Auth::user()->status }}"
                                readonly style="background-color: #2A3038">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Phone Number</label>
                            <input type="text" class="form-control" id="no_hp" value="{{ Auth::user()->no_hp }}"
                                readonly style="background-color: #2A3038">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <textarea class="form-control" id="alamat" rows="3" readonly style="background-color: #2A3038">{{ Auth::user()->alamat }} s</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
