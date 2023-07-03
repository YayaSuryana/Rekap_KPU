@extends('welcome')
@section('content')
<h1>DPRD</h1>
<h3>{{$kab}} - {{$kec}} - {{$des}} - {{$tps}}</h3>
<div class="card">
    <div class="card-header">
        <div class="form-search">
            <form action="{{ route('dprp') }}" method="GET">                            
                <div class="row">
                    <!-- Partai -->
                    <div class="col-md-12 mt-2">
                        <select id="partai" name="partai" class="form-control form-select">
                            <option value="">-- Pilih Partai --</option>
                            @foreach ($parpol as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }} - {{$item->singkatan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Dapil -->
                    <div class="col-md-12 mt-2">
                        <select id="partai" name="partai" class="form-control form-select">
                            <option value="">-- Pilih Dapil --</option>
                            <option>Dapil1</option>
                            <option>Dapil2</option>
                            <option>Dapil3</option>
                            <option>Dapil4</option>
                            <option>Dapil5</option>
                            <option>Dapil6</option>
                        </select>
                    </div>
                    <!-- Kabupaten -->
                    <div class="col-md-3 mt-2">
                        <select id="kabupaten" name="kabupaten" class="form-control form-select">
                            <option value="">-- Pilih Kabupaten --</option>
                            @foreach ($kabupaten as $k)
                                <option value="{{ $k->kabupaten }}">{{ $k->kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Kecamatan -->
                    <div class="col-md-3 mt-2">
                        <select class="form-select form-control" name="kecamatan" id="kecamatan">
                            <option value="">---Pilih Kecamatan---</option>
                        </select>
                    </div>
                    <!-- Desa -->
                    <div class="col-md-3 mt-2">
                        <select class="form-select form-control" name="desa" id="desa">
                            <option value="">---Pilih Desa---</option>
                        </select>
                    </div>
                    <!-- TPS -->
                    <div class="col-md-3 mt-2">
                        <select name="tps" id="tps" class="form-control form-select">
                            <option value="">-- Pilih TPS --</option>
                            <option value="TPS 01">TPS 01</option>
                            <option value="TPS 02">TPS 02</option>
                            <option value="TPS 03">TPS 03</option>
                            <option value="TPS 04">TPS 04</option>
                            <option value="TPS 05">TPS 05</option>
                            <option value="TPS 06">TPS 06</option>
                            <option value="TPS 07">TPS 07</option>
                            <option value="TPS 08">TPS 08</option>
                            <option value="TPS 09">TPS 09</option>
                            <option value="TPS 10">TPS 10</option>
                            <option value="TPS 11">TPS 11</option>
                            <option value="TPS 12">TPS 12</option>
                            <option value="TPS 13">TPS 13</option>
                            <option value="TPS 14">TPS 14</option>
                            <option value="TPS 15">TPS 15</option>
                            <option value="TPS 16">TPS 16</option>
                            <option value="TPS 17">TPS 17</option>
                            <option value="TPS 18">TPS 18</option>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-md btn-primary w-100">Cari</button>
                    <button type="submit" class="btn btn-md btn-info w-100 mt-2">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card-body overflow-auto">
    @if(request('tps') && request('desa') && request('kecamatan') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Partai</th>
                    <th>Suara</th>
                    <th>% TPS</th>
                    <th>% Partai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $tpsValue = isset($tpsVal[$data->tps]) ? $tpsVal[$data->tps] : 0;
                                $percentageTps = $tpsValue != 0 ? ($data->total_suara / $tpsValue) * 100 : 0;
                            @endphp
                            {{ number_format($percentageTps, 2) }} % / {{number_format($tpsValue, 0, ',','.')}}
                        </td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} % / {{number_format($partaiValue, 0, ',','.')}}
                    </td>
                    <td>
                        
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif( request('desa') && request('kecamatan') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Partai</th>
                    <th>Suara</th>
                    <th>% Desa</th>
                    <th>% Partai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->partai }}</td>
                    <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $desaValue = isset($desaVal[$data->desa]) ? $desaVal[$data->desa] : 0;
                            $percentageDesa = $desaValue != 0 ? ($data->total_suara / $desaValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentageDesa, 2) }} % | {{number_format($desaValue, 0, ',','.')}}
                    </td>
                    <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} % | {{number_format($partaiValue, 0, ',','.')}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('kecamatan') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Partai</th>
                    <th>Suara</th>
                    <th>% Kecamatan</th>
                    <th>% Partai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $kecamatanValue = isset($kecamatanVal[$data->kecamatan]) ? $kecamatanVal[$data->kecamatan] : 0;
                                $percentageKecamatan = $kecamatanValue != 0 ? ($data->total_suara / $kecamatanValue) * 100 : 0;
                            @endphp
                            {{ number_format($percentageKecamatan, 2) }} % | {{number_format($kecamatanValue, 0, ',','.')}}
                        </td>
                        <td>
                            @php
                                $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                                $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                            @endphp
                            {{ number_format($percentage, 2) }} % | {{number_format($partaiValue, 0, ',','.')}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
            <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Partai</th>
                    <th>Suara</th>
                    <th>% Kabupaten</th>
                    <th>% Partai</th>
            </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $kabupatenValue = isset($kabupatenVal[$data->kabupaten]) ? $kabupatenVal[$data->kabupaten] : 0;
                                $percentageKabpaten = $kabupatenValue != 0 ? ($data->total_suara / $kabupatenValue) * 100 : 0;
                            @endphp
                            {{ number_format($percentageKabpaten, 2) }} % | {{number_format($kabupatenValue, 0, ',','.')}}
                        </td>
                        <td>
                            @php
                                $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                                $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                            @endphp
                            {{ number_format($percentage, 2) }} % | {{number_format($partaiValue, 0, ',','.')}}
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('partai') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kabupaten</th>
                    <th>Suara</th>
                    <th>% Partai</th>
                    <th>Suara Partai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    @php
                        $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                        $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                    @endphp

                    @if ($partaiValue != 0)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                            <td>{{ number_format($percentage, 2) }}%</td>
                            <td>{{ number_format($partaiValue, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @elseif(request('partai'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Suara</th>
                    <th>% Partai</th>
                    <th>Suara Partai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ number_format($data->total_suara, 0, ',', '.') }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{number_format($partaiValue, 0, ',','.')}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection