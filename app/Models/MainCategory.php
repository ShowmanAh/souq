<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'maincategories';
    protected $fillable = ['translation_lang', 'translation_off', 'name', 'slug', 'image', 'active'];
    //local scope active get active
    public function scopeActive($query){
        return $query->where('active', 1);
    }
    //get selection
    public function scopeSelection($query){
           return $query->select('id','translation_lang',  'name', 'slug', 'image', 'active');
    }
    // listen observer
    protected static function boot(){
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }
    // get active
    public function getActive(){
        return $this->active == 1 ?  'مفعل' : 'غير مفعل';
    }
    // get image attribute
    public function getimageAttribute($val){
        return ($val !== null) ? asset('assets/' . $val) : '';
    }
    public function categories(){
        return $this->hasMany(self::class,'translation_off');// one to many between default category and translation category
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'category_id', 'id');
    }

}
