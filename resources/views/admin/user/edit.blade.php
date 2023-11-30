@extends('layouts.app')
@section('title', 'Ubah Data User')

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
                            <form action="{{ route('admin.user.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama</label>
                                    <input type="text" name='name' value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid
                                            @enderror"
                                        id="basic-default-fullname" placeholder="Masukkan Nama User" required>
                                    @error('name')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Username</label>
                                    <input type="text" name='username' value="{{ old('username', $user->username) }}"
                                        class="form-control @error('username') is-invalid
                                            @enderror"
                                        id="basic-default-fullname" placeholder="Masukkan Username" required>
                                    @error('username')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Password</label>
                                            <input type="password" name='password' value="{{ old('password') }}"
                                                class="form-control @error('password') is-invalid
                                                @enderror"
                                                id="basic-default-fullname" placeholder="Masukkan Password">
                                            @error('password')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Password
                                                Confirmation</label>
                                            <input type="password" name='password_confirmation' class="form-control"
                                                id="basic-default-fullname" placeholder="Masukkan Password Confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-default-faculty">Fakultas</label>
                                        <select name="faculty_id" id="faculty_id"
                                            class="form-select @error('faculty_id') is-invalid @enderror">
                                            <option value="">--Pilih Fakultas--</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}"
                                                    {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>
                                                    {{ $faculty->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                            <div class="form-text">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-default-departement">Program Studi</label>
                                        <select name="departement_id" id="departement_id"
                                            class="form-select @error('departement_id') is-invalid @enderror">
                                            <option value="">--Pilih Program Studi--</option>
                                            @foreach ($departements as $departement)
                                                <option value="{{ $departement->id }}"
                                                    {{ $user->departement_id == $departement->id ? 'selected' : '' }}>
                                                    {{ $departement->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('departement_id')
                                            <div class="form-text">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Roles</label><br>
                                    @foreach ($roles as $role)
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                                                value="{{ $role->name }}" id="check-{{ $role->id }}">
                                            <label class="form-check-label" for="{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
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
