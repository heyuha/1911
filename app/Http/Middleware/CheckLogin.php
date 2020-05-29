<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $loginInfo = session("adminInfo");
        // dd($loginInfo)
        if(!$loginInfo){

            // 七天免登录
            $cookie_name = request()->cookie("adminInfo");
            if($cookie_name){
                session(['adminInfo'=>unserialize($cookie_name)]);
            }else{
                return redirect("/login");
            }


            
        }

        return $next($request);
    }
}
