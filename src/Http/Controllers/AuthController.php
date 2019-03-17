<?php
/**
 * File AuthController.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue\Core
 * @version 1.0
 */
namespace Tuandm\Laravue\Http\Controllers;

use Tuandm\Laravue\JsonResponse;
use Tuandm\Laravue\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


/**
 * Class AuthController
 *
 * @package Tuandm\Laravue\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(new JsonResponse(Auth::user()), Response::HTTP_OK)->header('Authorization', $token);
        }

        return response()->json(new JsonResponse([], 'login_error'), Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json((new JsonResponse())->success([]), Response::HTTP_OK);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * @return mixed
     */
    private function guard()
    {
        return Auth::guard();
    }
}
