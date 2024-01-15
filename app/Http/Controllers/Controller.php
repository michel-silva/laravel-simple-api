<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel simple api",
 *     description="This is a Laravel simple api to demonstrate some resource of Laravel framework.",
 *     @OA\Contact(
 *         email="silva.michel.b@gmail.com"
 *     ),
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
