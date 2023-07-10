<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription\Website;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $websites  =  Website::get();
         return response()->json([
            'websites'     => $websites,
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
            'name'         =>'required',
            'url'          =>'required',
        ]);

        $website         = new Website();
        $website->name   = $request->name;
        $website->url    = $request->url;
        $website->save();

         return response()->json([
            'website'     => $website,
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
            'name'         =>'required',
            'url'          =>'required',
        ]);
        
        $website         = Website::find($id);
        $website->name   = $request->name;
        $website->url    = $request->url;
        $website->save();

         return response()->json([
            'website'     => $website,
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
        
        $website         = Website::find($id);
        $website->delete();

         return response()->json([
            'website'     => $website,
        ], 200);
    }
}
