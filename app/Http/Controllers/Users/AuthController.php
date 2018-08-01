<?php

namespace App\Http\Controllers\Users;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var UserContract
     */
    private $user;

    /**
     * AuthController constructor.
     * @param UserContract $user
     */
    function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function register(RegisterRequest $request)
    {
        if ($this->user->create($request->toArray())) {
            return response('', 204);
        }
        return response([
            'status' => 'error',
            'error' => 'unknown.error',
            'msg' => 'Unknown error'
        ], JsonResponse::HTTP_BAD_REQUEST);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response([
                'status' => 'success',
                'msg' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response([
                'status' => 'error',
                'msg' => 'Failed to logout, please try again.'
            ],JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}