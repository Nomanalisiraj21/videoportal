<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function scopeActive($q)
    {
        return $q->whereStatus(1);
    }

    public function games()
    {
        return $this->hasMany(\App\Models\Video::class);
    }

    // Get title wrt language
    public function getTitleAttribute($value)
    {

        $lang = session()->get('lang') ?? 'en';
        $is_admin = session()->has('ADMIN_LOGIN');

        if ($lang == 'ar' && !$is_admin) {
            return $this->ar_title ?? $value;
        }

        return $value;
    }
    // get desctription wrt language
    public function getDescriptionAttribute($value)
    {

        $lang = session()->get('lang') ?? 'en';
        $is_admin = session()->has('ADMIN_LOGIN');

        if ($lang == 'ar' && !$is_admin) {
            return $this->ar_description ?? $value;
        }

        return $value;
    }
}
