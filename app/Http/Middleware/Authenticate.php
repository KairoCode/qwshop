<?php

namespace App\Http\Middleware;

use App\CloudErp\Traits\ResourceTrait;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use ResourceTrait;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        return null;
    }

    /**
     * 重新定义未认证用户返回信息
     * @throws \Exception
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new \Exception(__('tip.loginInv'));
    }

    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        } catch (\Exception $th) {
            return response()->json(['code' => 401, 'msg' => $th->getMessage(), 'data' => []]);
        }

        // 判断如果有配置.ENV 文件 可以关掉接口权限 设置为false
        if(!env('PERMISSION',true)) return $next($request);

        $thrMsg = ['code' => 403, 'msg' => __('tip.pmsThr'), 'data' => []];
        // 判断是否有权限访问
        try {
            $hasPermission = false;
            $act = $request->route()->getAction();
            $auth = explode(':', $act['middleware'][1])[1];

            if ($auth == 'users') return $next($request);
            if ($this->getService('base')->getSuper($auth)) $hasPermission = true; // 超级管理员拥有所有权限

            $roles = $this->getService('base')->getRoles($auth, ['permissions']);
            if (empty($roles['roles']) && !$hasPermission) {
                return response()->json($thrMsg);
            }
            if (isset($roles['roles']['permissions'])) {
                foreach ($roles['roles']['permissions'] as $v) {
                    if ($v['apis'] === $act['as']) $hasPermission = true;
                }
            }
            if (!$hasPermission) return response()->json($thrMsg);
        } catch (\Exception $th) {
            return response()->json($thrMsg);
        }

        return $next($request);
    }
}
