<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSubscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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
            'website_id' => 'bail|required|integer',
            'subscriber_email' => 'bail|required|email',
        ],[
            'title.required'=>'Title is required',
            'description.required'=>'Description is required',
            'websiteid.required'=>'Website is required',
            'title.string'=>'Title should only contain string',
            'description.string'=>'Description should only contain string',
            'website_id.integer'=>'Select Website',
        ]);

        // check if website is already subscribed
        $website_subscription = WebsiteSubscription::where('website_id',$request->website_id)
                                                    ->where('subscriber_email',$request->subscriber_email)->exists();
        if($website_subscription){
            return response()->json(
                [
                    "success" => false,
                    "message" => "Already subscribed.",
                    "data" => 409
                ]
            );
        }
        else{
            // create  post 
            $subcribe = WebsiteSubscription::create($request->all());

            //  return response
            return response()->json($subcribe, 200);
        }
        
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
