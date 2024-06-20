@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    WILAYAH
@endsection

@section('table')
    <thead>
        <tr>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">ID</th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">Kecamatan</th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">Kelurahan/Desa</th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">Kode Pos</th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">Action</th>
        </tr>
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/wilayah-export" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
            <button type="button" onclick="openImportModal()"
                class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Import from Excel
            </button>
        </div>
    </thead>
    <tbody>
        @foreach ($regions as $p)
            <tr class="hover:bg-blue-100">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">
                    {{ $p->id }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kecamatan }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kelurahan_desa }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kode_pos }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    <div class="flex flex-row gap-x-3 justify-center">
                        <button type="button" onclick="openEditModal('{{ $p->id }}')"
                            class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-16 py-2 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                        <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-region') }}')"
                            class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-16 py-2 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection

@section('Insert Modal')
    @include('Region.InsertModal')
@endsection

@section('Edit Modal')
    @include('Region.EditModal')
@endsection

@section('Import Modal')
    @include('Region.ImportModal')
@endsection
