<?php

namespace App\Exceptions\v1;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ForbiddenException extends Exception
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
                'massage' => 'Forbidden',
                'status' => 403,
            ], ResponseAlias:: HTTP_FORBIDDEN
        );
    }
}
