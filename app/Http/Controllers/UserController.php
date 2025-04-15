<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll()
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json($users);
        } catch (Exception $ex) {
            return response(['exception' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id)
    {
        try {
            $user = $this->userService->getUser($id);
            if ($user) {
                return response()->json($user);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (Exception $ex) {
            return response(['exception' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function create(UserRequest $request)
    {
        try {
            $user = $this->userService->createUser($request->validated());
            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $ex) {
            return response(['exception' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UserRequest $request)
    {
        try {
            $user = $this->userService->updateUser($request->validated());
            return $user;
        } catch (Exception $ex) {
            return response(['exception' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->userService->deleteUser($id);
            if ($deleted) {
                return response()->json(null, Response::HTTP_NO_CONTENT);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (Exception $ex) {
            return response(['exception' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
