<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1e1e1e;
            color: white;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background: #2b2b2b;
            color: white;
            border: 1px solid #555;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        button, .cancel {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #f39c12;
            color: white;
        }

        .cancel {
            background: #555;
            color: white;
            margin-left: 5px;
        }

        .errors {
            background: #c0392b;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Product</h1>

    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">

        <label>Quantity</label>
        <input type="number" name="qty" value="{{ old('qty', $product->qty) }}">

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">

        <label>Description</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>

        <button type="submit">Update Product</button>

        <a href="{{ route('products.index') }}" class="cancel">
            Cancel
        </a>

    </form>

</div>

</body>
</html>