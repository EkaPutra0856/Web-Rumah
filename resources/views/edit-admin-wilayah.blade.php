@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Admin Wilayah</h1>

    <form action="{{ route('admin.admin-wilayah.update', $adminWilayah->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="administrator_id">Administrator</label>
            <select name="administrator_id" id="administrator_id" class="form-control">
                @foreach($administrators as $administrator)
                    <option value="{{ $administrator->id }}" {{ $adminWilayah->administrator_id == $administrator->id ? 'selected' : '' }}>{{ $administrator->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="wilayah_id">Wilayah</label>
            <select name="wilayah_id" id="wilayah_id" class="form-control">
                @foreach($wilayahs as $wilayah)
                    <option value="{{ $wilayah->id }}" {{ $adminWilayah->wilayah_id == $wilayah->id ? 'selected' : '' }}>{{ $wilayah->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Admin Wilayah</button>
    </form>
</div>
@endsection
