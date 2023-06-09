<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h1>Aplikasi </h1>

        <table class="table table-striped">
            <thead>
                <th>NO</th>
                <th>Nama</th>
                <th>Nama Partai</th>
                <th>TPS</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Suara</th>
            </thead>
            <tbody>
                @foreach($collection  as $key => $data)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{ $data->partai }}</td>
                        <td>{{ $data->desa }}</td>
                        <td>{{ $data->total_suara }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>