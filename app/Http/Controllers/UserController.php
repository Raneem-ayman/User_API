<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\TokenRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['store', 'index', 'token']);
    }

    public function index()
    {
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => UserResource::collection(User::all())
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $user->photos()->create(['path' => $path]);
            }
        }

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user->load('photos'))
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => new UserResource($user->load('photos'))
        ], Response::HTTP_OK);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $user->photos()->create(['path' => $path]);
            }
        }

        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user->load('photos'))
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], Response::HTTP_OK);
    }

    public function token(TokenRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Token created successfully',
            'token' => $user->createToken($request->device_name)->plainTextToken
        ], 200);
    }

}
