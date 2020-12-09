<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Auth;

class RestaurantController extends Controller
{
    //

    public function create(){
        if (auth()->user()->isAdmin()) {
            return view('restaurants.create');
        } else{
            return redirect('/')->with("warning","You need to be admin to do that");
        }
    }

    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|',
            'address' => 'required',
            'contact' => 'required|numeric',
        ]);

        $input = $request->all();
        Restaurant::create($input);

        return redirect('/')->with('success','Restaurant added successfully');

    }


}
