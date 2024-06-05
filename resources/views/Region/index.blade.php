@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    WILAYAH
@endsection

@section('table')
    <thead>
        <tr>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                ID
            </th>
            {{-- <th class="py-3 px-3 border-b-2 text-md border-b-blue-300 font-bold text-blue-600">
                Region Name
            </th> --}}
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Provinsi
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Kabupaten/Kota
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Kecamatan
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Kelurahan/Desa
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Kode Pos
            </th>
            <th class="text-center border-b-[1px] font-semibold text-gray-700 dark:text-white">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($region as $p)
            <tr class="hover:bg-blue-100">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">
                    {{ $p->id }}
                </td>
                {{-- <td class="p-3 text-center border-b-2 text-sm border-b-blue-700 font-normal text-gray-400">{{ $p->name }}</td> --}}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->provinsi }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kabupaten_kota }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kecamatan }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kelurahan_desa }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    {{ $p->kode_pos }}</td>
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-500">
                    <div class="flex flex-row gap-x-3 justify-center">
                        <button type="button" onclick="openEditModal('{{ $p->id }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-16 py-2 text-center bg-orange-500 hover:bg-orange-600 focus:ring-orange-400">Edit</button>
                        <button type="button" onclick="openDeleteModal('{{ url('/' . $p->id . '/delete-region') }}')"
                            class=" text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs w-16 py-2 text-center bg-red-500 hover:bg-red-600 focus:ring-red-400">Delete</button>
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
