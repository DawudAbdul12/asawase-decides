<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"email","business_name","address","experience"},
 * @OA\Xml(name="BusinessData"),
 * @OA\Property(property="id", type="string", readOnly="true", example="11245"),
 * @OA\Property(property="email", type="string", readOnly="false", description="your email", example="user@example.com"),
 * @OA\Property(property="type", type="string", readOnly="false", description="record type", example="business"),
 * @OA\Property(property="business_name", type="string", readOnly="false", description="your Business Name", example="trapzium"),
 * @OA\Property(property="address", type="string", readOnly="false",  description="your business address", example="Dansoman Roundabout, Accra"),
 * @OA\Property(property="experience", type="string", description="Experience", example="Food & nightlife, sports events, talks & workshop"),
 * @OA\Property(
 * 
 *           property="location",
 *           type="object",
 *                  @OA\Property(property="street_number", type="string", example="213"),
 *                  @OA\Property(property="route", type="string", example="Hamburgo"),
 *                  @OA\Property(property="political", type="string", example="Juárez"),
 *                  @OA\Property(property="administrative_area_level_1", type="string", example="Hamburgo"),
 *                  @OA\Property(property="country", type="string", example="Mexico"),
 *                  @OA\Property(property="postal_code", type="string", example="06600"),
 *                  @OA\Property(property="lat", type="string", example="19.4245"),
 *                  @OA\Property(property="lon", type="string", example="-99.1688"),
 *                  @OA\Property(property="address", type="string", example="Hamburgo 213, Juárez, Mexico City, CDMX, Mexico"),
 *                  @OA\Property(property="city", type="string", example="Ciudad de México"),
 *                  @OA\Property(property="is_active", type="string", example="true"),
 *         ),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at")
 * )
 *
 * Class BusinessData
 *
 */


class BusinessData extends Model
{
    use HasFactory;

    public function getLocationAttribute($value)
    {
        return json_decode($value);
    }
}
