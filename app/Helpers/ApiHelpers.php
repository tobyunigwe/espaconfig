<?php

namespace App\Helpers;

class ApiHelpers {

    public static function apiResponse($error, $code, $message, $data)
    {
        $result = [];

        if ($error) {
            $result['success'] = false;
            $result['code'] = $code;
            $result['message'] = $message;
        } else {
            $result['success'] = true;
            $result['code'] = $code;

            if ($data == null) {
                $result['message'] = $message;
            } else {
                $result['data'] = $data;
            }
        }

        return $result;
    }
}
