<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimit404Requests
{
    public function handle(Request $request, Closure $next)
    {
        // Lưu trữ tạm thời số lượng yêu cầu từ IP
        $key = 'rate_limit_404_' . $request->ip();

        // Kiểm tra nếu yêu cầu dẫn đến lỗi 404
        $response = $next($request);

        // Nếu mã lỗi là 404, kiểm tra rate limit
        if ($response->getStatusCode() == 404) {
            if (RateLimiter::tooManyRequests($key, 10)) { // Giới hạn 10 yêu cầu
                // Nếu vượt quá giới hạn, trả về lỗi 429 (Too Many Requests)
                return response()->json(['message' => 'Too many 404 requests'], 429);
            }

            // Tăng số lượng yêu cầu
            RateLimiter::hit($key, 60); // Reset sau 60 giây
        }

        return $response;
    }
}