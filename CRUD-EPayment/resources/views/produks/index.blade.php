<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Produk - Tria Y</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data produk</h3>
                    <h5 class="text-center"><a href="https://github.com/triayn">Github : triayn</a></h5>         
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('produks.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PRODUK</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Vatian</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Image</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($produks as $produk)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $produk->kode_produk }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->varian }}</td>
                                    <td>{{ $produk->ukuran }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/produks/'.$produk->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produks.destroy', $produk->id) }}" method="POST">
                                            <a href="" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
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
                          {{ $produks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    

    <!-- <script>
        message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script> -->

</body>
</html>
