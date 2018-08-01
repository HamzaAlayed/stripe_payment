<?php

namespace App\Http\Controllers\Users;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserContract
     */
    private $user;

    /**
     * UserController constructor.
     * @param UserContract $user
     */
    function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->pagination(10);

        if ($users) {
            $count = $users->count();

            switch ($count) {
                case  0:
                    $code = JsonResponse::HTTP_NO_CONTENT;
                    break;
                case $count > 0 && $count < 10 :
                    echo $count;
                    $code = JsonResponse::HTTP_OK;
                    break;

                default:
                    $code = JsonResponse::HTTP_PARTIAL_CONTENT;
                    break;
            }

        } else {
            $code = JsonResponse::HTTP_NOT_FOUND;
        }
        return response($users, $code);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        if ($this->user->create($request->toArray())) {
            return response('', 204);
        }
        return response([
            'status' => 'error',
            'error' => 'unknown.error',
            'msg' => 'Unknown error'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return response([
                'status' => 'error',
                'error' => 'invalid.user',
                'msg' => 'User not found'
            ], 404);
        }

        return response($user, 400);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        if (!$this->user->find($id)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.user',
                'msg' => 'User not found'
            ], 404);
        }

        if ($this->user->update($id, $request->toArray())) {
            return response('', 204);
        }
        return response([
            'status' => 'error',
            'error' => 'unknown.error',
            'msg' => 'Unknown error'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$this->user->find($id)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.user',
                'msg' => 'User not found'
            ], 404);
        }
        if ($this->user->delete($id)) {
            return response('', 204);
        }
        return response([
            'status' => 'error',
            'error' => 'unknown.error',
            'msg' => 'Unknown error'
        ], 400);
    }
}
