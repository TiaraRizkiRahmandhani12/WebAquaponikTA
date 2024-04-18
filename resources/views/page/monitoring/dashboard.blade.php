<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-4 grid-margin">
        <a href="{{ route('analisis') }}#temperatureSection" style="text-decoration: none; color: inherit;">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Temperatur Air</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->temperature }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">°C</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-thermometer-half text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-sm-4 grid-margin">
        <a href="{{ route('analisis') }}#phSection" style="text-decoration: none; color: inherit;">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Keasaman Air (pH)</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->ph }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-droplet-fill text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-sm-4 grid-margin">
        <a href="{{ route('analisis') }}#tdsSection" style="text-decoration: none; color: inherit;">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Total Dissolved Solids</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->tds }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">ppm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-droplet text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Presentase Pakan Ikan</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->sisa_pakan }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-bucket text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
        <a href="{{ route('analisis') }}#heightSection" style="text-decoration: none; color: inherit;">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Tinggi Air Kolam</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->tinggi_air }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">cm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-moisture text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-sm-4 grid-margin">
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
                                    <li><h4 class="mb-2 d-inline-block">{{ $pakan->jam_pertama }}</h4> <span class="text-success mb-0 font-weight-medium" style="vertical-align: middle;">WIB</span></li>
                                    <li><h4 class="mb-2 d-inline-block">{{ $pakan->jam_kedua }}</h4> <span class="text-success mb-0 font-weight-medium" style="vertical-align: middle;">WIB</span></li>
                                    <li><h4 class="mb-2 d-inline-block">{{ $pakan->jam_ketiga }}</h4> <span class="text-success mb-0 font-weight-medium" style="vertical-align: middle;">WIB</span></li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-alarm text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Status Pompa Alir</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->status_pompa }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">cm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-water text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Status Pembuangan Air</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->status_pembuangan }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">cm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-droplet-half text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="text-center center-text"> 
                <h5 style="font-size: 22px;">Aerator</h5>
                </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ $data->status_pompa }}</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">o</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated {{ $data->created_at }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right" >
                        <i class="icon-lg bi bi-wind text-primary ml-auto" style="color: white !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- disini --}}
                </div>
            </div>
        </div>
    </div>
@endsection
