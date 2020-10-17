<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Member;
use Closure;

class AuthorizeMember
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = request()->header('x-api-key');
        $member = Member::where('api_token',$token)->first();
        if($member)
        {
            request()->member = $member;
            return $next($request);
        }
        return $this->ApiResponse(false, [__('site.unauthorized')], __('site.unauthorized'), [], 401);
    }
}
