@extends('layouts.app')
@section('title', 'Ubah Data Fakultas')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <h5 class="card-header">@yield('title')</h5>
                        <div class="card-body">
                            <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama Role</label>
                                    <input type="text" name='name' value="{{ old('name', $faculty->name) }}"
                                        class="form-control @error('name') is-invalid
                                            @enderror"
                                        id="basic-default-fullname" placeholder="Masukkan Nama Fakultas" required>
                                    @error('name')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm"><i
                                        class="menu-icon bx bx-arrow-back"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm"> <i
                                        class="bx menu-icon bx-save"></i>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
