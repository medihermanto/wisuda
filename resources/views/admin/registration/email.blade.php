<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Email Notify</title>
    <style>
        body {
            background-color: #bdc3c7;
            margin: 0;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin: 20%;
            text-align: center;
            margin: 0px auto;
            width: 580px;
            max-width: 580px;
            margin-top: 10%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .garis {
            width: 75%;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="">{{ $mailData['title'] }}</h3>
        <p>Hai {{ $mailData['fullname'] }}, terimakasih sudah melakukan pendaftaran wisuda Gelombang I Periode
            2023/2024, berikut ini adalah data yang sudah anda kirimkan, </p>
        <p class="">Nama Lengkap : {{ $mailData['fullname'] }}</p>
        <p class=""> NPM :{{ $mailData['npm'] }}</p>
        <p class="">Email : {{ $mailData['email'] }}</p>
        <p>Status Pendaftaran : <span class="badge text-bg-warning">Berhasil</span></p>
        <hr class="garis">
        <h4>Email ini dikirimkan secara otomatis oleh sistem, mohon untuk tidak dibalas, Terimakasih</h4>
    </div>
</body>

</html>
