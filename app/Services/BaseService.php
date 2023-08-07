<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseService
{
    protected function executeFunction(callable $function)
    {
        try {
            DB::beginTransaction();
            $data = call_user_func($function);
            DB::commit();
            return $this->generalResponse(200, 'Good', $data, 200, 'Good', null);
        } catch (Exception $e) {
            // DB::rollback();
            return $this->generalResponse(500, 'Failed', null, 500, 'DB', $e->getMessage());
        }
    }

    public function generalResponse(
        $code,
        $message,
        $result = null,
        $httpCode = 200,
        $errorMessage = null,
        $line = null
    ) {
        if ($httpCode === 200) {
            return response()->json(
                [
                    "code" => $code,
                    "message" => $message,
                    "result" => $result,
                ],
                $httpCode
            );
        }
        return response()->json(
            [
                "code" => $code,
                "message" => $message,
                "error" => [
                    "module" => $errorMessage,
                    'message' => $line
                ]
            ],
            $httpCode
        );
    }
}