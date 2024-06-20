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
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Action
            </th>
        </tr>
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/export-kk"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Export to Excel
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
        @foreach ($kk as $p)
            <tr class="hover:bg-[#f5f5f5]">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->rumah_id}}
                </td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->nokk }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->namakk }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->anggota }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">
                    <div class="flex flex-row gap-x-2 justify-center">
                        <button type="button" onclick="openEditModal('{{ $p->id }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                        <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-kk') }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
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