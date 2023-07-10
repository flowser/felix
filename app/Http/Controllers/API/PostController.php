<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Mail\NewPostNotification;
use App\Models\Subscription\Post;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Website;
use App\Console\Commands\SendEmailNotifications;
use App\Console\Commands\SendNewPostNotifications;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts  =  Post:: with('website')->get();
         return response()->json([
            'posts'     => $posts,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>'required',
            'description'   =>'required',
        ]);

        $websiteId = $request->input('website_id');
        $website = Website::findOrFail($websiteId);
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        $website->posts()->save($post);
        // Dispatch the job to send email notifications to subscribers
        dispatch(new SendNewPostNotifications());

   



    //      // Validate the request data
    //      $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //     ]);

    //     // Create a new post
    //     $post = new Post();
    //     $post->title = $request->input('title');
    //     $post->description = $request->input('description');
    //     $post->website_id = $website->id;
    //     $post->save();

    //     // Get all subscribers for this website
    //     $subscribers = $website->subscribers()->where('active', true)->get();

    //     // Loop through each subscriber
    //     foreach ($subscribers as $subscriber) {
    //         // Send email notification to subscriber
    //         Mail::to($subscriber->email)->send(new NewPostNotification($post));
    //     }

    //     // Return a success response
    //     return response()->json([
    //         'message' => 'Post created successfully',
    //     ]);
    // }

         return response()->json([
            'post'     => $post,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $this->validate($request, [
            'title'         =>'required',
            'description'   =>'required',
        ]);

        $post         = Post::find($id);
        $post->title         = $request->title;
        $post->description   = $request->description;
        $post->website_id    = $request->website_id;
        $post->save();

         return response()->json([
            'post'     => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post         = Post::find($id);
        $post->delete();

         return response()->json([
            'post'     => $post,
        ], 200);
    }
}

