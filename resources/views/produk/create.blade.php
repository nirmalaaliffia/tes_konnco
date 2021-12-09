@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
           Tambah Produk Baru
        </div>
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlInput1">Nama Produk</label>
            <input class="form-control" id="nama_produk" name="nama_produk" type="text" placeholder="nama produk" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlTextarea1">Harga Produk</label>
            <input class="form-control" id="harga_produk" name="harga_produk" type="number" placeholder="harga produk" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlTextarea1">Status Produk</label>
            <select class="form-select" aria-label="Default select example" id="status_produk" name="status_produk" required>
                <option selected>Pilih status produk</option>
                <option value="1">Siap Dirilis</option>
                <option value="2">Belum Siap Dirilis</option>
                <option value="3">Menunggu Moderasi</option>
              </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="exampleFormControlTextarea1">Gambar Produk</label>
            <input class="form-control" id="gambar_produk[]" name="gambar_produk[]" type="file" multiple required>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-w-m btn-block" type="submit"><i class="fa fa-save"></i> Simpan</button> &emsp;
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-w-m btn-block" type="button"><i class="fa fa-reply"></i> Kembali</a>
        </div>
    </form>
        </div>

    </div>
@endsection
