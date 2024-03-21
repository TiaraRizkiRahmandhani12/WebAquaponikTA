<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    {{-- JANGAN DIHAPUS DULU --}}
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

    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('save-switch-pakan') }}">
                        @csrf
                        @for ($i = 1; $i <= 14; $i++)
                            <!-- Switch {{ $i }} -->
                            <div class="custom-control custom-switch mb-3">
                                <input type="hidden" name="field_{{ $i }}" value="0">
                                <!-- Hidden field for off state -->
                                <input type="checkbox" class="custom-control-input" id="{{ $i }}"
                                    name="field_{{ $i }}" value="1"
                                    {{ isset($switchPakanData[$i]) && $switchPakanData[$i] ? 'checked' : '' }}>
                                <!-- Checkbox for on state, check if 'jam_i' field is truthy -->
                                <label class="custom-control-label" for="{{ $i }}">Switch
                                    {{ $i }}</label>
                            </div>
                        @endfor
                        <!-- Button to submit the form -->
                        <button type="submit">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
