<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryBlog extends Model
{
    use HasFactory;

    public function contents(){
        return $this->hasMany(CountryBlogItems::class, 'country_blog_id');
    }
    public function faqs(){
        return $this->hasMany(Faq::class, 'country_id');
    }
}
