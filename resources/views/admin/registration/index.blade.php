@extends('layouts.app')
@section('title', 'Daftar Wisuda')

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

                            @can('registrations.create')
                                <a href="{{ route('admin.registration.create') }}" class="btn btn-primary mb-2" type="submit"
                                    id="button-addon2"><i class="menu-icon tf-icons bx bx-plus-circle"></i> Tambah</a>
                            @endcan
                            <form action="{{ route('admin.registration.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..."
                                        aria-label="Recipient's username" name="q" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                            class="menu-icon tf-icons bx bx-search-alt"></i> Search</button>
                                </div>
                            </form>

                            <div class="table-responsive mt-2">
                                <table class="table table-hover table-striped">
                                    <thead class='table-dark'>
                                        <tr>
                                            <th class="text-white" style="width:10%;text-align:center">No</th>
                                            <th class="text-white" style="width:15%">NPM</th>
                                            <th class="text-white" scope="col">Nama</th>
                                            <th class="text-white" scope="col">Fakultas</th>
                                            <th class="text-white" scope="col">Program Studi</th>
                                            <th class="text-white" scope="col">Status</th>
                                            <th class="text-white" style="width:25%; text-align:center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($registrations as $no => $registration)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$no + ($registrations->currentPage() - 1) * $registrations->perPage() }}
                                                </td>
                                                <td>{{ $registration->npm }}</td>
                                                <td>{{ $registration->fullname }}</td>
                                                <td>{{ $registration->departement->name }}</td>
                                                <td>{{ $registration->fullname }}</td>
                                                <td>{{ $registration->fullname }}</td>
                                                <td style="width:20%; text-align:center">
                                                    @can('registrations.edit')
                                                        <a href="{{ route('admin.registration.edit', $registration->id) }}"
                                                            class="btn btn-warning btn-sm mt-2"> <i
                                                                class="menu-icon bx bx-edit"></i>
                                                            Edit</a>
                                                    @endcan
                                                    @can('registrations.edit')
                                                        <a href="{{ route('admin.registration.show', $registration->id) }}"
                                                            class="btn btn-secondary btn-sm mt-2"> <i
                                                                class="menu-icon bx bx-show"></i>
                                                            Show</a>
                                                    @endcan
                                                    @can('registrations.delete')
                                                        <button onClick="Delete(this.id)" id="{{ $registration->id }}"
                                                            class="btn btn-danger btn-sm mt-2"> <i
                                                                class="menu-icon bx bx-trash"></i>
                                                            Delete</button>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div>
                                    {{ $registrations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
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
                        url: "/admin/registration/" + id,
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
