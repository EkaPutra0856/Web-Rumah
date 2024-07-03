<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Kode Pos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->kecamatan }}</td>
                    <td>{{ $p->kelurahan_desa }}</td>
                    <td>{{ $p->kode_pos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
