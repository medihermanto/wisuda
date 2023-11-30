@extends('layouts.app')
@section('title', 'Daftar Wisuda Mahasiswa')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    @if ($status_daftar == 1)
                        <div class="alert alert-primary" role="alert"><i
                                class="menu-icon tf-icons bx bx-check-circle"></i>Hai
                            <strong>{{ auth()->user()->name }}</strong>, Terimakasih sudah melakukan pendaftaran,
                            untuk formulir bukti pendaftaran silahkan download pada tombol print dibawah!
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert"><i class="menu-icon tf-icons bx bx-x-circle"></i>Hai
                            <strong>{{ auth()->user()->name }}</strong>, Anda
                            belum melakukan pendaftaran
                            wisuda !
                        </div>
                    @endif
                    <div class="card mt-3">
                        <h5 class="card-header">@yield('title')</h5>
                        <div class="card-body">
                            @can('registrations.create')
                                <a href="{{ route('student.registration.create') }}" class="btn btn-primary mb-2" type="submit"
                                    id="button-addon2"><i class="menu-icon tf-icons bx bx-plus-circle"></i> Daftar</a>
                            @endcan
                            @if ($status_daftar == 1)
                                <a href="{{ route('student.registration.generateFormulir') }}"
                                    class="btn btn-secondary mb-2" type="submit" id="button-addon2"><i
                                        class="menu-icon tf-icons bx bxs-file-pdf"></i>
                                    Print</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "Ingin menghapus data ini ?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: [
                    'BATAL',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "/student/registration/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            console.log(response)
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'Hapus data berhasil!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'Hapus Data Gagal!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endsection
