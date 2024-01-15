<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Response(
 *     response="Unauthorized",
 *     description="User unauthenticated",
 *     @OA\JsonContent(
 *         @OA\Examples(example="result", value={"message": "unauthenticated."}, summary="An result object."),
 *     )     
 * )
 */

class ProductsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/private/product",
     *     summary="Get a list of products",
     *     tags={"Private"},
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
     *         response="200", 
     *         description="Display a list of products.",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", description="Array of products", @OA\Items(type="object")),
     *             @OA\Property(property="meta", type="object", description="Pagination meta information", 
     *                 @OA\Property(property="current_page", type="integer", example="1"),
     *                 @OA\Property(property="per_page", type="integer", example="10"),
     *                 @OA\Property(property="total", type="integer", example="100"),
     *             ),
     *             @OA\Property(property="links", type="object", description="Pagination links", 
     *                 @OA\Property(property="first", type="string", example="url/to/first/page"),
     *                 @OA\Property(property="last", type="string", example="url/to/last/page"),
     *                 @OA\Property(property="prev", type="string", example="url/to/prev/page"),
     *                 @OA\Property(property="next", type="string", example="url/to/next/page"),
     *             ),
     *         )
     *     ),
     *    @OA\Response(response=401, ref="#/components/responses/Unauthorized")
     * )
     */
    public function index(Request $request)
    {   
        return ProductsResource::collection(Product::paginate($request->per_page));
    }

    /**
     * @OA\Post(
     *     path="/api/private/product",
     *     summary="Create a product",
     *     tags={"Private"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="number"
     *                 ),
     *                 example={"title": "Product", "description": "Product Description", "category": "category", "image": "https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg", "price": 123}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Create a product.",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={ "id": 1, "title": "Product", "description": "Product Description", "category": "category", "image": "https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg", "price": 123 }, summary="An result object."),
     *         )
     *     ),
     *     @OA\Response(response=401, ref="#/components/responses/Unauthorized") 
     * )
     */
    public function store(ProductsRequest $request)
    {
        return ProductResource::make(Product::create($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/private/product/{id}",
     *     summary="Get a product",
     *     tags={"Private"},
     *     @OA\Parameter(
     *         description="The id from product",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(response="200", description="Display a product."),
     *     @OA\Response(response=401, ref="#/components/responses/Unauthorized") 
     * )
     */
    public function show(string $id)
    {
        return ProductResource::make(Product::findOrFail($id));
    }

     /**
     * @OA\Put(
     *     path="/api/private/product/{id}",
     *     summary="Update a product",
     *     tags={"Private"},
     *     @OA\Parameter(
     *         description="The id from product",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="number"
     *                 ),
     *                 example={"title": "Product", "description": "Product Description", "category": "category", "image": "https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg", "price": 123}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Return a updated a product"
     *     ),
     *     @OA\Response(response=401, ref="#/components/responses/Unauthorized") 
     * )
     */
    public function update(ProductsRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return ProductResource::make($product);
    }

    /**
     * @OA\Delete(
     *     path="/api/private/product/{id}",
     *     summary="Soft delete of a product",
     *     tags={"Private"},
     *     @OA\Parameter(
     *         description="The id from product",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(response="200", description="Soft delete of product."),
     *     @OA\Response(response=401, ref="#/components/responses/Unauthorized") 
     * )
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return ProductResource::make($product);
    }
}
