<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrators List</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        /* Contoh: */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Administrators List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>No Telp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admin as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->gender }}</td>
                    <td>{{ $p->notelp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
