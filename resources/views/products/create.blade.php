<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add New Product - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f4ece2; /* Sesuaikan tema dengan layout lain */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2);
        }
        label {
            font-weight: 600;
            color: #343a40;
        }
        input.form-control, textarea.form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input.form-control:focus, textarea.form-control:focus {
            border-color: #B38867;
            box-shadow: 0 0 5px rgba(179, 136, 103, 0.5);
            outline: none;
        }
        .btn-primary {
            background: #B38867;
            border: none;
            border-radius: 0.6rem;
            padding: 0.7rem 2rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 5px 15px rgba(179, 136, 103, 0.4);
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #8B5E3C;
            box-shadow: 0 8px 20px rgba(139, 94, 60, 0.6);
        }
        .btn-warning {
            border-radius: 0.6rem;
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        }
        .btn-warning:hover {
            box-shadow: 0 6px 18px rgba(255, 193, 7, 0.6);
        }
        .alert-danger {
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }
        h2 {
            color: #B38867;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card p-4 p-md-5 bg-white">
                    <h2>Add New Product</h2>
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" />
                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter product title" />
                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="Enter product price" min="0" step="0.01" />
                                @error('price')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Enter stock quantity" min="0" />
                                @error('stock')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html>
