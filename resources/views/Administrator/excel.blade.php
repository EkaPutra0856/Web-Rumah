<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrators List</title>
</head>
<body>
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
