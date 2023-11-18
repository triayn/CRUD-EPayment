<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link href="/public/assets/vendor/simple-datatables/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">List Sayuran</h3>
                    <h5 class="text-center"><a href="https://github.com/triayn">Github : triayn</a></h5>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('fruits.create') }}" class="btn btn-outline-success mb-3">Tambah List Sayuran</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Buah</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Harga /Kg</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fruits as $fruit)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $fruit->nama }}</td>
                                    <td>{{ $fruit->jenis }}</td>
                                    <td>{{ $fruit->harga }}</td>
                                    <td>{{ $fruit->stok }}</td>
                                    <td class="center">
                                    <img src="{{ asset('/storage/fruits/'.$fruit->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('fruits.destroy', $fruit->id) }}" method="POST">
                                            <a href="{{ route('fruits.show', $fruit->id) }}"
                                                class="btn btn-outline-warning">SHOW</a>
                                            <a href="{{ route('fruits.edit', $fruit->id) }}"
                                                class="btn btn-outline-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Post belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $fruits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="public/assets/vendor/simple-datatables/simple-datatables.js"></script>

</body>

</html>