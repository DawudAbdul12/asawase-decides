<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"title","job_title","location"},
 * @OA\Xml(name="Career"),
 * @OA\Property(property="id", type="string", readOnly="true", example="1989329398392"),
 * @OA\Property(property="job_title", type="string", readOnly="false", description="Job Title", example="Software Developer"),
 * @OA\Property(property="slug", type="string", readOnly="false", description="Career Slug. Note. is a unique field", example="software-developer"),
 * @OA\Property(property="location", type="string", readOnly="false", description="Location", example="Nigeria"),
 * @OA\Property(property="application_link", type="string", readOnly="false",  description="Application Link ", example="kyshi.co/apply"),
 * @OA\Property(property="content", type="string", readOnly="false",  description="Application content "),
 * @OA\Property(property="tag", type="string", readOnly="false",  description="Application tag ", example="kyshi, career, software"),
 * @OA\Property(property="visibility", type="string", readOnly="false",  description="Application Status ", example="public / Private"),
 * @OA\Property(property="featured", type="boolean", readOnly="false",  description="", example="1"),
 * @OA\Property(property="publish", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="close_date", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class Blog Category
 *
 */

class Career extends Model
{
    use HasFactory;

    public function categories()
    {

        return $this->belongsToMany('App\Models\CareerCategory')->withTimestamps();

    }

    public function scopeSearch_location($query,$location)
    {
        if(!Empty($location)){
            return $query->where('location', 'like', '%'.$location.'%');
        }

        return $query;
    }
}
