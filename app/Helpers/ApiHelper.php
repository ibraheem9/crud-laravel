<?php

/**
 * Send a standardized JSON response for AJAX requests.
 *
 * @param mixed  $data
 * @param string $message
 * @param bool   $status
 * @param int    $code
 * @param mixed  $auth_data
 * @param mixed  $temp
 * @param mixed  $meta
 * @return \Illuminate\Http\JsonResponse
 */
function sendResponse(
    $data = '', $message = '', $status = true, $code = 200,
    $auth_data = null, $temp = null, $meta = null
)
{
    ini_set('serialize_precision', -1);

    $result = [
        'status' => $status,
        'code'   => $code,
        'msg'    => $message,
        'data'   => $data,
    ];
    if ($auth_data) {
        $result['auth_data'] = $auth_data;
    }
    if (config('app.env') == "local") {
        if ($temp) {
            $result['temp'] = $temp;
        }
    }
    if ($meta) {
        $result['meta'] = $meta;
    }
    return response()->json($result)->setStatusCode($code);
}

/**
 * Send a plain PHP array response (non-JSON).
 */
function sendPhpResponse($data = '', $message = '', $status = true, $code = 200)
{
    return ['status' => $status, 'code' => $code, 'msg' => $message, 'data' => $data];
}

/**
 * Get the real IP address of the client.
 */
function getRealIpAddr()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
