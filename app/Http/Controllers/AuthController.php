<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="User register",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "Person Smith", "email": "email@domain", "password": 12345678}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User created",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={ "id": 1, "name": "Person Smith", "email": "email@dominio", "email_verified_at": null, "created_at": "2024-01-12T14:22:03.000000Z", "updated_at": "2024-01-12T14:22:03.000000Z" }, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user);
    }

     /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "email@domain", "password": 12345678}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User authenticated",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={ "id": 1, "name": "Person Smith", "email": "email@dominio", "email_verified_at": null, "created_at": "2024-01-12T14:22:03.000000Z", "updated_at": "2024-01-12T14:22:03.000000Z" }, summary="An result object."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"message": "Email ou senha inválidos."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(['message' => 'Email ou senha inválidos.']);
        }

        return Auth::user();
    }

     /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="User logout",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="User unauthenticated", 
     *     )
     * )
     */
    public function logout(Request $request) 
    {
        return Auth::guard('web')->logout();
    }
 
     /**
     * @OA\Get(
     *     path="/api/private/user",
     *     summary="User logged",
     *     tags={"Private"},
     *     @OA\Response(
     *         response=200,
     *         description="User logged",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={ "id": 1, "name": "Person Smith", "email": "email@dominio", "email_verified_at": null, "created_at": "2024-01-12T14:22:03.000000Z", "updated_at": "2024-01-12T14:22:03.000000Z" }, summary="An result object."),
     *         )
     *     ),
     *     @OA\Response(response=401, ref="#/components/responses/Unauthorized")
     * )
     */
    public function user(Request $request)
    {
        return Auth::user();
    }
}
