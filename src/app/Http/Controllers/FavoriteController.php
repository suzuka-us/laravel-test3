<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function store($product_id)
    {
        Product::find($product_id)->favorited_users()->attach(Auth::id());
        return back();
    }

    public function destroy($product_id)
    {
        Product::find($product_id)->favorited_users()->detach(Auth::id());
        return back();
    }
}
