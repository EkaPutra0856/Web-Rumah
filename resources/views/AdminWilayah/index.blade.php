@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    ADMIN WILAYAH
@endsection

@section('table')
    <thead>
        <tr>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Id
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Name Admin Region
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Name Email
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                No Telepon
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($regionAdmin as $p)
            <tr class="hover:bg-[#f5f5f5]">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->wilayah_id }}
                </td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->name }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->email }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->notelp }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    <div class="flex flex-row gap-x-2 justify-center">
                        <button type="button" onclick="openEditModal('{{ $p->id }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-500">Edit</button>
                        <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-region') }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-12 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-500">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection

@section('Insert Modal')
    @include('AdminWilayah.InsertModal')
@endsection

@section('Edit Modal')
    @include('AdminWilayah.EditModal')
@endsection
