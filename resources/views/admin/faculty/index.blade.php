@extends('layouts.app')
@section('title', 'Fakultas')

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

                            @can('faculties.create')
                                <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary mb-2" type="submit"
                                    id="button-addon2"><i class="menu-icon tf-icons bx bx-plus-circle"></i> Tambah</a>
                            @endcan
                            <form action="{{ route('admin.faculty.index') }}" method="get">
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
                                            <th class="text-white">Fakultas</th>
                                            <th class="text-white" style="width:20%; text-align:center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($faculties as $no => $faculty)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$no + ($faculties->currentPage() - 1) * $faculties->perPage() }}
                                                </td>
                                                <td>{{ $faculty->name }}</td>

                                                <td style="width:20%; text-align:center">
                                                    @can('faculties.edit')
                                                        <a href="{{ route('admin.faculty.edit', $faculty->id) }}"
                                                            class="btn btn-warning btn-sm"> <i class="menu-icon bx bx-edit"></i>
                                                            Edit</a>
                                                    @endcan
                                                    @can('faculties.delete')
                                                        <button onClick="Delete(this.id)" id="{{ $faculty->id }}"
                                                            class="btn btn-danger btn-sm"> <i class="menu-icon bx bx-trash"></i>
                                                            Delete</button>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div>
                                    {{ $faculties->links() }}
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
                        url: "/admin/faculty/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
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
