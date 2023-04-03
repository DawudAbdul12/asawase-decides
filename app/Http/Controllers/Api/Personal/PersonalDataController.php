<?php

namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\PersonalData;

use Illuminate\Http\JsonResponse;


class PersonalDataController extends Controller
{
    

     /** @OA\Post(
     * path="/api/v1/personal-data/create",
     * summary="Create Personal Data ",
     * description="Create Personal Data",
     * operationId="createPersonalData",
     * tags={"PersonalData"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create a Personal Data",
     *    @OA\JsonContent(
     *      required={"email","first_name","last_name","experience"},
     *      @OA\Property(property="email", type="string",  description="your email", example="user@example.com"),
     *      @OA\Property(property="first_name", type="string",  description="your first name", example="mark"),
     *      @OA\Property(property="last_name", type="string",   description="your last name", example="Benzy"),
     *      @OA\Property(property="experience", type="string", description="Experience", example="Food & nightlife, sports events, talks & workshop"),
     *    ),
     * ),
     * 
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *          @OA\Property(property="status", type="string",  example="1"),
     *          @OA\Property(property="message", type="string",  example="Record Added Successfully."),
     *          @OA\Property(property="personal_data", type="object", ref="#/components/schemas/PersonalData")
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:personal_data'],
        ]);

        $pd = new PersonalData;
        $pd->first_name = $request->first_name;
        $pd->last_name = $request->last_name;
        $pd->email = $request->email;
        $pd->experience = $request->experience;

        // SAVE
        $pd->save();

        $response = [

            'status' => 1,
            'message' => "Record Added Successfully.",
            'personal_data' => $pd
        ];

        return response()->json($response, 200);

    }

}
