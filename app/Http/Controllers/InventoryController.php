<?php

namespace App\Http\Controllers;

use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();

        $totalSpent = $inventories->sum('bought_for');
        $totalSold = $inventories->sum('sold_for');

        $totalProfit = $inventories->reduce(function ($carry, $item) {
            return $carry + ($item->sold_for ? $item->sold_for - $item->bought_for : 0);
        }, 0);

        return view('inventories.index', [
            'inventories' => $inventories,
            'totalSpent' => $totalSpent,
            'totalSold' => $totalSold,
            'totalProfit' => $totalProfit,
        ]);
    }
}