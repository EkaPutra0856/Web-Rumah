@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    ADMIN WILAYAH
@endsection

@section('table')
    <thead>
        <tr>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Image
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Id
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Nama Admin Wilayah
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Email
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                No Telepon
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                ID Wilayah
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Nama Wilayah
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Action
            </th>
        </tr>
        <div class="flex justify-end mb-4 p-3">
            <form action="{{ url('/search-adminwilayah') }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Search regional admin..."
                       class="w-full py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                    Search
                </button>
            </form>
        </div>
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/adminwilayah" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-4 rounded">
                Show All Data
            </a>
            <a href="/export-adminwilayah" class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
            <a href="/export-PDF-adminwilayah" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded">
                Export to PDF
            </a>
            <button type="button" onclick="openImportModal()"
                class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Import from Excel
            </button>
            <button type="button" onclick="showChartRegionalAdmin()"
                class="ml-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Distribution Chart
            </button> 
        </div>
    </thead>
    <tbody>
        @if ($regionAdmin->isEmpty())
            <tr>
                <td colspan="8" class="text-center p-4 text-gray-500">
                    Tidak ada data yang sesuai.
                </td>
            </tr>
        @else
            @foreach ($regionAdmin as $p)
                <tr class="hover:bg-[#f5f5f5]">
                    <td class="p-2 pl-16">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="Image" class="w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('image/default.jpg') }}" alt="No Image" class="w-10 h-10 rounded-full">
                        @endif
                    </td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->id }}
                    </td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->name }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->email }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->notelp }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->region_id }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->region->kelurahan_desa }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        <div class="flex flex-row gap-x-2 justify-center">
                            <button type="button" onclick="openEditModal('{{ $p->id }}')"
                                class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                            <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-adminwilayah') }}')"
                                class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
@endsection

@section('Insert Modal')
    @include('AdminWilayah.InsertModal')
@endsection

@section('Edit Modal')
    @include('AdminWilayah.EditModal')
@endsection

@section('Import Modal Admin Wilayah')
    @include('AdminWilayah.ImportModal')
@endsection

@section('Regional Admin Chart Modal')
    @include('AdminWilayah.RegionalAdminChartModal')
@endsection
