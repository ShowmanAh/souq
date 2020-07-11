<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['abbre', 'locale', 'name', 'direction','native', 'active',];
    public function scopeActive($query){
        return $query->where('active', 1);

    }
    // select functio
    public function scopeSelection($query){
        return $query->select('id','abbre', 'name', 'direction', 'active');
    }
    // accessors
    public function getActive(){
       return $this->active == 1 ? 'غير مفعل' : 'مفعل';

    }

}
