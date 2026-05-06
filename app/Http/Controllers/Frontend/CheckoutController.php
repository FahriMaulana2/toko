<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'courier' => 'required|string',
            'cart' => 'required|array',
            'cart.*.id' => 'required',
            'cart.*.name' => 'required',
            'cart.*.price' => 'required|numeric',
            'cart.*.quantity' => 'required|integer|min:1',
        ]);

        $cart = $request->cart;
        
        // Hitung total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shippingCost = 20000;
        $grandTotal = $subtotal + $shippingCost;
        
        // Generate Order ID
        $orderNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        
        DB::beginTransaction();
        
        try {
            // 1. Simpan Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => auth()->id(),
                'total_amount' => $subtotal,
                'shipping_cost' => $shippingCost,
                'grand_total' => $grandTotal,
                'status' => 'pending',
                'notes' => 'Order via WhatsApp',
            ]);
            
            // 2. Simpan Order Items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
            
            // 3. Simpan Payment
            Payment::create([
                'order_id' => $order->id,
                'amount' => $grandTotal,
                'payment_method' => 'whatsapp',
                'status' => 'pending',
            ]);
            
            // 4. Simpan Shipment
            Shipment::create([
                'order_id' => $order->id,
                'recipient_name' => $request->fullname,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'courier' => $request->courier,
                'status' => 'pending',
            ]);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'order_number' => $orderNumber,
                'total' => number_format($grandTotal, 0, ',', '.'),
                'message' => 'Order berhasil disimpan!'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan order: ' . $e->getMessage()
            ], 500);
        }
    }
}