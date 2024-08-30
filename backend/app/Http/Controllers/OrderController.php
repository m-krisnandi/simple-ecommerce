<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    public function index()
{
    try {
        $orders = Auth::user()->orders()->with('items.product')->get();

        return response()->json(
            ResponseHelper::successResponse($orders, 'Orders retrieved successfully', 200),
            200
        );
    } catch (\Exception $e) {
        return response()->json(
            ResponseHelper::errorResponse('Failed to retrieve orders', 500),
            500
        );
    }
}


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'items' => 'required|array',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            // Inisialisasi total harga
            $totalPrice = 0;
            $items = $validatedData['items'];

            // Membuat order baru
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => 0, // Akan diperbarui setelah kalkulasi total harga
                'status' => 'pending',
            ]);

            // Menambahkan items ke order dan menghitung total harga
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $orderItem = new OrderItem([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
                $order->items()->save($orderItem);

                $totalPrice += $product->price * $item['quantity'];
            }

            // Memperbarui total harga di order
            $order->update(['total_price' => $totalPrice]);

            // Mengembalikan respons sukses
            return response()->json(
                ResponseHelper::successResponse($order->load('items.product'), 'Order created successfully', 201),
                201
            );
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(
                ResponseHelper::errorResponse('Failed to create order', 500),
                500
            );
        }
    }

    public function show($id)
    {
        try {
            // Mengambil order dengan detail item dan produk
            $order = Order::with('items.product')->findOrFail($id);

            // Mengembalikan respons sukses
            return response()->json(
                ResponseHelper::successResponse($order, 'Order details retrieved successfully', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            // Mengembalikan respons error jika order tidak ditemukan
            return response()->json(
                ResponseHelper::errorResponse('Order not found', 404),
                404
            );
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'status' => 'required|string',
            ]);

            // Mengambil order dan memperbarui statusnya
            $order = Order::findOrFail($id);
            $order->update(['status' => $validatedData['status']]);

            // Mengembalikan respons sukses
            return response()->json(
                ResponseHelper::successResponse($order, 'Order updated successfully', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            // Mengembalikan respons error jika order tidak ditemukan
            return response()->json(
                ResponseHelper::errorResponse('Order not found', 404),
                404
            );
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(
                ResponseHelper::errorResponse('Failed to update order', 500),
                500
            );
        }
    }

    public function destroy($id)
    {
        try {
            // Mengambil order dan menghapusnya
            $order = Order::findOrFail($id);
            $order->delete();

            // Mengembalikan respons sukses
            return response()->json(
                ResponseHelper::successResponse((object) [], 'Order deleted successfully', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            // Mengembalikan respons error jika order tidak ditemukan
            return response()->json(
                ResponseHelper::errorResponse('Order not found', 404),
                404
            );
        } catch (\Exception $e) {
            // Mengembalikan respons error jika terjadi kesalahan
            return response()->json(
                ResponseHelper::errorResponse('Failed to delete order', 500),
                500
            );
        }
    }
}
