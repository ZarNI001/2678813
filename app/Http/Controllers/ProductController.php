<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }
   public function store(Request $request){
        //Data အားလုံးကို Laravel ရဲ့ Request object ထဲမှာ လက်ခံ
        //User ရဲ့ request ကို $request ထဲမှာ လက်ခံတယ်။
        // dd($request);
        // dd($request->name);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // $newProduct=Product::create($data);

        Product::create($data);

        return redirect()->route('products.create');

        /*
        Product::create($data) က database ထဲ insert လုပ်တယ်။
        $newProduct ကိုမသုံးလည်းရတယ်။
        Produts, Database table နဲ့ ဆက်နွယ်ထားတဲ့ Model Class (products table ကို ကိုယ်စားပြုတဲ့ model)
        ::create(), Laravel Eloquent မှာရှိတဲ့ method တစ်ခု $data ထဲက validated data တွေကို အသုံးပြုပြီး database ထဲသို automatic insert လုပ်ပေးတယ်။
        $data, $request->validate([...]) ကနေလာတဲ့ data ဖြစ်ပြီး, array format (key => value)နဲ့ ပြင်ဆင်ထားပြီဖြစ်တယ်။
        */
    }
    public function search(Request $request){
        $searchTerm = $request->input('query');
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->get();
        return view('product.search', compact('products'));
    }
}
