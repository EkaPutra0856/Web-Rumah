<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KK List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID Rumah</th>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Jumlah Anggota Keluarga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kk as $p)
                <tr>
                    <td>{{ $p->rumah_id }}</td>
                    <td>{{ $p->nokk }}</td>
                    <td>{{ $p->namakk }}</td>
                    <td>{{ $p->anggota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
