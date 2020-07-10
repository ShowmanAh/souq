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
}
