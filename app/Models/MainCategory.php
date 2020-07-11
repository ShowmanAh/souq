<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'maincategories';
    protected $fillable = ['translation_lang', 'translation_off', 'name', 'slug', 'image', 'active'];
    //local scope active
    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeSelection($query){
           return $query->select('id','translation_lang',  'name', 'slug', 'image', 'active');
    }
    public function getActive(){
        return $this->active == 1 ? 'غير مفعل' : 'مفعل';
    }
}
