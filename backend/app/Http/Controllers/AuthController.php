<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function index()
    {
        $this->authorize('admin', auth()->user());
        $users = User::all();
        return UserResource::collection($users);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'age'               => $request->has('age') ? $request->age : null,
            'gender'            => $request->has('gender') ? $request->gender : null,
            'post_code'         => $request->has('post_code') ? $request->post_code : null,
            'prefecture_code'   => $request->has('prefecture_code') ? $request->prefecture_code :null,
            'address'           => $request->has('address') ? $request->address : null,
        ]);

        $user->tags()->sync(request()->tags);

        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return abort(401);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);

    }

    public function login(UserLoginRequest $request)
    {
        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return response()->json([
                'errors' => [
                    'email' => ['Неверный адрес электронной почты или пароль.']
                ],
                ],422);
        };

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);
    }


    public function user(Request $request)
    {
        $this->authorize('confirmation', $request->user(), auth()->user());
        return new UserResource($request->user());
    }


    public function logout()
    {
        auth()->logout();
    }

    public function update(UserUpdateRequest $request, User $user)
    {

        $this->authorize('confirmation', $user, auth()->user());

        $user->fill($request->all());
        if($request->has('password')){
            $user->password = bcrypt($request->get('password', $user->password));
        }

        $user->save();

        $token = auth()->tokenById($user->id);

        $user->tags()->sync(request()->tags);

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ]
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('confirmation', $user, auth()->user());
        $user->delete();
        return response(null,204);
    }
}

