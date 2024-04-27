<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update User</h5>
                    <!-- Form untuk username, password, status, no_hp, alamat, dan foto -->
                    <form method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Username -->
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username') }}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Min 8 Characters" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Verifikasi Password -->
                        <div class="form-group">
                            <label for="verifikasi_password">Verify Password:</label>
                            <input type="password" class="form-control" id="verifikasi_password" name="verifikasi_password"
                                placeholder="Input same password" required>
                            @error('verifikasi_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Status -->
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" name="status"
                                value="{{ old('status') }}" required>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Nomor HP -->
                        <div class="form-group">
                            <label for="no_hp">Number Hp:</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                placeholder="Starting with +62" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Alamat -->
                        <div class="form-group">
                            <label for="alamat">Address:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Foto -->
                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required
                                accept="image/*">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
