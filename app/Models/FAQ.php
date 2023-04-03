<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","slug","content","publish","visibility"},
 * @OA\Xml(name="FAQ"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Question", example="How to login"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="FAQ Slug. Note. is a unique field", example="men-collections"),
 * @OA\Property(property="content", type="string", description=" FAQ Content  ", example="Content"),
 * @OA\Property(property="visibility", type="string", description="visibility ", example="publish"),
 * @OA\Property(property="publish", type="string", format="date-time"),
 * @OA\Property(property="featured", type="boolean", readOnly="false",  description="", example="1"),
 * @OA\Property(property="categories",type="array", @OA\Items( ref="#/components/schemas/BlogCategory")),
 * @OA\Property(property="tags", type="string", readOnly="false",  description="", example="kyshi, FAQ, money"),
 * @OA\Property(property="liked", type="integer", readOnly="false",  description="", example="10"),
 * @OA\Property(property="disliked", type="integer", readOnly="false",  description="", example="0"),
 * @OA\Property(property="thumbnail", type="string", format="binary"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class FAQ
 *
 */

class FAQ extends Model
{
    use HasFactory;

    public function categories()
    {
        
        return $this->belongsToMany('App\Models\FAQCategory')->withTimestamps();

    }

    public function faqCountries()
    {
        return $this->hasMany('App\Models\FAQCountry', 'faq_id', 'id');
    }


    public function scopeSearch($query,$title)
    {
        if(!Empty($title)){
            return $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
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
