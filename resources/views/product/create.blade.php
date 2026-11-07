<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>

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

        .form-container {
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

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }

        input[type="submit"] {
            background-color:#333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color:coral;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Create Product</h1>

        <form method="post" action="{{route('products.store')}}">
            @csrf
            {{-- @method('post') --}}

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Product Name" required>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="qty" placeholder="Enter Quantity" required>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" placeholder="Enter Price" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" placeholder="Optional Description">
            </div>

            <input type="submit" value="Save Product">
        </form>
    </div>
</body>
</html>


<!-- @csrf နဲ့ @method('post')
CSRF Token, မပါရင် request ကို လက်မခံပါဘူး။
Blade Template ထဲမှာ formတစ်ခုရေးတဲ့အခါ secure HTTP request method ကို ထိန်းချုပ်ဖို အသုံးပြုတဲ့
important directives
CSRF = Cross-Site Request Forgery Attack ကိုကာကွယ်ဖို Laravel ကပြုလုပ်ထားတဲ့ Token ပါ।
အသုံးပြုသူ form submit လုပ်တဲ့အခါ ပိုလာသော data ဟာ တကယ် legitimate user ကနေတကယ် submit လုပ်တာပဲဖြစ်တယ်ဆိုတာ Laravel က verify လုပ်ဖို token တစ်ခုပေးထားတာဖြစ်တယ်။
laravel form အတွင်းမှာ @csrf မထည့်ရင် submit လည်းမရပါဘူး။
Token မပါရင် Laravel က 419 Page Expired error ပြတတ်တယ်။ -->
