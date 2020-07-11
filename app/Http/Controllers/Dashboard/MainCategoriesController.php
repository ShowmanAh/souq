<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainCategoriesController extends Controller
{
public function index(){
    $default_lang = get_default_lang();
   // dd($default_lang);
   $categories = MainCategory::where('translation_lang', $default_lang )->selection()->get();
   return view('dashboard.maincategories.index', compact('categories'));
}
}
