<?php

namespace App\Exceptions\v1;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NotMatchCredentialException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json(
            [
                'massage' => 'Not Matching Credential',
                'status' => 422,
            ], ResponseAlias:: HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
