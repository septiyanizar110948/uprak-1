@extends('admin.admin_master')

@section('index')
@section('style')
    <style>
        .product-photocard {
            width: 100%;
            /* Adjusted for responsiveness */
            height: auto;
            background-color: #fff;
            overflow: hidden;
            margin-bottom: 2rem;
            /* Adjusted for spacing */
        }

        .product-photocard-img {
            width: 100%;
            height: 200px; /* Set a fixed height for all images */
            object-fit:

        }
    </style>
@endsection

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">menu</li>
            <li class="breadcrumb-item active">List menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <h5 class="card-title">nighuer store</h5>
            <div class="mb-3 ms-0">
                <a class="btn btn-success" href="{{ route('menu.create') }}">Tambah +</a>
            </div>

            {{-- ini card foreach start --}}
            @foreach ($menu as $menuItem)
                <!-- Card with an image on top -->
                <div class="col-md-6 col-lg-4">
                    <div class="card product-photocard">
                        <img src="{{ asset($menuItem->gambar_barang) }}" class="card-img-top product-photocard-img"
                            alt="{{ asset($menuItem->gambar_barang) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menuItem->menu }}</h5>
                            <p class="card-text">Harga : Rp. {{ $menuItem->harga }}</p>
                            <p class="card-text">
                                <a href="#" class="btn btn-primary" id="add-to-cart-{{ $menuItem->id }}"
                                    onclick="addToCart('{{ $menuItem->id }}', '{{ $menuItem->menu }}', {{ $menuItem->harga }})">
                                    Tambah ke keranjang
                                </a>
                            </p>
                        </div>
                    </div><!-- End Card with an image on top -->
                </div>
            @endforeach
            {{-- ini card foreach end --}}
        </div>
    </div>
    <div class="col-md-4">
        <div style="display: flex; justify-content: center">
            <h5>Order List</h5>
        </div>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <tr id="cart-row-template" style="display: none;">
                        <td class="item-number"></td>
                        <td data-item-id="" class="item-name"></td>
                        <td>
                            <button class="btn btn-sm btn-danger remove-item">Kurang</button>
                            <span class="item-quantity"></span>
                            <button class="btn btn-sm btn-success add-item">Tambah</button>
                        </td>
                        <td class="item-price"></td>
                        <td class="total-price"></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Semua</th>
                        <th id="total-all">0</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection
