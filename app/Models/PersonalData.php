<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"email","first_name","last_name","experience"},
 * @OA\Xml(name="PersonalData"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="email", type="string", readOnly="false", description="your email", example="user@example.com"),
 * @OA\Property(property="first_name", type="string", readOnly="false", description="your first name", example="mark"),
 * @OA\Property(property="last_name", type="string", readOnly="false",  description="your last name", example="Benzy"),
 * @OA\Property(property="experience", type="string", description="Experience", example="Food & nightlife, sports events, talks & workshop"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class PersonalData
 *
 */


class PersonalData extends Model
{
    use HasFactory;
}
