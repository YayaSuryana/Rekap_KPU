<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
  </head>
  <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">DPR RI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">DPRD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">DPR Prov</a>
                </li>
            </ul>
           
            </div>
        </div>
        </nav>
    <div class="container mt-5">

        <h1>DPR RI</h1>
        <div class="card">
            <div class="card-header">
                <div class="form-search">
                    <form action="{{ route('welcome') }}" method="GET">                            
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <select id="partai" name="partai" class="form-control form-select">
                                    <option value="">-- Pilih Partai --</option>
                                    @foreach ($parpol as $item)
                                        <option value="{{ $item->nama }}">{{ $item->nama }} - {{$item->singkatan}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-2">
                            <select id="kabupaten" name="kabupaten" class="form-control form-select">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach ($kabupaten as $k)
                                    <option value="{{ $k->kabupaten }}">{{ $k->kabupaten }}</option>
                                @endforeach
                            </select>
                            </div>
                        

                            <div class="col-md-3 mt-2">
                            <!-- <select name="kecamatan" id="kecamatan" class="form-control">
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatan as $kec)
                                <option value="{{$kec->kecamatan}}">{{$kec->kecamatan}}</option>
                                @endforeach
                            </select> -->
                            <select class="form-select form-control" name="kecamatan" id="kecamatan">
                                <option value="">---Pilih Kecamatan---</option>
                            </select>
                            <!-- <select id="kecamatan" name="kecamatan" class="form-control">
                                <option value="">Pilih Kecamatan</option>
                            </select> -->
                            </div>


                            <div class="col-md-3 mt-2">
                                <select class="form-select form-control" name="desa" id="desa">
                                    <option value="">---Pilih Desa---</option>
                                </select>
                            </div>

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
                        <th>TPS</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Partai</th>
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
                            <td>{{$data->tps}}</td>
                            <td>{{ $data->desa }}</td>
                            <td>{{ $data->kecamatan }}</td>
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ $data->partai }}</td>
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
        @elseif( request('desa') && request('kecamatan') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Partai</th>
                        <th>Suara</th>
                        <th>% Partai</th>
                        <th>Suara Partai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->desa }}</td>
                        <td>{{ $data->kecamatan }}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
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
        @elseif(request('kecamatan') && request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Nama Partai</th>
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
                            <td>{{ $data->kecamatan }}</td>
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ $data->partai }}</td>
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
        @elseif(request('kabupaten'))
        <table id="example" class="display table table-striped table-hover" style="width:100%">
                <thead>
                   <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kabupaten</th>
                        <th>Nama Partai</th>
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
                            <td>{{ $data->kabupaten }}</td>
                            <td>{{ $data->partai }}</td>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#example').DataTable();
      } );
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="{{asset('wilayah.js')}}"></script>
  </body>
</html>