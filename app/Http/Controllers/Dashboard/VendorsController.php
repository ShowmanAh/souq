<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Vendor;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Notifications\VendorCreated;
use Illuminate\Support\Facades\Notification;

class VendorsController extends Controller
{
    private $view = 'dashboard.vendors.';
   public function index(){
     $vendors = Vendor::selection()->paginate(paginate_number);
     return view($this->view.'index', compact('vendors'));

   }
   public function create(){
       // main category for default language
    $categories = MainCategory::where('translation_off',0)->select('id', 'name')->get();
    //return $categories;
    return view($this->view.'create', compact('categories'));
   }
   public function store(VendorRequest $request){
      // dd($request->all());

     try{
       if(!$request->has('active'))
       $request->request->add(['active'=> 0]);
       else
       $request->request->add(['active'=> 1]);
    $request_data = $request->except(['password','logo']);
    if ($request->has('password')) {
        $request_data['password'] = $request->password;
    }
    if ($request->has('logo')) {
        $filepath = uploadImage('vendors', $request->logo);
        $request_data['logo'] = $filepath;
    }
   $vendor = Vendor::create($request_data);
    Notification::send($vendor, new VendorCreated($vendor));
    return redirect()->route('admin.vendors')->with(['success'=> 'تم الاضافه بنجاح']);
 } catch (\Exception $ex) {
    return $ex;
   return redirect()->route('admin.vendors')->with(['error'=> 'حدث خطأ ما']);
 }
}

    public function edit($id){
    try {
        $vendor = Vendor::find($id);
        if(!$vendor){
            return redirect()->route('admin.vendors')->with(['error'=>'لايوجد هذا المتجر']);
        }
        $categories = MainCategory::where('translation_off',0)->select('id','name')->get();
        return view($this->view.'edit', compact('vendor', 'categories'));

    } catch (\Exception $ex) {
        return redirect()->route('admin.vendors')->with(['error'=> 'حدث خطأ ما']);
    }
    }
    public function update($id, VendorRequest $request){

        // return $request;
        try{
            //  dd($request->all());
            $vendor = Vendor::find($id);
            if(!$request->has('active'))
            $request->request->add(['active'=> 0]);
            else
            $request->request->add(['active'=> 1]);
         $request_data = $request->except(['password','logo']);
         if ($request->has('password')) {
             $request_data['password'] = $request->password;
         }
         if ($request->has('logo')) {
             $filepath = uploadImage('vendors', $request->logo);
             $request_data['logo'] = $filepath;
         }
        $vendor->update($request_data);
         return redirect()->route('admin.vendors')->with(['success'=> 'تم التعديل بنجاح']);
      } catch (\Exception $ex) {
         return $ex;
        return redirect()->route('admin.vendors')->with(['error'=> 'حدث خطأ ما']);
      }

    }
    public function destroy($id){
       try {
           $vendor = Vendor::find($id);
           if(!$vendor){
               return redirect()->route('admin.vendors')->with(['error'=> 'لايوجد هذا المتجر']);
           }
           $image = Str::after($vendor->logo, 'assets/');// cutting domain http localhost
            $image = base_path('assets/'.$image); // get image path
        // return $image;
               unlink($image); // delete image from folder
          $vendor->delete();

           return redirect()->route('admin.vendors')->with(['success'=> 'تم الحذف']);
       } catch (\Exception $ex) {
           // return $ex;
        return redirect()->route('admin.vendors')->with(['error'=> 'حدث خطأ حاول مجددا']);
       }
    }
    public function changeStatus($id){
        try {
            // dd($request->all());
            $vendor = Vendor::find($id);

            if (!$vendor) {
                return redirect()->route('admin.vendors')->with(['error'=> 'لايوجد هذا المتجر']);
            }
           $status =  $vendor->active == 0 ? 1 : 0;
           $vendor->update([
              'active' => $status
           ]);
           return redirect()->route('admin.vendors')->with(['success'=> '  تم تحديث الحاله']);
        }catch (\Exception $ex) {
            return $ex;
          return redirect()->route('admin.vendors')->with(['error'=>'هناك خطأ ما حاول مجددا']);
        }
    }
}
