<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];


    public function scopeFilter($query)
    {
        if (request('search')){
                $query
                    ->where('title', 'like', '%'.request('search').'%')
                    ->orwhere('body', 'like', '%'.request('search').'%')
                    ->orwhere('slug', 'like', '%'.request('search').'%');
            }
            
    }


    public function category()
    {
        $this->belongsTo(Category::class, 'category_id');
    }
}
