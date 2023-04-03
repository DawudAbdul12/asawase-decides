<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","slug","parent"},
 * @OA\Xml(name="BlogCategory"),
 * @OA\Property(property="id", type="string", readOnly="true", example="1989329398392"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Category Title", example="Men Collections"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="Category Slug. Note. is a unique field", example="men-collections"),
 * @OA\Property(property="parent", type="string", readOnly="false",  description="0 if the category is a parent category ", example="0"),
 * @OA\Property(property="position",  description="category position ",type="integer", example="1"),
 * @OA\Property(property="publish", type="boolean", example="true"),
 * @OA\Property(property="content", type="string", example="content"),
 * @OA\Property(property="image", type="string", format="binary"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class Blog Category
 *
 */

class BlogCategory extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(BlogCategory::class, 'parent', 'id');
    }

    public function sub_categories()
    {
        return $this->hasMany(BlogCategory::class, 'parent', 'id');
    }

    public function scopeSearch($query,$title)
    {
        if(!Empty($title)){
            return $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
    }
}
