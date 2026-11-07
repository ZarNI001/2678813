<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: 0.3s;
            margin-bottom: 10px;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }

        button {
            padding: 10px;
            background-color:#333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Search Products</h1>
        <form action="{{ route('products.search') }}" method="GET">
            @csrf
            @method('post')
            <input type="text" name="query" placeholder="Search by name">
            <button type="submit">Search</button>
        </form>
        @if(isset($products))
            <h2>Search Results:</h2>
            @if($products->isEmpty())
                <p>No products found.</p>
            @else
                <ul>
                    @foreach($products as $product)
                        <li>{{ $product->name }} - {{ $product->qty }} - {{ $product->price }} - {{ $product->description }}</li>
                    @endforeach
                </ul>
            @endif
        @endif



    </div>


</body>
</html>
