<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\WebsiteSubscription;
use App\Jobs\SendEmailJob;
use App\Models\PostEmail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validate =$request->validate([
            'title' => 'bail|required|string|max:255',
            'description' => 'bail|required|string',
            'website_id' => 'bail|required|integer',
        ],[
            'title.required'=>'Title is required',
            'description.required'=>'Description is required',
            'websiteid.required'=>'Website is required',
            'title.string'=>'Title should only contain string',
            'description.string'=>'Description should only contain string',
            'website_id.integer'=>'Select Website',
        ]);

        // create  post 
        $post = Post::create($request->all());

        if($post){
            $subscribers = WebsiteSubscription::where('website_id',$request->website_id)->get();
            foreach($subscribers as $subscriber){
                $details['email'] = $subscriber->subscriber_email;

                // check if email is already send for the post to the subscriber
                $post_email_exist = PostEmail::where('website_subscription_id',$subscriber->id)
                                                ->where('post_id')->exist();
                if($post_email_exist){
                    continue;
                }
                else
                    dispatch(new SendEmailJob($details,$request->title,$request->description));
            }
        }

        return response()->json($post, 200);
        //  return response
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
