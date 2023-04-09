<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('crud-users');
        //
        $users = User::latest()->get();
        return response()->json([
            'data' => UserResource::collection($users),
            'message' => 'Fetch all users',
            'success' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('crud-users');
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('crud-users');
        //
        $user = User::find($id);
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Fetch user with id '.$id,
            'success' => true
        ]);
    }
    // public function show(User $user)
    // {
    //     $this->authorize('crud-users');
    //     //
    //     return response()->json([
    //         'data' => new UserResource($user),
    //         'message' => 'Data user found',
    //         'success' => true
    //     ]);
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('crud-users');
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'string|min:8',
            'role' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $user = User::find($id);
        $data = array(
            "name" => $request->get('name')
        );
        if ($request->get('password')) $data['password'] = Hash::make($request->get('password'));
        if ($request->get('role')) $data['role'] = $request->get('role');
        $user->update($data);

        return response()->json([
            'data' => new UserResource($user),
            'message' => 'User updated successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('crud-users');
        //
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'data' => [],
            'message' => 'User deleted successfully',
            'success' => true
        ]);
    }
}
