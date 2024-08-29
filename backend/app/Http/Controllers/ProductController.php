<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const REQUIRED_STRING = 'required|string';

    public function index()
    {
        try {

            $products = Product::all();

            $formattedProducts = [];
            foreach ($products as $product) {
                $formattedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'brand' => $product->brand,
                    'image_url' => $product->image_url,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            }

            return response()->json(
                ResponseHelper::successResponse($formattedProducts, 'Product: Get All Products', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validationRules = [
                'name' => self::REQUIRED_STRING,
                'description' => self::REQUIRED_STRING,
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'brand' => self::REQUIRED_STRING,
                'image_url' => self::REQUIRED_STRING,
            ];

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json(
                    ResponseHelper::errorResponse($validator->errors()->first(), 400),
                    400
                );
            }

            $product = Product::create($request->all());

            $formattedProducts = [];
            $formattedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'brand' => $product->brand,
                'image_url' => $product->image_url,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ];

            return response()->json(
                ResponseHelper::successResponse($formattedProducts, 'Product: Create Product', 201),
                201
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(
                    ResponseHelper::errorResponse(ResponseHelper::DATA_NOT_FOUND_MESSAGE, 404),
                    404
                );
            }

            $formattedProducts = [];
            $formattedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'brand' => $product->brand,
                'image_url' => $product->image_url,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];

            return response()->json(
                ResponseHelper::successResponse($formattedProducts, 'Product: Get Product By ID', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(
                    ResponseHelper::errorResponse(ResponseHelper::DATA_NOT_FOUND_MESSAGE, 404),
                    404
                );
            }

            $validationRules = [
                'name' => self::REQUIRED_STRING,
                'description' => self::REQUIRED_STRING,
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'brand' => self::REQUIRED_STRING,
                'image_url' => self::REQUIRED_STRING,
            ];

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json(
                    ResponseHelper::errorResponse($validator->errors()->first(), 400),
                    400
                );
            }

            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'brand' => $request->input('brand'),
                'image_url' => $request->input('image_url'),
            ]);

            $formattedProducts = [];
            $formattedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'brand' => $product->brand,
                'image_url' => $product->image_url,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];

            return response()->json(
                ResponseHelper::successResponse($formattedProducts, 'Product: Update Product', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(
                    ResponseHelper::errorResponse(ResponseHelper::DATA_NOT_FOUND_MESSAGE, 404),
                    404
                );
            }

            $product = Product::destroy($id);
            if ($product > 0) {
                return response()->json(
                    ResponseHelper::successResponse((object) [], 'Product: Delete Product', 200),
                    200
                );
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }
}
