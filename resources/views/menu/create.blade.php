@extends('admin.admin_master')
@section('index')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item active">Add Menu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


                    <div class="card ">
                        <div class="card-body">
                            <h5 class="card-title">Add Menu</h5>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                            <!-- Floating Labels Form -->
                            <form class="row g-3" method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input value="{{ old('menu') }}" name="menu" type="text" class="form-control" id="menu" placeholder="Name Menu">
                                        <label for="menu">Menu</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input value="{{ old('jumlah') }}" name="jumlah" type="number" class="form-control" id="jumlah"
                                            placeholder="jumlah">
                                        <label for="jumlah">Jumlah</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input value="{{ old('harga') }}" name="harga" type="number" class="form-control" id="floatingHarga" placeholder="Your Harga">
                                        <label for="floatingHarga">harga</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_Barang" class="form-label">Gambar menu</label>
                                    <input class="form-control" type="file" name="gambar_barang" id="gambar_Barang">

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End floating Labels Form -->
                        </div>
                    </div>





@endsection
