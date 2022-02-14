<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\v1\NotMatchCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialRequest;
use App\Http\Resources\CredentialCollection;
use App\Http\Resources\CredentialResource;
use App\Http\Resources\UserResource;
use App\Models\Credential;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $credentials = auth()->user()->credentials;




        return response()->json(
            [
                'massage' => 'successes',
                'data' => new CredentialCollection($credentials)
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CredentialRequest $request)
    {
        $validData = [
         'bank'=>$request->bank,
         'user_id' => auth()->user()->id,
         'shaba_id'=>$request->shaba_id,
         'card_id'=>$request->card_id,
         'account_id'=>$request->account_id,
         'expire_time'=>$request->expire_time,
        ];
        $credential = Credential::query()->create($validData);

        return response()->json(
            [
                'massage' => 'successes',
                'data' => new CredentialResource($credential),
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws NotMatchCredentialException
     */
    public function show($id)
    {
        $credential = auth()->user()->credentials->where('id',$id)->first();
        if($credential){
            return response()->json(
                [
                    'massage' => 'successes',
                    'data' => new CredentialResource($credential),
                ],
                200
            );
        }
        throw new NotMatchCredentialException();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $credential = auth()->user()->credentials->where('id',$id)->first();
        if($credential){
            $credential->delete();
            return response()->json(
                [
                    'massage' => 'successes',
                    'data' => [],
                ],
                200
            );
        }
        throw new NotMatchCredentialException();
    }
}
