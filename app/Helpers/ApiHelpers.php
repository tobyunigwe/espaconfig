<?php

namespace App\Helpers;

class ApiHelpers {

    /**
     * Creates Api response after making requests.
     *
     * @param $error
     * @param $code
     * @param $message
     * @param $data
     * @return array
     */
    public static function apiResponse($error, $code, $message, $data)
    {
        $result = [];

        //Error check
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
