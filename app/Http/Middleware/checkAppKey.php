<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class checkAppKey {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $headers = getallheaders();
        if (isset($headers['app_key'])) {
            if ($headers['app_key'] == 'XYkNNiy+7OdL/+eF2P7KzztzDS76iAw5sjy0QhszDjc=') {
                return $next($request);
            } else {
                return sendError('You Are Not Autherize For App', 400);
                //return Response::json(array('status'=>'error','errorMessage'=>'You Are Not Autherize For App'));   
            }
        } else {
            return sendError('You Are Not Autherize For App', 400);
            //return Response::json(array('status'=>'error','errorMessage'=>'You Are Not Autherize For App'));   
        }
    }

}
