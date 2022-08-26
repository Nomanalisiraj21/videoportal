<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'ar_title', 'ar_content', 'pos'];
    public function scopeActive($q){
        return $q->whereStatus(1);
    }

    
    // Get title wrt language
    public function getTitleAttribute($value){

        $lang = session()->get('lang') ?? 'en';
        $is_admin = session()->has('ADMIN_LOGIN');

        if($lang == 'ar' && !$is_admin){
            return $this->ar_title ?? $value;
        }
        
        return $value;
    }
    // get desctription wrt language
    public function getContentAttribute($value){

        $lang = session()->get('lang') ?? 'en';
        $is_admin = session()->has('ADMIN_LOGIN');

        if($lang == 'ar' && !$is_admin){
            return $this->ar_content ?? $value;
        }

        return $value;
    }
}
