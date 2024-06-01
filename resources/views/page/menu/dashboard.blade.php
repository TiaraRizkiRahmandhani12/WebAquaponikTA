<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Temperatur Air</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 id="temperature" class="mb-0"></h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">°C</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated : <span id="timestamp1"></h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-thermometer-half text-primary ml-auto"
                                style="color: #6c7293 !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Keasaman Air (pH)</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 id="phAir" class="mb-0"></h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated : <span id="timestamp2"></span></h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-droplet-fill text-primary ml-auto"
                                style="color: #6c7293 !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Total Dissolved Solids</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 id="tdsValue" class="mb-0"></h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">ppm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated : <span id="timestamp3"></span></h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-droplet text-primary ml-auto" style="color: #6c7293 !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h2 id="jarakPakan" class="mb-0"></h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated : <span id="timestamp4"></span></h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-bucket text-primary ml-auto" style="color: #6c7293 !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Tinggi Air Kolam</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 id="jarakAir" class="mb-0"></h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">cm</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last Updated : <span id="timestamp5"></h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-moisture text-primary ml-auto" style="color: #6c7293 !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin dynamic-content">
            <div class="card">
                <div class="card-body" style="padding: 23px 20px;">
                    <div class="text-center center-text">
                        <h5 style="font-size: 22px;">Jadwal Pakan Ikan</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <ul class="list-unstyled mb-0">
                                    @if ($pakan)
                                        <li>
                                            <h5 class="mb-2 d-inline-block">{{ $pakan->jam_pertama }}</h5>
                                            <strong class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle; font-size:10px">WIB</strong>
                                        </li>
                                        <li>
                                            <h5 class="mb-2 d-inline-block">{{ $pakan->jam_kedua }}</h5>
                                            <span class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle; font-size:10px">WIB</span>
                                        </li>
                                        <li>
                                            <h5 class="mb-2 d-inline-block">{{ $pakan->jam_ketiga }}</h5>
                                            <span class="text-success mb-0 font-weight-medium"
                                                style="vertical-align: middle; font-size:10px">WIB</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg bi bi-alarm text-primary ml-auto" style="color: #6c7293  !important;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" style="margin-bottom: 35px">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="nav-link d-block">
                        <h3 style="color: #ffffff" href="{{ route('dashboard') }}">To Do List</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="text-align: center">
                                        <th>
                                            Item </>
                                        </th>
                                        <th>
                                            Status </i>
                                        </th>
                                        <th>
                                            Updated ></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todolist as $item)
                                        <tr style="text-align: center">
                                            <td>{{ $item->item }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 35px">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="color: #ffffff">Table of Data Sensor</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: center">
                                    <th>No</th>
                                    <th>Water Temperature </i>
                                    </th>
                                    <th>Ph </i></th>
                                    <th>Fish Feed ></i>
                                    </th>
                                    <th>TDS </i></th>
                                    <th>Timestamp ></>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data2 as $index => $sensorData)
                                    <tr style="text-align: center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $sensorData->suhu }}</td>
                                        <td>{{ $sensorData->phAir }}</td>
                                        <td>{{ $sensorData->jarakPakan }}</td>
                                        <td>{{ $sensorData->tdsValue }}</td>
                                        <td>{{ $sensorData->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $data2->links('vendor.pagination.simple-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
        @if (auth()->user()->status === 'Admin')
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="nav-link d-block">
                                <h3 style="color: #ffffff">List User</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>Username ></i>
                                                </th>
                                                <th>Status ></i>
                                                </th>
                                                <th>Email ></i>
                                                </th>
                                                <th>No. HP ></>
                                                </th>
                                                <th>Alamat ></i>
                                                </th>
                                                <th>Foto </i></th>
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
                                                    <td><img src="{{ asset('storage/' . substr($user->foto, 7)) }}"
                                                            alt="Foto" width="50"></td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
<script>
    function loadData() {
        $.ajax({
            url: '{{ route('load.data') }}',
            type: 'GET',
            success: function(response) {
                console.log(response);
                $('#temperature').text(response.suhu);
                $('#phAir').text(response.phAir);
                $('#jarakPakan').text(response.jarakPakan);
                $('#tdsValue').text(response.tdsValue);
                $('#jarakAir').text(response.jarakAir);
                if (response.created_at) {
                    let dateTime = new Date(response.created_at);
                    let formattedDateTime =
                        `${dateTime.getFullYear()}-${('0' + (dateTime.getMonth() + 1)).slice(-2)}-${('0' + dateTime.getDate()).slice(-2)} ${('0' + dateTime.getHours()).slice(-2)}:${('0' + dateTime.getMinutes()).slice(-2)}:${('0' + dateTime.getSeconds()).slice(-2)}`;
                    $('#timestamp1').text(formattedDateTime);
                    $('#timestamp2').text(formattedDateTime);
                    $('#timestamp3').text(formattedDateTime);
                    $('#timestamp4').text(formattedDateTime);
                    $('#timestamp5').text(formattedDateTime);
                }


            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Panggil fungsi loadData setiap beberapa detik
    setInterval(loadData, 1000);

    // Panggil fungsi loadData saat halaman pertama kali dimuat
    $(document).ready(function() {
        loadData();
    });
</script>
