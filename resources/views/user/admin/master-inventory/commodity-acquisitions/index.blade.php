@extends('base.base-dash-index')
@section('title')
    Data Master Gedung - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Gedung
@endsection
@section('submenu')
    Daftar Data Gedung
@endsection
@section('submenu0')
    Tambah Data Gedung
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Gedung
@endsection
@section('content')
    <div>
        <div>
            <div>
                <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-perolehan'})">
                    <i class="fas fa-fw fa-plus"></i>
                    Tambah Data
                </button>
            </div>

            <div>
                <div>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commodityAcquisitions as $commodityAcquisition)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $commodityAcquisition->name }}</td>
                                <td>{{ Str::limit($commodityAcquisition->description, 55, '...') }}
                                </td>
                                </td>
                                <td>
                                    <div>
                                        <!-- Button actions -->
                                        <button x-data
                                            @click="$dispatch('open-modal', {name: 'show-perolehan'})">
                                            <i class="fas fa-fw fa-search"></i>
                                            <span>Detail</span>
                                        </button>
                                        <a data-id="{{ $commodityAcquisition->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route($prefix . 'inventory.perolehan-destroy', $commodityAcquisition->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="fas fa-fw fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-perolehan">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.create')
    </x-modal>

    <x-modal name="show-perolehan">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.show')
    </x-modal>
@endsection
