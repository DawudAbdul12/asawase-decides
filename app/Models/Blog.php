<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","slug","type","content","publish","visibility"},
 * @OA\Xml(name="Blog"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Blog Title", example="Men Collections"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="Blog Slug. Note. is a unique field", example="men-collections"),
 * @OA\Property(property="type", type="string", readOnly="false",  description="", example="text"),
 * @OA\Property(property="content", type="string", description=" Blog Content  ", example="Content"),
 * @OA\Property(property="video", type="string", readOnly="false",  description="video Link", example="youtube.com"),
 * @OA\Property(property="visibility", type="string", description="visibility ", example="publish"),
 * @OA\Property(property="publish", type="string", format="date-time"),
 * @OA\Property(property="featured", type="boolean", readOnly="false",  description="", example="1"),
 * @OA\Property(property="image", type="string", format="binary"),
 * @OA\Property(property="thumbnail", type="string", format="binary"),
 * @OA\Property(property="author", type="string", readOnly="false",  description="", example="Effect"),
 * @OA\Property(property="source", type="string", description="Source ", example="cnn"),
 * @OA\Property(property="categories",type="array", @OA\Items( ref="#/components/schemas/BlogCategory")),
 * @OA\Property(property="tags", type="string", readOnly="false",  description="", example="kyshi, blog, money"),
 * @OA\Property(property="read_time", type="string", readOnly="false",  description="", example="1 minute read"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class Blog
 *
 */



class Blog extends Model
{
    use HasFactory;

    public function categories()
    {

        return $this->belongsToMany('App\Models\BlogCategory')->withTimestamps();

    }


    public function scopeSearchSlug($query,$slug)
    {
        if(!Empty($slug)){
            return $query->where('slug', '=', $slug);
        }

        return $query;
    }

    public function scopeSearch($query,$title)
    {
        if(!Empty($title)){
            return $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
    }


    public function getBannerAttribute($value)
    {
     
       if ($value == "") {

            return $value;

        } else {
            
            return  asset($value);
        }

    }

    public function getThumbnailAttribute($value)
    {
        if ($value == "") {

            return $value;

        } else {
            
            return  asset($value);
        }
    }
}
