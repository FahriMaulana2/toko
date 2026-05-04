<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }
    
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'courier' => 'required',
            'bank_name' => 'required',
            'account_name' => 'required',
            'payment_proof' => 'required|image|max:2048',
        ]);
        
        // Ambil cart dari localStorage (dikirim via JS nanti)
        // Untuk sementara redirect ke success
        return redirect()->route('checkout.success', ['orderNumber' => 'TEST-123']);
    }
    
    public function success($orderNumber)
    {
        return view('frontend.checkout.success', compact('orderNumber'));
    }
}