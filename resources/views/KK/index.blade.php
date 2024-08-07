@extends('Layout.dashboardAdmin')
@extends('Layout.notif')

@section('Title')
    KK
@endsection

@section('table')
    <thead>
        <tr>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Id Rumah
            </th>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                No KK
            </th>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Nama Kepala Keluarga
            </th>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Jumlah Anggota Keluarga
            </th>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                File Scan KK
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Action
            </th>
        </tr>
        <div class="flex justify-end mb-4 p-3">
            <form action="{{ url('/search-kk') }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Search KK..."
                       class="w-full py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                    Search
                </button>
            </form>
        </div>
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/kk" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-4 rounded">
                Show All Data
            </a>
            <a href="/export-kk" class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
            <a href="/export-PDF-kk" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded">
                Export to PDF
            </a>
            <button type="button" onclick="openImportModal()"
                class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Import from Excel
            </button>
            <button type="button" onclick="showChart()" class="ml-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Distribution Chart
            </button>
        </div>
    </thead>
    <tbody>
        @if ($kk->isEmpty())
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">
                    Tidak ada data yang sesuai.
                </td>
            </tr>
        @else
            @foreach ($kk as $p)
                <tr class="hover:bg-[#f5f5f5]">
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->rumah_id }}</td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->nokk }}</td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->namakk }}</td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->anggota }}</td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">
                        @if ($p->filekk)
                            <a href="{{ Storage::url($p->filekk) }}" target="_blank" class="text-blue-500 hover:underline">View PDF</a>
                        @else
                            <p>No file.</p>
                        @endif
                    </td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">
                        <div class="flex flex-row gap-x-2 justify-center">
                            <button type="button" onclick="openEditModal('{{ $p->id }}')" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                            <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-kk') }}')" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
@endsection

@section('Insert Modal')
    @include('KK.InsertModal')
@endsection

@section('Edit Modal')
    @include('KK.EditModal')
@endsection

@section('Import Modal KK')
    @include('KK.ImportModal')
@endsection

@section('Family Member Chart Modal')
    @include('KK.FamilyMemberChartModal')
@endsection