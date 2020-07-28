<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Vendor extends Model
{
    use Notifiable;
    protected $table = 'vendors';
    protected $fillable = ['name', 'email','password', 'phone', 'address', 'active', 'logo', 'category_id','latitude','longitude'];
    protected $hidden = ['category_id'];// for performance lose loading db // to use it should make reusable for category_id
    public function scopeActive($query){//accessors
    return $query->where('active', 1);
    }
    // append http localhost
    public function getLogoAttribute($val){// get image path
        return ($val !== null) ? asset('assets/'.$val) : '';
    }
    public function scopeSelection($query){
        return $query->select('id','name','logo','phone','latitude','longitude','active','category_id', 'email', 'address');
    }
    public function getActive(){
        return $this->active == 1 ? 'مفعل':'غير مفعل';
    }

    public function setPasswordAtrribute($password){
        if (!empty($password)) {
           $this->attributes['password'] = bcrypt($password);
        }
    }


    public function category()
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }


}
