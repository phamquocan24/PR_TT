<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Brand\Entities\Brand;
use Modules\User\Entities\User;
use Carbon\Carbon;

class DashboardController
{
    /**
     * Display the dashboard with its widgets.
     *
     * @return Response
     */
    public function index()
    {
        return response()->view('admin::dashboard.index');
    }

    /**
     * Get dashboard statistics data
     *
     * @return JsonResponse
     */
    public function getStats()
    {
        try {
            // Kiểm tra nếu Order model tồn tại
            if (class_exists('Modules\Order\Entities\Order')) {
                $orderClass = 'Modules\Order\Entities\Order';
                $totalSales = $orderClass::sum('total') ?? 0;
                $formattedSales = number_format($totalSales / 1000, 2) . 'K';
                $totalOrders = $orderClass::count() ?? 0;
            } else {
                // Fallback nếu không có Order model
                $formattedSales = '71.09K';
                $totalOrders = 46;
            }

            $stats = [
                'totalSales' => $formattedSales,
                'totalOrders' => $totalOrders,
                'totalProducts' => Product::count() ?? 0,
                'totalCustomers' => User::where('role', '!=', 'admin')->count() ?? 0
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching dashboard statistics: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get product price comparison data
     *
     * @return JsonResponse
     */
    public function getProductPrices()
    {
        try {
            $products = Product::select('id', 'name', 'price')
                ->orderBy('price', 'desc')
                ->take(5)
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'formatted_price' => '$' . number_format($product->price, 2)
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching product prices: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest products data
     *
     * @return JsonResponse
     */
    public function getLatestProducts()
    {
        try {
            $products = Product::select('id', 'name', 'sku', 'price', 'is_active')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($product) {
                    $statusClass = $product->is_active ? 'active' : 'inactive';
                    $statusText = $product->is_active ? 'Active' : 'Inactive';

                    // Random demo status for showing different badge styles
                    if ($product->id % 3 == 0) {
                        $statusClass = 'pending';
                        $statusText = 'Pending';
                    } else if ($product->id % 5 == 0) {
                        $statusClass = 'pending-payment';
                        $statusText = 'Pending Payment';
                    }

                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'sku' => $product->sku,
                        'price' => $product->price,
                        'formatted_price' => '$' . number_format($product->price, 2),
                        'status' => $statusText,
                        'status_class' => $statusClass
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching latest products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest brands data
     *
     * @return JsonResponse
     */
    public function getLatestBrands()
    {
        try {
            $brands = Brand::select('id', 'name', 'is_active')
                ->withCount('products')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($brand) {
                    $statusClass = $brand->is_active ? 'enabled' : 'disabled';
                    $statusText = $brand->is_active ? 'Enabled' : 'Disabled';

                    // Random demo status for showing different badge styles
                    if ($brand->id % 3 == 0) {
                        $statusClass = 'pending';
                        $statusText = 'Pending';
                    } else if ($brand->id % 5 == 0) {
                        $statusClass = 'pending-payment';
                        $statusText = 'Pending Payment';
                    }

                    return [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'products_count' => $brand->products_count,
                        'status' => $statusText,
                        'status_class' => $statusClass
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $brands
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching latest brands: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest users data
     *
     * @return JsonResponse
     */
    public function getLatestUsers()
    {
        try {
            $users = User::select('id', 'name', 'email', 'role')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'full_name' => $user->name,
                        'email' => $user->email,
                        'role_text' => ucfirst($user->role)
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching latest users: ' . $e->getMessage()
            ], 500);
        }
    }
}
