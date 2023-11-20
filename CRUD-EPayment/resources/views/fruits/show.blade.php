<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tria Y</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Arvo&family=Oswald:wght@200;500&family=Signika+Negative:wght@600&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link href="/public/assets/vendor/simple-datatables/style.css" rel="stylesheet" />
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('storage/fruits/'.$fruits->image) }}" class="w-100 rounded">
                        <hr>
                        <label for="">Nama Buah</label>
                        <h4>{{ $fruits->nama }}</h4>
                        <label for="">Jenis Buah</label>
                        <p class="tmt-3">
                            {!! $fruits->jenis !!}
                        </p>
                        <label for="">Harga /Kg</label>
                        <p class="tmt-3">
                            {!! $fruits->harga !!}
                        </p>
                        <label for="">Stok /Kg</label>
                        <p class="tmt-3">
                            {!! $fruits->stok !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>