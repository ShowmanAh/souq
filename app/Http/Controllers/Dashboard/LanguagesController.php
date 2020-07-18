<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;

class LanguagesController extends Controller
{
public function index(){
 $languages = Language::select()->paginate(paginate_number);
 return view('dashboard.languages.index', compact('languages'));

}
public function create(){
    return view('dashboard.languages.create');
}
public function store(LanguageRequest $request){
   // dd($request->all());
 try {

   Language::create($request->except(['_token']));
 return redirect()->route('admin.languages')->with(['success'=> 'تم ادخال البيانات بنجاح']);
 } catch (\Exception $ex) {
    return redirect()->route('admin.languages')->with(['error'=> 'هناك خطأ فى ادخال البيانات']);
 }
}
public function edit($id){
 $lang = Language::select()->find($id);
 if(!$lang){
     return redirect()->route('admin.languages')->with(['error'=> 'هذه اللغه غير موجوده']);
 }
 return view('dashboard.languages.edit', compact('lang'));
}
public function update($id, LanguageRequest $request)
{

    try {
        $language = Language::find($id);
        if (!$language) {
            return redirect()->route('admin.languages.edit', $id)->with(['error' => 'هذه اللغة غير موجوده']);
        }


        if (!$request->has('active'))
            $request->request->add(['active' => 0]);

        $language->update($request->except('_token'));

        return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);

    } catch (\Exception $ex) {
        return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    }
}
  public function destroy($id){
      $lang = Language::find($id);
      if(!$lang){
        return redirect()->route('admin.languages')->with(['error'=> 'هذه اللغه غير موجوده']);
      }
      try {
         $lang->delete();
         return redirect()->route('admin.languages')->with(['success'=> 'تم حذف اللغه بنجاح']);
      } catch (\Exception $ex) {
        return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ يرجى المحاوله مجددا']);
      }
  }
}
