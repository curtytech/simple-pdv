<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buy;
use App\Models\Sell;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Vendas dos últimos 12 meses
        // Gerar os últimos 12 meses
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        // Vendas dos últimos 12 meses
        $rawSalesData = DB::table('sells')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select(
                DB::raw("DATE_FORMAT(sells.created_at, '%Y-%m') as month"),
                DB::raw("SUM(sells.quantity * (products.sell_price)) as total_sales")
            )
            ->where('sells.created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(sells.created_at, '%Y-%m')"))
            ->orderBy('month', 'ASC')
            ->get();

        // Compras dos últimos 12 meses
        $rawBuyData = DB::table('buys')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("SUM(quantity * buy_price) as total_buys")
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month', 'ASC')
            ->get();

        // Mesclar os meses com os dados de vendas
        $salesData = $months->map(function ($month) use ($rawSalesData) {
            $data = $rawSalesData->firstWhere('month', $month);
            return [
                'month' => $month,
                'total_sales' => $data ? $data->total_sales : 0
            ];
        });

        // Mesclar os meses com os dados de compras
        $buyData = $months->map(function ($month) use ($rawBuyData) {
            $data = $rawBuyData->firstWhere('month', $month);
            return [
                'month' => $month,
                'total_buys' => $data ? $data->total_buys : 0
            ];
        });
        // Comparativo Total de Vendas vs Compras
        // $comparativeData = DB::select("
        //     SELECT 'Vendas' AS category, SUM(s.quantity * (p.sell_price - s.discount)) AS total
        //     FROM sells s
        //     JOIN products p ON s.product_id = p.id
        //     UNION ALL
        //     SELECT 'Compras' AS category, SUM(b.quantity * b.buy_price) AS total
        //     FROM buys b
        // ");

        // Produtos mais vendidos
        $topSellingProducts = DB::table('sells')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(sells.quantity) as total_sold')
            )
            ->groupBy('products.name')
            ->orderBy('total_sold', 'DESC')
            ->limit(3)
            ->get();

        $totalSoldThisMonth = DB::table('sells')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select(
                DB::raw("SUM(sells.quantity * (products.sell_price)) as total_sales")
            )
            ->whereMonth('sells.created_at', now()->month) 
            ->whereYear('sells.created_at', now()->year)  
            ->value('total_sales'); 

        $totalBoughtThisMonth = DB::table('buys')
            ->select(
                DB::raw("SUM(buys.quantity * buys.buy_price) as total_bought")
            )
            ->whereMonth('buys.created_at', now()->month) 
            ->whereYear('buys.created_at', now()->year)  
            ->value('total_bought'); 

        $totalBoughtThisYear = DB::table('buys')
            ->select(
                DB::raw("SUM(buys.quantity * buys.buy_price) as total_bought")
            )
            ->whereYear('buys.created_at', now()->year)  
            ->value('total_bought_year'); 

        // $novemberSales = DB::table('sells')
        //     ->join('products', 'sells.product_id', '=', 'products.id')
        //     ->select(
        //         DB::raw("SUM(sells.quantity * (products.sell_price)) as total_sales")
        //     )
        //     ->whereMonth('sells.created_at', 12)
        //     ->whereYear('sells.created_at', now()->year)
        //     ->get();

        // dd($novemberSales);

        // Passando os dados para a view
        return view('dashboard.index', [
            'salesData' => $salesData,
            'buyData' => $buyData,
            'topSellingProducts' => $topSellingProducts,
            'totalSoldThisMonth' => $totalSoldThisMonth,
            'totalBoughtThisMonth' => $totalBoughtThisMonth,
            'totalBoughtThisYear' => $totalBoughtThisYear,
        ]);
    }
}
