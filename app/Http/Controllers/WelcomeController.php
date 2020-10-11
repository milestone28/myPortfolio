<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class WelcomeController extends Controller
{
    //

    public function index () {


        return view('welcome')
        ->with('posts', Post::searched()->simplePaginate(4))
        ->with('tags', Tag::all())
        ->with('categories', Category::all());
    }
}
