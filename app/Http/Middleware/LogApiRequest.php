<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class LogApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	// Tiếp tục xử lý yêu cầu
	$response = $next($request);
        //return $response;

        // Ghi log vào database
        DB::table('api_logs')->insert([
            'method' => $request->method(),
            'endpoint' => $request->path(),
            'request_payload' => json_encode($request->all()),
            'response_payload' => json_encode($response->getContent()),
            'status_code' => $response->status(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $response;
    }
}
