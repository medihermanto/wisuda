@extends('layouts.app')
@section('title', 'Profile Wisuda')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>

            <div class="row">
                <div class="col-xl-12">
                    <h5 class="text-header">Pendaftaran @yield('title')</h5>
                    <form method="POST" action="{{ route('admin.registration.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                        aria-selected="true">
                                        Data Pribadi
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                        aria-selected="false" tabindex="-1">
                                        Data Orang Tua
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                                        aria-selected="false" tabindex="-1">
                                        Data Lainnya
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-top-files" aria-controls="navs-pills-top-messages"
                                        aria-selected="false" tabindex="-1">
                                        Berkas Wisuda
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                                    {{-- data pribadi mahasiswa --}}
                                    <!-- Account -->


                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="npm" class="form-label">NPM</label>
                                            <input
                                                class="form-control @error('npm')
                                            @enderror"
                                                type="text" id="npm" value="{{ auth()->user()->username }}"
                                                name="npm" placeholder="Masukkan NPM" readonly>
                                            @error('npm')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="fullname" class="form-label">Nama Lengkap</label>
                                            <input
                                                class="form-control @error('fullname') is-invalid
                                            @enderror"
                                                type="text" name="fullname" value="{{ auth()->user()->name }}"
                                                id="fullname" placeholder="Masukkan Nama lengkap">
                                            @error('fullname')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input
                                                class="form-control @error('email') is-invalid
                                            @enderror"
                                                type="text" id="email" name="email" value="{{ old('email') }}"
                                                placeholder="john.doe@example.com">
                                            <small><i class="fas fa warning"></i> Pastikan email yang diinput adalah email
                                                aktif!</small>
                                            @error('email')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="organization"
                                                class="form-label @error('gender') is-invalid @enderror">Jenis
                                                Kelamin</label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <option value="pria">Pria</option>
                                                <option value="wanita">Wanita</option>
                                            </select>
                                            @error('gender')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phone">No Telepon/WA Aktif</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">IND (+62)</span>
                                                <input type="text" id="phone" name="phone"
                                                    value="{{ old('phone') }}"
                                                    class="form-control @error('phone') is-invalid
                                                @enderror"
                                                    placeholder="81211111111">
                                            </div>
                                            @error('phone')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="place_of_birth" class="form-label">Tempat / Tanggal Lahir</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text"
                                                        class="form-control @error('place_of_birth') is-invalid @enderror"
                                                        id="place_of_birth" name="place_of_birth"
                                                        value="{{ old('place_of_birth') }}"
                                                        placeholder="Masukkan Tempat Lahir">
                                                    @error('place_of_birth')
                                                        <div class="form-text">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <input type="date"
                                                        class="form-control @error('date_of_birth') is-invalid  @enderror "
                                                        id="htm5-date-input" name="date_of_birth"
                                                        value="{{ old('date_of_birth') }}">
                                                    @error('date_of_birth')
                                                        <div class="form-text">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" id=""
                                            value="{{ auth()->user()->id }}">
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea name="address" id="" cols="30" rows="5"
                                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="form-text">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                    {{-- data orang tua --}}
                                    <div class="mb-3 col-md-12">
                                        <label for="fathers_name" class="form-label">Nama Ayah</label>
                                        <input
                                            class="form-control @error('fathers_name') is-invalid
                                    @enderror"
                                            type="text" id="fathers_name" name="fathers_name"
                                            value="{{ old('fathers_name') }}" placeholder="Masukkan Nama Lengkap Ayah">
                                        @error('fathers_name')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="mothers_name" class="form-label">Nama Ibu</label>
                                        <input type="text"
                                            class="form-control @error('mothers_name') is-invalid @enderror"
                                            id="mothers_name" name="mothers_name" value="{{ old('mothers_name') }}"
                                            placeholder="Masukkan Nama Lengkap Ibu">
                                        @error('mothers_name')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                                    {{-- data lainnya --}}

                                    <div class="mb-3 col-md-12">
                                        <label for="title" class="form-label">Judul Skripsi</label>
                                        <input type="text"
                                            class="form-control @error('title') is-invalid
                                    @enderror"
                                            value="{{ old('title') }}" id="" name="title"
                                            placeholder="Masukkan Judul Skripsi">
                                        @error('title')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exam_value" class="form-label">IPK</label>
                                        <input type="text" value="{{ old('exam_value') }}"
                                            class="form-control @error('exam_value') is-invalid
                                    @enderror"
                                            id="" name="exam_value" placeholder="Masukkan Nilai IPK">
                                        @error('exam_value')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exam_date" class="form-label">Tanggal Ujian</label>
                                        <input type="date"
                                            class="form-control @error('exam_date') is-invalid @enderror"
                                            id="htm5-date-input" name="exam_date" value="2023-11-11">
                                        @error('exam_date')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3 col-md-12">
                                        <label for="size_toga" class="form-label">Ukuran Toga</label>
                                        <div class="form-check">
                                            <input name="size_toga" class="form-check-input" type="radio"
                                                value="xxl" id="defaultRadio1">
                                            <label class="form-check-label" for="defaultRadio1"> XXL </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="size_toga" class="form-check-input" type="radio"
                                                value="xl" id="defaultRadio1">
                                            <label class="form-check-label" for="defaultRadio1"> XL </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="size_toga" class="form-check-input" type="radio"
                                                value="l" id="defaultRadio1">
                                            <label class="form-check-label" for="defaultRadio1"> L </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="size_toga" class="form-check-input" type="radio"
                                                value="m" id="defaultRadio1">
                                            <label class="form-check-label" for="defaultRadio1"> M </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="size_toga" class="form-check-input" type="radio"
                                                value="s" id="defaultRadio1">
                                            <label class="form-check-label" for="defaultRadio1"> S </label>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="navs-pills-top-files" role="tabpanel">
                                    {{-- berkas pendaftaran --}}
                                    <div class="mb-3 col-md-12">
                                        <label for="photo_profile" class="form-label">Pas Photo</label>
                                        <input type="file" accept="image/*"
                                            class="form-control @error('photo_profile') is-invalid
                                    @enderror"
                                            id="photo_profile" name="photo_profile">
                                        @error('photo_profile')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="photo_ktp" class="form-label">File Scan KTP (Kartu Tanda
                                            Penduduk)</label>
                                        <input type="file"
                                            class="form-control @error('photo_ktp') is-invalid
                                    @enderror"
                                            id="photo_ktp" accept=".pdf" name="photo_ktp">
                                        @error('photo_ktp')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="photo_payment" class="form-label">File Scan Bukti Bayar Wisuda</label>
                                        <input type="file"
                                            class="form-control @error('photo_payment') is-invalid @enderror"
                                            id="photo_payment" accept=".pdf" name="photo_payment">
                                        @error('photo_payment')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="photo_ijazah" class="form-label">File Scan Ijazah</label>
                                        <input type="file"
                                            class="form-control @error('photo_ijazah') is-invalid
                                    @enderror"
                                            id="photo_ijazah" accept=".pdf" name="photo_ijazah">
                                        @error('photo_ijazah')
                                            <div class="form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2"><i
                                                class="fa fa-paper-plane"></i>
                                            &nbsp;
                                            Daftar</button>
                                        <button type="reset" class="btn btn-outline-secondary"> <i
                                                class="fa fa-ban"></i>
                                            &nbsp; Cancel</button>
                                    </div>


                                </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- / Content -->


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
                    url: '/registration/departement/' + selectedValue,
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
    <script>
        document.getElementById('phone').addEventListener('input', function(e) {
            // Hanya izinkan angka
            var inputValue = e.target.value;
            e.target.value = inputValue.replace(/[^0-9]/g, '');
        });
    </script>



@endsection
