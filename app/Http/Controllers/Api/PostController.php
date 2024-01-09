<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        // display posts in database(all data=posts)
        $posts = PostResource::collection(Post::get());
        return $this->apiResponse($posts, 'okay', 200);
    }

    public function show($id)
    {
        // to use resource(get some data)
        // $post = new PostResource(Post::find($id));
        $post = Post::find($id);
        if ($post) {
            // in response return transform process (once i enter not found id)
            return $this->apiResponse(new PostResource($post), 'okay', 200);
        }
        return $this->apiResponse(null, 'The Post Not Found', 404);
    }

    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        // create first post
        $post = Post::create($request->all());
        if ($post) {
            // in response return transform process (once i enter not found id)
            return $this->apiResponse(new PostResource($post), 'Post Created', 201);
        }
        return $this->apiResponse(null, 'Post Not create', 400);
    }

    public function update(Request $request, $id)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        // create first post
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            // in response return transform process (once i enter not found id)
            return $this->apiResponse(new PostResource($post), 'Post updated', 201);
        }else{
            return $this->apiResponse(null, 'The Post Not Found', 404);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete($id);
            // in response return transform process (once i enter not found id)
            return $this->apiResponse(null, 'Post Deleted', 200);
        }else{
            return $this->apiResponse(null, 'The Post Not Found', 404);
        }

    }
}
