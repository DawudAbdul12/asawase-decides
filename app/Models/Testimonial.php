<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","fullname","content","publish","visibility"},
 * @OA\Xml(name="Testimonial"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Blog Title", example="Mr"),
 * @OA\Property(property="fullname", type="string", readOnly="false", description="Blog Title", example="John Joe"),
 * @OA\Property(property="profession", type="string", readOnly="false", description="profession", example="Software"),
 * @OA\Property(property="company", type="string", readOnly="false",  description="company", example="effectstudios"),
 * @OA\Property(property="content", type="string", description=" Blog Content  ", example="Content"),
 * @OA\Property(property="visibility", type="string", description="visibility ", example="publish"),
 * @OA\Property(property="publish", type="string", format="date-time"),
 * @OA\Property(property="featured", type="boolean", readOnly="false",  description="", example="1"),
 * @OA\Property(property="tags", type="string", readOnly="false",  description="", example="kyshi, blog, money"),
 * @OA\Property(property="profile_img", type="string", format="binary"),
 * @OA\Property(property="platform_source", type="string", readOnly="false",  description="", example="AppStore"),
 * @OA\Property(property="stars", type="string", readOnly="false",  description="", example="1"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class Testimonial
 *
 */

class Testimonial extends Model
{
    use HasFactory;

    public function scopeSearch($query,$keyword)
    {
        if(!Empty($keyword)){
            return $query->where('fullname', 'like', '%'.$keyword.'%')
                            ->orWhere('tag', 'like', '%'.$keyword.'%');
        }

        return $query;
    }

    

    public function getProfileImgAttribute($value)
    {
        if ($value == "") {

            return $value;

        } else {
            
            return  asset($value);
        }
    }
}
