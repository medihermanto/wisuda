@extends('layouts.app')
@section('title', 'Tambah Data User')

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
                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama</label>
                                    <input type="text" name='name' value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid
                                            @enderror"
                                        id="basic-default-fullname" placeholder="Masukkan Nama User" required>
                                    @error('name')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-username">Username</label>
                                    <input type="text" name='username' value="{{ old('username') }}"
                                        class="form-control @error('username') is-invalid
                                            @enderror"
                                        id="basic-default-username" placeholder="Masukkan Username" required>
                                    @error('username')
                                        <div class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-password">Password</label>
                                            <input type="password" name='password' value="{{ old('password') }}"
                                                class="form-control @error('password') is-invalid
                                                @enderror"
                                                id="basic-default-password" placeholder="Masukkan Password" required>
                                            @error('password')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-password_confirmation">Password
                                                Confirmation</label>
                                            <input type="password" name='password_confirmation' class="form-control"
                                                id="basic-default-password_confirmation"
                                                placeholder="Masukkan Password Confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-faculty">Fakultas</label>
                                            <select name="faculty_id" id="faculty_id" autofocus=""
                                                class="form-select @error('faculty_id') is-invalid @enderror">
                                                <option value="">--Pilih Fakultas--</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('faculty_id')
                                                <div class="form-text">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-departement">Program
                                                Studi</label>
                                            <select name="departement_id" id="departement_id"
                                                class="form-select @error('departement_id') is-invalid @enderror">
                                                <option value="">Pilih Fakultas terlebih dahulu</option>

                                            </select>
                                            @error('departement_id')
                                                <div class="form-text">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-email">Roles</label><br>
                                    @foreach ($roles as $role)
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="role[]"
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // ajax get departement
        $(document).ready(function() {
            // Tambahkan event listener untuk perubahan pada Select Box pertama
            $('#faculty_id').change(function() {
                var selectedValue = $(this).val();

                // Buat permintaan AJAX ke server untuk mendapatkan data sesuai dengan pilihan Select Box pertama
                $.ajax({
                    url: '/user/departement/' + selectedValue,
                    type: 'GET',
                    success: function(data) {
                        // Hapus semua opsi sebelum menambahkan yang baru
                        $('#departement_id').empty();
                        // Tambahkan opsi berdasarkan data yang diterima dari server
                        $.each(data, function(key, value) {
                            $('#departement_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                            console.log(value.id)
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
@endsection
