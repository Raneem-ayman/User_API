<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Posts retrieved successfully',
            'data' => Post::with('photos')->get()
        ], Response::HTTP_OK);
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $post->photos()->create(['path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post->load('photos')
        ], Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        return response()->json([
            'message' => 'Post retrieved successfully',
            'data' => $post->load('photos')
        ], Response::HTTP_OK);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $post->photos()->create(['path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post->load('photos')
        ], Response::HTTP_OK);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], Response::HTTP_OK);
    }
}
