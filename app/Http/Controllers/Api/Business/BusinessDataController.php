<?php

namespace App\Http\Controllers\Api\Business;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\BusinessData;

use Illuminate\Http\JsonResponse;

class BusinessDataController extends Controller
{
    
    
    /** @OA\Post(
     * path="/api/v1/business-data/create",
     * summary="Create Business Data ",
     * description="Create Business Data",
     * operationId="createBusinessData",
     * tags={"BusinessData"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create a Business Data",
     *    @OA\JsonContent(
     *       required={"email","business_name","address","experience"},
     *       @OA\Property(property="email", type="string",  description="your email", example="user@example.com"),
     *       @OA\Property(property="business_name", type="string", description="your Business Name", example="trapzium"),
     *       @OA\Property(property="address", type="string",  description="your business address", example="Dansoman Roundabout, Accra"),
     *       @OA\Property(property="experience", type="string", description="Experience", example="Food & nightlife, sports events, talks & workshop"),
     *       @OA\Property(
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
     *    ),
     * ),
     * 
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *          @OA\Property(property="status", type="string",  example="1"),
     *          @OA\Property(property="message", type="string",  example="Record Added Successfully."),
     *          @OA\Property(property="business_data", type="object", ref="#/components/schemas/BusinessData")
     *      )
     * ),
     * 
     * )
     *
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request): JsonResponse
    {

        $this->validate($request, [
            'business_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:business_data'],
        ]);

        $bd = new BusinessData;
        $bd->business_name = $request->business_name;
        $bd->address = $request->address;
        $bd->email = $request->email;
        $bd->experience = $request->experience;
        $bd->location =  json_encode($request->location);

        // SAVE
        $bd->save();

        $response = [

            'status' => 1,
            'message' => "Record Added Successfully.",
            'business_data' => $bd
        ];

        return response()->json($response, 200);

    }

}
