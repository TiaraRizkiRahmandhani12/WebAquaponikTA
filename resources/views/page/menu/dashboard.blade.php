<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 grid-margin dynamic-content">
            <a href="{{ route('dashboard') }}#temperatureSection" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center center-text">
                            <h5 style="font-size: 22px;">Temperatur Air</h5>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                    <h2 class="mb-0">{{ $data->suhu }}</h2>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">°C</p>
                                </div>
                                <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                <i class="icon-lg bi bi-thermometer-half text-primary ml-auto"
                                    style="color: white !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <a href="{{ route('dashboard') }}#phSection" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center center-text">
                            <h5 style="font-size: 22px;">Keasaman Air (pH)</h5>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                    <h2 class="mb-0">{{ $data->phAir }}</h2>
                                    <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                                </div>
                                <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                <i class="icon-lg bi bi-droplet-fill text-primary ml-auto"
                                    style="color: white !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <a href="{{ route('dashboard') }}#tdsSection" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center center-text">
                            <h5 style="font-size: 22px;">Total Dissolved Solids</h5>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                    <h2 class="mb-0">{{ $data->tdsValue }}</h2>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">ppm</p>
                                </div>
                                <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                <i class="icon-lg bi bi-droplet text-primary ml-auto" style="color: white !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Presentase Pakan Ikan</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{ $data->jarakPakan }}</h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-bucket text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <a href="{{ route('dashboard') }}#heightSection" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center center-text">
                            <h5 style="font-size: 22px;">Tinggi Air Kolam</h5>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                    <h2 class="mb-0">{{ $data->jarakAir }}</h2>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">cm</p>
                                </div>
                                <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                <i class="icon-lg bi bi-moisture text-primary ml-auto" style="color: white !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <a href="{{ route('control') }}" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center center-text">
                            <h5 style="font-size: 22px;">Jadwal Pakan Ikan</h5>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                <div class="d-flex d-sm-block d-md-flex align-items-center">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <h4 class="mb-2 d-inline-block">{{ $pakan->jam_pertama }}</h4> <span
                                                class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle;">WIB</span>
                                        </li>
                                        <li>
                                            <h4 class="mb-2 d-inline-block">{{ $pakan->jam_kedua }}</h4> <span
                                                class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle;">WIB</span>
                                        </li>
                                        <li>
                                            <h4 class="mb-2 d-inline-block">{{ $pakan->jam_ketiga }}</h4> <span
                                                class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle;">WIB</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                <i class="icon-lg bi bi-alarm text-primary ml-auto" style="color: white !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endsection
