@extends('layouts.app')
@section('title', 'Permission')

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
                            <form action="{{ route('admin.permission.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..."
                                        aria-label="Recipient's username" name="q" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                            class="menu-icon tf-icons bx bx-search-alt"></i> Search</button>
                                </div>
                            </form>

                            <div class="table-responsive text-nowrap mt-2">
                                <table class="table table-hover table-striped">
                                    <thead class='table-dark'>
                                        <tr>
                                            <th style="width:10%;text-align:center">No</th>
                                            <th>Nama Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($permissions as $no => $permission)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ++$no + ($permissions->currentPage() - 1) * $permissions->perPage() }}
                                                </td>
                                                <td>{{ $permission->name }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div>
                                    {{ $permissions->links() }}
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
@endsection
