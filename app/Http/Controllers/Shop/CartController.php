<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        $cart = session()->get('cart', []);

        $currentCartTotal = 0;

        foreach ($cart as $item) {
            $currentCartTotal += $item['price'] * $item['quantity'];
        }

        if (($currentCartTotal + $product->price) > $user->token) {
            return redirect()->back()->with('error', 'Solde insuffisant ! Vous n\'avez pas assez de tokens.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "type" => $product->type,
            ];
        }

        session()->put('cart', $cart);
        // dd(session('cart'));
        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }
}
