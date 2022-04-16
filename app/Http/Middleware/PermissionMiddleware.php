<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = null, $guard = null)
    {
        $authGuard = app("auth")->guard($guard);

        /*if current authguard haven't login yet*/
        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        /*
         * if permission is not null
         * check permission is array or not
         * true : add permission
         * false: split the array and add
         */
        if (!is_null($permission)) {
            ddd("is not null permissions");
            $permissions = is_array($permission)
                ? $permission
                : explode("|", $permission);
        }

        /*
         * If permission is null
         * Get the current route name
         * add into permission
         */
        if(is_null($permission)){
            /*Get current name of route*/
            /*ex: admin.edit*/

            $permission = $request->route()->getName();
            $permissions = array($permission);
        }

        /*
         * Loop the permission
         * Check which permission that user can have
         * true: next request
         * false: end the loop
         */
        foreach($permissions as $permission){
            if($authGuard->user()->can($permission)){
                return $next($request);
            }
        }

        /*The case that user can not have any permissions*/
        throw UnauthorizedException::forPermissions($permissions);
    }
}
