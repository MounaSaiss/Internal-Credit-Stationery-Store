<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store()
    {
        $cart = session()->get('cart', []);

        $user = Auth::user();

        if (count($cart) === 0) {
            return redirect()->back()->with('error', 'Votre panier est vide !');
        }

        $standardItems = [];
        $premiumItems = [];

        $totalCost = 0;

        try {

            DB::transaction(function () use ($user, $cart, &$premiumItems, &$standardItems, &$totalCost) {
                foreach ($cart as $id => $details) {
                    $product = Product::lockForUpdate()->find($id);

                    if (!$product || $product->stock < $details['quantity']) {
                        throw new \Exception("Le produit {$details['name']} est en rupture de stock !");
                    }

                    $linePrice = $product->price * $details['quantity'];
                    $totalCost += $linePrice;
                    $itemData = [
                        'product_id' => $id,
                        'quantity' => $details['quantity'],
                        'price' => $product->price,
                        'total' => $linePrice
                    ];


                    if ($product->type === 'premium') {
                        $premiumItems[] = $itemData;
                    } else {
                        $standardItems[] = $itemData;
                    }
                }

                if ($user->token < $totalCost) {
                    throw new \Exception("Solde insuffisant ! Il vous manque des tokens.");
                }

                $user->token -= $totalCost;
                $user->save();

                if (!empty($standardItems)) {
                    $stdOrderTotal = array_sum(array_column($standardItems, 'total'));
                    $order1 = Order::create([
                        'user_id' => $user->id,
                        'total_price' => $stdOrderTotal,
                        'status' => 'approved',
                    ]);
                    foreach ($standardItems as $item) {
                        $this->createOrderItem($order1->id, $item);
                    }
                }

                if (!empty($premiumItems)) {
                    $prmOrderTotal = array_sum(array_column($premiumItems, 'total'));
                    $order2 = Order::create([
                        'user_id' => $user->id,
                        'total_price' => $prmOrderTotal,
                        'status' => 'pending',
                    ]);

                    foreach ($premiumItems as $item) {
                        $this->createOrderItem($order2->id, $item);
                    }
                }
            });

            session()->forget('cart');
            if (!empty($premiumItems) && !empty($standardItems)) {
                return redirect()->route('shop.index')->with('success', 'Votre commande a été divisée. Les articles standards sont validés, les articles premium sont en attente.');
            } elseif (!empty($premiumItems)) {
                return redirect()->route('shop.index')->with('success', 'Commande créée ! En attente de validation (Premium).');
            } else {
                return redirect()->route('shop.index')->with('success', 'Commande validée avec succès !');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function createOrderItem($orderId, $itemData)
    {
        Product::find($itemData['product_id'])->decrement('stock', $itemData['quantity']);

        OrderItem::create([
            'order_id' => $orderId,
            'product_id' => $itemData['product_id'],
            'quantity' => $itemData['quantity'],
            'token_price' => $itemData['price'],
        ]);
    }
}
