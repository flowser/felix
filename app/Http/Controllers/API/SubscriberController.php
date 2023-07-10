<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $subscribers  =  Subscriber::with('website')->get();
         return response()->json([
            'subscribers'     => $subscribers,
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
            'email'         =>'required',
            // 'active'        =>'required',
            'website_id'    =>'required',
        ]);

        $subscriberexists   = Subscriber::where('email', $request->email)->where('website_id', $request->website_id)->first();
      if($subscriberexists){

        return response()->json([
            'subscriber'     => $subscriberexists,
        ], 200);
        }else{
            $subscriber                = new Subscriber();
            $subscriber->email         = $request->email;
            $subscriber->active        = true;
            $subscriber->website_id    = $request->website_id;
            $subscriber->save();
            return response()->json([
                'subscriber'     => $subscriber,
            ], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email'         =>'required',
            // 'active'        =>'required',
            'website_id'    =>'required',
        ]);
        
        $subscriber                = Subscriber::find($id);
        $subscriber->email         = $request->email;
        $subscriber->active        = true;
        $subscriber->website_id    = $request->website_id;
        $subscriber->save();

         return response()->json([
            'subscriber'     => $subscriber,
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
        
        $subscriber         = Subscriber::find($id);
        $subscriber->delete();

         return response()->json([
            'subscriber'     => $subscriber,
        ], 200);
    }
}


