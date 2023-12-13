<?php

namespace App\Helpers;

class Pattern
{
    /**
     * @param $type success | error
     * @param $message
     * @param $httpResponse
     * @param $additionalData
     * @return array
     */
    public static function responseJsonDefault($type, $message, $additionalData = null) {
        $response = [
            'status' => $type,
            'message' => $message
        ];
        if (!empty($additionalData)){
            $response['data'] = $additionalData;
        }
        return $response;
    }
}
