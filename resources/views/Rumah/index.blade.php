@extends('Layout.dashboard')
@extends('Layout.notif')

@section('Title')
    Rumah
@endsection

@section('table')
    <thead>
        <tr>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                ID  Rumah
            </th>
            <th class="py-2 px-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                No Rumah
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Alamat
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Luas Rumah (m<sup>2</sup>)
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Status Kepemilikan
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Tahun Dibangun
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Tahun Terakhir Renovasi
            </th>
            <th class="py-2 border-b-[1px] text-sm border-b-gray-200 font-semibold text-gray-300 ">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rumah as $p)
            <tr class="hover:bg-[#f5f5f5]">
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->id }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->norumah }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->alamat }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->luas }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->status }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->tahun }}
                <td class="p-2 text-center border-b-[1px] text-xs border-b-gray-700 font-normal text-gray-400">{{ $p->renov }}
                
                
                </td>
               
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
    @include('Rumah.InsertModal')
@endsection

@section('Edit Modal')
    @include('Rumah.EditModal')
@endsection

