
<!-- resources/views/administrator/index.blade.php -->

@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    ADMINISTRATOR
@endsection


@section('table')
    <thead>
        <tr>
            <th class="pr-10 text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Image
            </th>
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
                No Telp
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Action
            </th>
        </tr>
        <div class="flex justify-end mb-4 p-3">
            <form action="{{ url('/search-administrators') }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Search administrators..."
                       class="w-full py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                    Search
                </button>
            </form>
        </div>
        
        <div class="flex justify-end mb-4 p-3 justify-center">
            <a href="/admintable" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-4 rounded">
                Show All Data
            </a>
            <a href="/export-administrators" class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
            <a href="/export-PDF-administrators" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded">
                Export to PDF
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
        @if ($admin->isEmpty())
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-500">
                    Tidak ada data yang sesuai.
                </td>
            </tr>
        @else
            @foreach ($admin as $p)
                <tr class="hover:bg-[#f5f5f5]">
                    <td class="p-2 pl-16">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="Image" class="w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="No Image" class="w-10 h-10 rounded-full">
                        @endif
                    </td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->name }}
                    </td>
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->email }}
                    <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                        {{ $p->gender }}

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
        @endif
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
