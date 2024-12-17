<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buy;
use App\Models\Sell;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vendas dos últimos 12 meses
        $salesData = DB::table('sells')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select(
                DB::raw("DATE_FORMAT(sells.created_at, '%Y-%m') as month"),
                DB::raw("SUM(sells.quantity * (products.sell_price - sells.discount)) as total_sales")
            )
            ->where('sells.created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(sells.created_at, '%Y-%m')"))
            ->orderBy('month', 'ASC')
            ->get();

        // Compras dos últimos 12 meses
        $buyData = DB::table('buys')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("SUM(quantity * buy_price) as total_buys")
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month', 'ASC')
            ->get();

        // Comparativo Total de Vendas vs Compras
        $comparativeData = DB::select("
            SELECT 'Vendas' AS category, SUM(s.quantity * (p.sell_price - s.discount)) AS total
            FROM sells s
            JOIN products p ON s.product_id = p.id
            UNION ALL
            SELECT 'Compras' AS category, SUM(b.quantity * b.buy_price) AS total
            FROM buys b
        ");

        // Estoque atual dos produtos
        $stockData = DB::table('products')
            ->select('name as product_name', 'stock')
            ->where('stock', '>', 0)
            ->orderBy('stock', 'DESC')
            ->get();

        // Produtos mais vendidos
        $topSellingProducts = DB::table('sells')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(sells.quantity) as total_sold')
            )
            ->groupBy('products.name')
            ->orderBy('total_sold', 'DESC')
            ->limit(10)
            ->get();

        // Passando os dados para a view
        return view('dashboard.index', [
            'salesData' => $salesData,
            'buyData' => $buyData,
            'comparativeData' => $comparativeData,
            'stockData' => $stockData,
            'topSellingProducts' => $topSellingProducts
        ]);
    }
}
