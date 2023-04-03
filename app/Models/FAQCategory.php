<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","slug"},
 * @OA\Xml(name="FAQCategory"),
 * @OA\Property(property="id", type="string", readOnly="true", example="1989329398392"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Category Title", example="Men Collections"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="Category Slug. Note. is a unique field", example="men-collections"),
 * @OA\Property(property="position",  description="category position ",type="integer", example="1"),
 * @OA\Property(property="publish", type="boolean", example="true"),
 * @OA\Property(property="content", type="string", example="content"),
 * @OA\Property(property="icon", type="string", format="binary"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class FAQ Category
 *
 */


class FAQCategory extends Model
{
    use HasFactory;

    public function faqs()
    {
        
        return $this->belongsToMany('App\Models\FAQ')->withTimestamps();

    }

    public function scopeSearch($query,$title)
    {
        if(!Empty($title)){
            return $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
    }


    public function getIconAttribute($value)
    {
        if ($value == "") {

            return $value;

        } else {
            
            return  asset($value);
        }
    }
}
