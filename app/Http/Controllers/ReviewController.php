<?php

namespace App\Http\Controllers;

use App\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /*
    * function to let the user review a product
    */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function store(Request $request, $id)
    {

         $this->validate($request, [
            'rating' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
        Review::create([
            'user_id' => Auth::User()->id,
            'product_id' => $id,
            'rating' => $request->rating,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->back();
    }
}
