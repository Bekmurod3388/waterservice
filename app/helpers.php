<?php

if (! function_exists('getUser')) {
    function getUser($token) {
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        if ($accessToken->tokenable) {
            return $accessToken->tokenable;
        }
        return null;
    }
}
