<?php

use Illuminate\Support\Facades\Response;

function sendSuccess($message, $data = '') {
    return Response::json(array('status' => 200, 'message' => $message, 'data' => $data), 200, []);
}

function sendError($error_message, $code = 400) {
    return Response::json(array('status' => $code, 'error' => $error_message), $code)->setStatusCode($code, $error_message);
}
