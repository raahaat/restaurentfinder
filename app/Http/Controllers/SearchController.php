<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Restaurant;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        //
        if(Auth::check()){
            $restaurants = Restaurant::where('address', 'like', '%' .$request->search. '%' )->get();
            return view('search.index',compact('restaurants'));
        }

        return redirect('/')->with('warning','You need to be logged in to do that');
    }
}
