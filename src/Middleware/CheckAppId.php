<?php


namespace Jalen\MpAdmin\Middleware;

use Closure;
use Jalen\MpAdmin\Models\MpInfo;
use Jalen\MpAdmin\Traits\ApiResponse;

class CheckAppId
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->header('Mp-Sign')) {
            return $this->failed('缺少 MpSign 参数');
        }
        $sign = $request->header('Mp-Sign');
        $model = MpInfo::where('sign', $sign)->first();
        if (!$model) {
            return $this->failed('MpSign 参数有误');
        }
        $mid_params['mp_info'] =  $model;
        $request->attributes->add($mid_params); //添加参数
        return $next($request);
    }
}