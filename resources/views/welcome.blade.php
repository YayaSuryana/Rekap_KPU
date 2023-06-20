<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  </head>
  <body>
    <div class="container mt-5">
        <h1>Search</h1>
        <div class="form-search">
        <form action="{{ route('welcome') }}" method="GET">
          <div class="row mt-4">
          
            <div class="col-md-3">
              <select id="kabupaten" name="kabupaten" class="form-control">
                  <option value="">-- Pilih Kabupaten --</option>
                  @foreach ($kabupaten as $k)
                      <option value="{{ $k->kabupaten }}">{{ $k->kabupaten }}</option>
                  @endforeach
              </select>
            </div>
          

            <div class="col-md-3">
              <select name="kecamatan" id="kecamatan" class="form-control">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($kecamatan as $kec)
                  <option value="{{$kec->kecamatan}}">{{$kec->kecamatan}}</option>
                @endforeach
              </select>
              <!-- <select id="kecamatan" name="kecamatan" class="form-control">
                  <option value="">Pilih Kecamatan</option>
              </select> -->
            </div>


            <div class="col-md-3">
              <select name="desa" id="desa" class="form-control">
                <option value="">-- Pilih Desa --</option>
                @foreach($desa as $des)
                  <option value="{{$des->desa}}">{{$des->desa}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <select name="tps" id="tps" class="form-control">
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
            
            
          
            <div class="row mt-2 mb-2">
            <div class="col-md-12 mb-3">
              <select id="parpol" name="parpol" class="form-control">
                  <option value="">-- Pilih Partai --</option>
                  @foreach ($parpol as $item)
                      <option value="{{ $item->nama }}">{{ $item->nama }} ({{$item->singkatan}}) </option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-md btn-primary w-100">Cari</button>
            </div>

          </div>
        </form>
        </div>
      @if(request('tps') && request('desa') && request('kecamatan') && request('kabupaten'))
        <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>TPS</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
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
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      @elseif(request('desa') && request('kecamatan') && request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
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
                    <td>{{ $data->total_suara }}</td>
                    <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      @elseif(request('kecamatan') && request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->kecamatan }}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      @elseif(request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(request('parpol') && request('tps') && request('desa') && request('kecamatan') && request('kabupaten'))
        <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>TPS</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
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
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(request('parpol') && request('desa') && request('kecamatan') && request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
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
                    <td>{{ $data->total_suara }}</td>
                    <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      @elseif(request('parpol') && request('kecamatan') && request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->kecamatan }}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      @elseif(request('parpol') && request('kabupaten'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(request('parpol'))
      <table id="myTable" class="table display table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Kabupaten</th>
                <th>Nama Partai</th>
                <th>Suara</th>
                <th>Persentase yang didapatkan</th>
                <th>Jumlah suara yang didapatkan partai</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->total_suara }}</td>
                        <td>
                        @php
                            $partaiValue = isset($partai[$data->partai]) ? $partai[$data->partai] : 0;
                            $percentage = $partaiValue != 0 ? ($data->total_suara / $partaiValue) * 100 : 0;
                        @endphp
                        {{ number_format($percentage, 2) }} %
                    </td>
                    <td>
                        {{ $partaiValue }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      @endif
    </div>
    <script>
    // $(function() {
    //     $.ajaxSetup({
    //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    //     });

    //     $(function() {
    //         $('#kabupaten').on('change', function() {
    //             let kabupatens = $(this).val();

    //             $.ajax({
    //                 type: 'POST',
    //                 url: "{{ route('get.kecamatan') }}",
    //                 data: { kabupatens: kabupatens },
    //                 cache: false,

    //                 success: function(msg) {
    //                     $('#kecamatan').html(msg);
    //                 },

    //                 error: function(xhr, status, error) {
    //                     console.log('error: ', error);
    //                 }
    //             });
    //         });
    //     });
    // });
</script>

    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
  </body>
</html>