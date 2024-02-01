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
    <div class="col-lg-4">

        <!-- Recent Activity -->
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <h1>Order List</h1>
                </div>
                <div class="row" id="orderList">
                    <table style="width: 100%">
                        <tr>
                            {{-- <th>No.</th> --}}
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price/item</th>
                            <th>Price all</th>
                            <th>Action</th>

                        </tr>

                        @foreach ($menu as $item)
                        @endforeach
                    </table>
                </div>
                <hr>
                <div class="row d-flex">
                    <div class="col-8">
                        Total

                    </div>

                    <div class="col-4 text-end">
                        <span class="" id="totalPrice">0.00</span>

                        <button onclick="applyDiscountAndDisplayFinalPrice()">Apply Discount</button>
                        <p>Discounted Price: <span id="finalPrice">0.00</span></p>
                    </div>

                </div>
                <div class="row">
                    <h4>Payment Method</h4>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Extra looong Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>
                    <div class="col-2">
                        <button class="method-button">Method</button>
                    </div>

                </div>
            </div>
        </div><!-- End Recent Activity -->

    </div><!-- End Right side columns -->


</div>
@endsection



@push('script')
<script>
    let orderIdCounter = 1; // Initialize the counter
    let totalOrderPrice = 0; // Initialize the total order price
    let discount = 0; // Initialize the discount
    let itemQuantities = {}; // Dictionary to store item quantities
    let itemPrice = 0; // Initialize itemPrice

    function addToCart(itemId, itemName, itemPrice) {
        // Initialize itemPrice when adding to cart
        window.itemPrice = parseFloat(itemPrice);
        addToOrderList(itemName, itemPrice);
    }

    function addToOrderList(itemName, itemPrice) {
        // Generate a unique ID for the order item
        let itemId = orderIdCounter++; // Use the counter directly

        // Check if the item already exists in the order list
        if (itemQuantities[itemName]) {
            // If yes, increment the quantity and update total price
            updateQuantity(itemId, 1, itemName);
        } else {
            // If not, create a new order item
            createOrderItem(itemId, itemName, itemPrice);
            itemQuantities[itemName] = 1; // Initialize quantity to 1
        }

        // Update the total order price
        totalOrderPrice += parseFloat(itemPrice);
        applyDiscount();
        document.getElementById('totalPrice').innerText = formatPrice(totalOrderPrice);
    }

    // Function to create a new order item
    function createOrderItem(itemId, itemName, itemPrice) {
        let newRow = document.createElement('tr');
        newRow.id = 'orderItem' + itemId; // Concatenate with 'orderItem'
        newRow.innerHTML = `
            <td>${itemName}</td>
            <td id="quantity${itemId}">1</td>
            <td>${itemPrice.toFixed(2)}</td>
            <td id="totalPrice${itemId}">${itemPrice.toFixed(2)}</td>
            <td>
                <button class="btn btn-primary" onclick="updateQuantity(${itemId}, 1, '${itemName}')">+</button>
                <button class="btn btn-primary" onclick="updateQuantity(${itemId}, -1, '${itemName}')">-</button>
            </td>
        `;
        document.querySelector('#orderList table').appendChild(newRow);
    }

    function updateQuantity(itemId, change, itemName) {
        let quantityCell = document.getElementById(`quantity${itemId}`);
        let totalCell = document.getElementById(`totalPrice${itemId}`);
        let currentQuantity = parseInt(quantityCell.innerText, 10);

        // Update the quantity and total price
        quantityCell.innerText = currentQuantity + change;

        // Check if the item still exists in the dictionary
        if (itemQuantities[itemName]) {
            itemPrice = parseFloat(totalCell.innerText) / currentQuantity;
            totalCell.innerText = (currentQuantity + change) * itemPrice;

            // Update itemQuantities dictionary
            itemQuantities[itemName] = currentQuantity + change;
        }

        // Update the total order price
        totalOrderPrice += change * itemPrice;
        applyDiscount();
        document.getElementById('totalPrice').innerText = formatPrice(totalOrderPrice);

        // Remove the item if the quantity is 0
        if (currentQuantity + change === 0) {
            let itemRow = document.getElementById('orderItem' + itemId);
            if (itemRow) {
                itemRow.remove();
            }
            delete itemQuantities[itemName]; // Remove from dictionary
        }
    }

    function applyDiscount() {
        // Apply 10% discount if total order price is greater than or equal to 200000
        if (totalOrderPrice >= 200000) {
            discount = 10; // Set discount to 10%
        } else if (totalOrderPrice >= 100000) {
            discount = 5; // Set discount to 5% if total order price is greater than or equal to 100000
        } else {
            discount = 0; // No discount
        }
    }

    function formatPrice(price) {
        if (discount !== 0) {
            return `${price.toFixed(2)} (-${discount}%)`;
        } else {
            return price.toFixed(2);
        }
    }

    function updateTotalPriceDisplay() {
        document.getElementById('totalPrice').innerText = totalOrderPrice.toFixed(2);
    }

    function applyDiscountAndDisplayFinalPrice() {
        applyDiscount();
        let finalPrice = totalOrderPrice - (totalOrderPrice * (discount / 100));
        document.getElementById('finalPrice').innerText = finalPrice.toFixed(2);
    }
</script>
@endpush

