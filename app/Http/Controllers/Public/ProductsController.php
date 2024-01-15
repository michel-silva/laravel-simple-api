<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/public/product",
     *     summary="Get a Public list of products",
     *     tags={"Public"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Set page of data",
     *         required=false,
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Set per page of data",
     *         required=false,
     *     ),
     *     @OA\Response(
     *     response="200", 
     *     description="Display a listing of products.",
     *     @OA\JsonContent(
     *         @OA\Property(property="data", type="array", description="Array of products", @OA\Items(type="object")),
     *         @OA\Property(property="meta", type="object", description="Pagination meta information", 
     *             @OA\Property(property="current_page", type="integer", example="1"),
     *             @OA\Property(property="per_page", type="integer", example="10"),
     *             @OA\Property(property="total", type="integer", example="100"),
     *         ),
     *         @OA\Property(property="links", type="object", description="Pagination links", 
     *             @OA\Property(property="first", type="string", example="url/to/first/page"),
     *             @OA\Property(property="last", type="string", example="url/to/last/page"),
     *             @OA\Property(property="prev", type="string", example="url/to/prev/page"),
     *             @OA\Property(property="next", type="string", example="url/to/next/page"),
     *         ),
     *     )
     * ),
     * )
     */
    public function index(Request $request)
    {   
        return ProductsResource::collection(Product::paginate($request->per_page));
    }
}
