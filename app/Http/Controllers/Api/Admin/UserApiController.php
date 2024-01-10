<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserApiController extends AdminApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(__('crud.indexed'), User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     *
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $user = User::create(array_merge($request->only(['is_active', 'name', 'email']), [
                'password' => bcrypt($request->get('password')),
            ]));

            return $this->success(__('crud.stored'), $user, 201);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     *
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->success(__('crud.shown'), $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  User  $user
     *
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $user->update(array_merge($request->only(['is_active', 'name', 'email']), [
                'password' => bcrypt($request->get('password')),
            ]));

            return $this->success(__('crud.updated'), $user);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     *
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();

            return $this->success(__('crud.destroyed'));
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }
}
