<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // output dashboard
    public function dashboard(){
        return view('admin.dashboard', [
            'categories' => Category::lastCategories(5),
            'articles' => Article::lastArticles(5),
            'events' => Event::lastEvents(5),
            'cnt_categories' => Category::count(),
            'cnt_articles' => Article::count(),
        ]);
    }
}
