@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
           Daftar Produk
        </div>
        <div class="card-body">
          @if(session()->has('success'))
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

          <a href="{{ route('produk.create') }}" class="btn btn-primary" type="button"><i class="fa fa-plus"></i>  Tambah Produk Baru +</a>
        
          <br><br>
            <table id="tabel_produk" class="table table-striped">
                <thead>
                  <tr>
                    <th   style="width:5%"scope="col">#</th>
                    <th  style="width:40%" scope="col">Produk</th>
                    <th  style="width:10%" scope="col">Harga</th>
                    <th   style="width:20%"scope="col">Status Produk</th>
                    <th  style="width:30%" scope="col">Tanggal Pembuatan</th>
                    <th style="width:5%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; ?>
                  @foreach ($produk as $produk) 
                  <?php $i++; ?>
                  <tr>
                    <th scope="row"> {{ $i }}</th>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>Rp {{ $produk->harga }}</td>
                    <td>
                      
                      @if ( $produk->status  == 1)
                        Siap Dirilis
                    @elseif($produk->status  == 2)
                        Belum Dirilis
                        @else
                        Menunggu Moderasi
                       
                    @endif</td>
                    <td>{{ date('d M Y H:i', strtotime($produk->created_at)) }}</td>
                    <td> @if ($produk->id_pembuat == $id_user)
                      <span class="views-number" style="color:red">
                          <a href="{{ route('produk.destroy', $produk->id) }}" style="color:red" class="delete" >
                            <svg class="nav-icon" style="max-width:50%; max-height:20px">
                              <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                          </svg> </a>
                      </span> 
                      @else
                          -
                      @endif
                    </td>
                    
                  </tr>
                  @endforeach
                 
                 
                </tbody>
              </table>
        </div>
    </div>

    <form action="" method="post" id="deleteForm">
      @csrf
      @method("delete")
      <button type="submit" style="display:none">Hapus</button>
  </form>
@endsection

@push('script')
<script src="{{ asset('js/sweetalert.js') }}"></script>
<script>
    $('.delete').on('click', function(e){
            e.preventDefault();

            var href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin hapus data ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                if (result.value) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();

                    Swal.fire(
                        'Berhasil!',
                        'Data telah dihapus.',
                        'success'
                    )
                }
            })
        })
</script>

@endpush