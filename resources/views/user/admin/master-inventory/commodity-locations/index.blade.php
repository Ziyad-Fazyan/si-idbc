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
                <div>
                    <button type="button">
                        <i class="fas fa-fw fa-upload"></i>
                        Import Excel
                        </button>

                    <button type="button">
                        <i class="fas fa-fw fa-download"></i>
                        Export
                        </button>

                        <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-lokasi'})">
                            <i class="fas fa-fw fa-plus"></i>
                            Tambah Data
                        </button>
                    </div>
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
                        @foreach ($commodity_locations as $commodity_location)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $commodity_location->name }}</td>
                                <td>
                                    {{ Str::limit($commodity_location->description, 55, '...') }}</td>
                                <td>
                                    <div>
                                        <a data-id="{{ $commodity_location->id }}">
                                            <i class="fas fa-fw fa-search"></i>
                                            </a>
                                        <a data-id="{{ $commodity_location->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                            </a>
                                        <form
                                            action="{{ route($prefix . 'inventory.lokasi-destroy', $commodity_location->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i
                                                    class="fas fa-fw fa-trash-alt"></i>
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

        <x-modal name="create-lokasi">
            @include('user.admin.master-inventory.commodity-locations.modal.create')
        </x-modal>
@endsection
