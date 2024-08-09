<?php

if (! function_exists('getUser')) {
    function getUser($token) {
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        if ($accessToken && $accessToken->tokenable) {
            return $accessToken->tokenable;
        }
        return null;
    }
}

if (! function_exists('checkPermission')) {
    function checkPermission($name): bool
    {
        if (!auth()->user()->can($name)) {
            return false;
        }

        return true;
    }
}
