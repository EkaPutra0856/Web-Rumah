@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Admin Wilayah</h1>

    <form action="{{ route('admin.admin-wilayah.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="administrator_id">Administrator</label>
            <select name="administrator_id" id="administrator_id" class="form-control">
                @foreach($administrators as $administrator)
                    <option value="{{ $administrator->id }}">{{ $administrator->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wilayah_id">Wilayah</label>
            <select name="wilayah_id" id="wilayah_id" class="form-control">
                @foreach($wilayahs as $wilayah)
                    <option value="{{ $wilayah->id }}">{{ $wilayah->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Admin Wilayah</button>
    </form>

    <h2>Admin Wilayah List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Administrator</th>
                <th>Wilayah</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminWilayahs as $adminWilayah)
                <tr>
                    <td>{{ $adminWilayah->administrator->name }}</td>
                    <td>{{ $adminWilayah->wilayah->name }}</td>
                    <td>
                        <a href="{{ route('admin.admin-wilayah.edit', $adminWilayah->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.admin-wilayah.delete', $adminWilayah->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
