<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Resources\Post as PostResources;
use App\Http\Resources\PostCollection as PostCollection;
use App\Http\Requests\Post as PostRequests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
        
        errores: 
        1xx informativos
        2xx respuestas exitosas
        3xx redirección
        4xx errores del cliente
        5xx errores del servidor

     * @return \Illuminate\Http\Response
     */

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return response()->json(
            new PostCollection(
                $this->post->orderBy('id','Desc')->get()
            )
        );
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
    public function store(PostRequests $request)
    {
        $post = $this->post->create($request->all());

        return response()->json(new PostResources($post), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        /*return [
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,

        ];*/

        return  response()->json(new PostResources($post), 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequests $request, Post $post)
    {
         $post->update($request->all());

        return response()->json(new PostResources($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null,204);
    }
}
