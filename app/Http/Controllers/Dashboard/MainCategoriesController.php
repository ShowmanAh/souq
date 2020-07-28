<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\MainCategoryRequest;
//use App\Http\Requests\MainCategoryRequest;

class MainCategoriesController extends Controller
{
    private $view = 'dashboard.maincategories.';
public function index(){
    $default_lang = get_default_lang();
   // dd($default_lang);
   $categories = MainCategory::where('translation_lang', $default_lang )->selection()->get();
   return view($this->view . 'index', compact('categories'));
}
public function create(){
    return view($this->view . 'create');
}
public function store(Request $request){
   // return $request;
   $rules = [
    'image' => 'required_without:id|mimes:jpg,jpeg,png',
    'category' => 'required|array|min:1',
    'category.*.name' => 'required',
    'category.*.abbre' => 'required',
   ];
   $validator = validator()->make($request->all(), $rules);
   if($validator->fails()){
       return back()->withInput()->with('error',  $validator->errors()->first());
   }
  try {
    $main_categories = collect($request->category);// convert array of object to collection
    $filter = $main_categories->filter(function($val,$key){//filter with default language
          return $val['abbre'] == get_default_lang();
    });
    $default_category = array_values($filter->all()) [0];// convert collection(array of array) to object
    $filepath = "";
    if ($request->has('image')) {// check request image
       $filepath = uploadImage('maincategories', $request->image);
    }
   // return $default_category;
   DB::beginTransaction(); // begin transction when make more transaction on db
   $default_category_id = MainCategory::insertGetId([
   'translation_lang' => $default_category['abbre'],
   'translation_off' => 0,
   'name' => $default_category['name'],
   'slug' => $default_category['name'],
   'image' => $filepath,
   ]);
  // return $default_category_id;

   $categories = $main_categories->filter(function($val,$key){
     return $val['abbre'] !=  get_default_lang();// filter other  language
   });

   if (isset($categories) && $categories->count()) {// check categories
       $categories_arr = [];
       foreach ($categories as $category) {
           $categories_arr[] = [
            'translation_lang' => $category['abbre'],
            'translation_off' => $default_category_id ,
            'name' => $category['name'],
            'slug' => $category['name'],
            'image' => $filepath,
          ];
       }
     // return $categories_arr;
       MainCategory::insert($categories_arr); // insert other categories
       DB::commit(); // excute transaction db
       return redirect()->route('admin.maincategories')->with(['success'=> 'تمت الاضافه بنجاح']);
   }

   } catch (\Exception $ex) {
    DB::rollback();
    return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
}
}

public function edit($id){
    $main_category = MainCategory::with('categories')->selection()->find($id);// eager loading
    if(!$main_category){
        return redirect()->route('admin.maincategories')->with(['error'=> 'لايوجد هذا القسم']);
    }
    return view($this->view.'edit', compact('main_category'));
}
public function update(Request $request, $id){
   // return $request;
    $rules = [
        'image' => 'required_without:id|mimes:jpg,jpeg,png',
        'category' => 'required|array|min:1',
        'category.*.name' => 'required',

       ];
       $validator = validator()->make($request->all(), $rules);
       if($validator->fails()){
           return back()->withInput()->with('error',  $validator->errors()->first());
       }

    try {
        // dd($request->all());
        $main_category = MainCategory::find($id);

    if(!$main_category){
        return redirect()->route('admin.maincategories')->with(['error'=> 'لايوجد هذا القسم']);
    }
    $category = array_values($request->category)[0];// return object
    //return $category;
    if(!$request->has('category.0.active'))
        $request->request->add(['active'=>0]);
    else
    $request->request->add(['active'=>1]);
    MainCategory::where('id', $id)->update([
        'name' => $category['name'],
        'active' =>$request->active
    ]);
   // $filepath = $main_category->image;
    if ($request->has('image')) {
    $filepath = uploadImage('maincategories', $request->image);
    MainCategory::where('id', $id)->update(
        [
            'image' => $filepath,
        ]
        );
}

return redirect()->route('admin.maincategories')->with(['success'=> '  تم التعديل']);
   } catch (\Exxception $ex) {
      return redirect()->route('admin.maincategories')->with(['error'=>'هناك خطأ ما حاول مجددا']);
   }

}
public function destroy($id){
  try {
      $main_category = MainCategory::find($id);

      if(!$main_category){
        return redirect()->route('admin.maincategories')->with(['error'=>'  لايوجد هذا القسم  ']);
      }
      // check if category has vendors
      $vendors = $main_category->vendors();
     // dd($vendors);
          if (isset($vendors) && $vendors->count() > 0) {
           // return 1;
                return redirect()->route('admin.maincategories')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            }
            //return $main_category->image;
         $image = Str::after($main_category->image, 'assets/');// cutting domain http localhost
        $image = base_path('assets/'.$image); // get image path
        // return $image;
          unlink($image); // delete image from folder
         // $main_category->categories()->delete();   // delete default language with other language on this category

      $main_category->delete();
      return redirect()->route('admin.maincategories')->with(['success'=> '  تم الحذف']);
  } catch (\Exception $ex) {
      return $ex;
    return redirect()->route('admin.maincategories')->with(['error'=>'هناك خطأ ما حاول مجددا']);
  }

}
public function changeStatus($id){
    try {
        // dd($request->all());
        $main_category = MainCategory::find($id);

        if (!$main_category) {
            return redirect()->route('admin.maincategories')->with(['error'=> 'لايوجد هذا القسم']);
        }
       $status =  $main_category->active == 0 ? 1 : 0;
       $main_category->update([
          'active' => $status
       ]);
       return redirect()->route('admin.maincategories')->with(['success'=> '  تم تحديث الحاله']);
    }catch (\Exception $ex) {
        return $ex;
      return redirect()->route('admin.maincategories')->with(['error'=>'هناك خطأ ما حاول مجددا']);
    }
}
}
