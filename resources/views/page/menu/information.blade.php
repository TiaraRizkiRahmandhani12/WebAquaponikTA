@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <!-- Pakan Card -->
                <div class="card mb-3">
                    <div class="card-header" id="headingPakan">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-left collapsed" style="width: 100%; color:white;"
                                data-toggle="collapse" data-target="#collapsePakan" aria-expanded="true"
                                aria-controls="collapsePakan">
                                Pakan <i class="bi bi-chevron-right float-right"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapsePakan" class="collapse" aria-labelledby="headingPakan" data-parent="#accordion">
                        <div class="card-body">
                            This is the explanation for Pakan.
                        </div>
                    </div>
                </div>

                <!-- Suhu Card -->
                <div class="card mb-3">
                    <div class="card-header" id="headingSuhu">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-left collapsed" style="width: 100%; color:white"
                                data-toggle="collapse" data-target="#collapseSuhu" aria-expanded="false"
                                aria-controls="collapseSuhu">
                                Suhu <i class="bi bi-chevron-right float-right"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseSuhu" class="collapse" aria-labelledby="headingSuhu" data-parent="#accordion">
                        <div class="card-body">
                            Suhu refers to the temperature control necessary for maintaining the optimal environment for
                            livestock or crops. Proper temperature regulation ensures better growth, health, and
                            productivity. Monitoring and adjusting the temperature according to the needs of different
                            animals or plants is essential for their well-being.
                        </div>
                    </div>
                </div>

                <!-- Suhu Card -->
                <div class="card mb-3">
                    <div class="card-header" id="headingTds">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-left collapsed" style="width: 100%; color:white"
                                data-toggle="collapse" data-target="#collapseTds" aria-expanded="false"
                                aria-controls="collapseTds">
                                TDS <i class="bi bi-chevron-right float-right"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseTds" class="collapse" aria-labelledby="headingTds" data-parent="#accordion">
                        <div class="card-body">
                            Suhu refers to the temperature control necessary for maintaining the optimal environment for
                            livestock or crops. Proper temperature regulation ensures better growth, health, and
                            productivity. Monitoring and adjusting the temperature according to the needs of different
                            animals or plants is essential for their well-being.
                        </div>
                    </div>
                </div>

                <!-- Suhu Card -->
                <div class="card mb-3">
                    <div class="card-header" id="headingPh">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-left collapsed" style="width: 100%; color:white"
                                data-toggle="collapse" data-target="#collapsePh" aria-expanded="false"
                                aria-controls="collapsePh">
                                Ph <i class="bi bi-chevron-right float-right"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapsePh" class="collapse" aria-labelledby="headingPh" data-parent="#accordion">
                        <div class="card-body">
                            Suhu refers to the temperature control necessary for maintaining the optimal environment for
                            livestock or crops. Proper temperature regulation ensures better growth, health, and
                            productivity. Monitoring and adjusting the temperature according to the needs of different
                            animals or plants is essential for their well-being.
                        </div>
                    </div>
                </div>

                <!-- Suhu Card -->
                <div class="card mb-3">
                    <div class="card-header" id="headingPengurasan">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-left collapsed" style="width: 100%; color:white"
                                data-toggle="collapse" data-target="#collapsePengurasan" aria-expanded="false"
                                aria-controls="collapsePengurasan">
                                Pengurasan <i class="bi bi-chevron-right float-right"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapsePengurasan" class="collapse" aria-labelledby="headingPengurasan"
                        data-parent="#accordion">
                        <div class="card-body">
                            Suhu refers to the temperature control necessary for maintaining the optimal environment for
                            livestock or crops. Proper temperature regulation ensures better growth, health, and
                            productivity. Monitoring and adjusting the temperature according to the needs of different
                            animals or plants is essential for their well-being.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#accordion .collapse').on('show.bs.collapse', function() {
                $(this).prev('.card-header').find('i').removeClass('bi-chevron-right').addClass(
                    'bi-chevron-down');
            }).on('hide.bs.collapse', function() {
                $(this).prev('.card-header').find('i').removeClass('bi-chevron-down').addClass(
                    'bi-chevron-right');
            });
        });
    </script>
@endpush
