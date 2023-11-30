@extends('layouts.app')
@section('title', 'Show Data')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>

            <div class="row">
                <div class="col-xl-12">
                    <h5 class="text-header"> @yield('title') Pendaftaran</h5>


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
