
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product List</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e1b4b);
            color: #f8fafc;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .header p {
            margin: 6px 0 0;
            color: #94a3b8;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .add-btn, .logout-btn {
            display: inline-block;
            padding: 12px 18px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .add-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .add-btn:hover {
            background: #4f46e5;
        }

        .logout-btn {
            background: #dc2626;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid #22c55e;
            color: #86efac;
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .table-card {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 16px;
            overflow-x: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: rgba(99, 102, 241, 0.2);
            color: #c4b5fd;
            padding: 16px;
            text-align: left;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            color: #e2e8f0;
        }

        tbody tr:hover {
            background: rgba(99, 102, 241, 0.08);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .price {
            color: #86efac;
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .edit {
            background: #f59e0b;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .edit:hover {
            background: #d97706;
        }

        .delete {
            background: #ef4444;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .delete:hover {
            background: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
        }

        @media (max-width: 800px) {
            body {
                padding: 20px 10px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            table {
                min-width: 800px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>📦 Product List</h1>
            <p>Manage your products easily</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('products.create') }}" class="add-btn">
                + Add New Product
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->qty }}</td>
                        <td class="price">
                            ₱{{ number_format($product->price, 2) }}
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="edit">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            📭 No products found.
                            <br>
                            Click "Add New Product" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
