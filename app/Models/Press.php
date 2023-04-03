<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *
 * @OA\Schema(
 * required={"title","slug","content","publish","visibility"},
 * @OA\Xml(name="Press"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Press Title", example="Men Collections"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="Press Slug. Note. is a unique field", example="men-collections"),
 * @OA\Property(property="content", type="string", description=" Press Content  ", example="Content"),
 * @OA\Property(property="visibility", type="string", description="visibility ", example="publish"),
 * @OA\Property(property="publish", type="string", format="date-time"),
 * @OA\Property(property="featured", type="boolean", readOnly="false",  description="", example="1"),
 * @OA\Property(property="image", type="string", format="binary"),
 * @OA\Property(property="source", type="string", description="Source ", example="cnn"),
 * @OA\Property(property="tags", type="string", readOnly="false",  description="", example="kyshi, Press, money"),
 * @OA\Property(property="link", type="string", description="link ", example="https://africa.googleblog.com/2022/09/meet-google-for-startups-black-founders.html"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class Press
 *
 */
class Press extends Model
{
    use HasFactory;

    public function scopeSearch($query,$title)
    {
        if(!Empty($title)){
            return $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
    }

    public function getImageAttribute($value)
    {
        if ($value == "") {

            return $value;

        } else {
            
            return  asset($value);
        }
    }
}
