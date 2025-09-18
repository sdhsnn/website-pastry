<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Products - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4ece2;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .card-img-top {
            border-radius: 12px;
            object-fit: cover;
            height: 100%;
        }
        .product-title {
            color: #B38867;
            font-weight: 600;
        }
        .product-price {
            color: #8B4513;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .product-stock {
            font-weight: 500;
        }
        hr {
            border-top: 2px solid #B38867;
        }
        code p {
            background-color: #fff3e0;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-custom">
                    <img src="{{ asset('/storage/products/'.$product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-custom p-3">
                    <div class="card-body">
                        <h3 class="product-title">{{ $product->title }}</h3>
                        <hr>
                        <p class="product-price">{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                        <code>
                            <p>{!! $product->description !!}</p>
                        </code>
                        <hr>
                        <p class="product-stock">Stock: {{ $product->stock }}</p>
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" 
                            class="btn" 
                            style="background-color: #B38867; color: white; font-weight: 500; padding: 8px 20px; border-radius: 8px; text-decoration: none;">
                            Back to Products
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
