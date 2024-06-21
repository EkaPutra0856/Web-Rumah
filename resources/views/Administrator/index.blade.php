@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    ADMINISTRATOR
@endsection

@section('table')
    <thead>
        <tr>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Name
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Email
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Gender
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Password
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                No Telp
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Action
            </th>
        </tr>
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/export-administrators" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
            <button type="button" onclick="openImportModal()"
                class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Import from Excel
            </button>
            <button type="button" onclick="showChart()"
                class="ml-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Distribution Chart
            </button>
        </div>
    </thead>
    <tbody>
        @foreach ($admin as $p)
            <tr class="hover:bg-[#f5f5f5]">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->name }}
                </td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->email }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->gender }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->password }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->notelp }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    <div class="flex flex-row gap-x-2 justify-center">
                        <button type="button" onclick="openEditModal('{{ $p->id }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                        <button type="button"
                            onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-administrator') }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
@endsection

@section('Insert Modal')
    @include('Administrator.InsertModal')
@endsection

@section('Edit Modal')
    @include('Administrator.EditModal')
@endsection

@section('Import Modal')
    @include('Administrator.ImportModal')
@endsection
@section('Gender Chart Modal')
    @include('Administrator.GenderChartModal')
@endsection
