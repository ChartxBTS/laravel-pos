<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    // Contar el número total de productos en la base de datos
    $total_products_count = Product::count();

    // Obtener todas las órdenes con sus productos y pagos
    $orders = Order::with(['items', 'payments'])->get();

    // Contar el número de clientes
    $customers_count = Customer::count();

    return view('home', [
        'total_products_count' => $total_products_count,  // Pasar el conteo de productos a la vista

        'orders_count' => $orders->count(),
        
        // Calcular el ingreso total
        'income' => $orders->map(function($i) {
            if ($i->receivedAmount() > $i->total()) {
                return $i->total();
            }
            return $i->receivedAmount();
        })->sum(),

        // Calcular el ingreso de hoy
        'income_today' => $orders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
            if ($i->receivedAmount() > $i->total()) {
                return $i->total();
            }
            return $i->receivedAmount();
        })->sum(),

        // Contar el número total de clientes
        'customers_count' => $customers_count
    ]);
}

}
