<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Models\Company\Company;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function guest()
    {

        // $company = Company::with('about','country', 'county', 'constituency', 'ward', 'postalcode')
        //     ->first();
            //  return view('layouts/guestendmaster', compact('company'));
             return view('layouts/guestendmaster');
            //  return view('welcome');
    }
    public function auth()
    {
        // $company = Company::with('about','country', 'county', 'constituency', 'ward', 'postalcode')
        //     ->first();
        return view('layouts/authendmaster');
    }
}
