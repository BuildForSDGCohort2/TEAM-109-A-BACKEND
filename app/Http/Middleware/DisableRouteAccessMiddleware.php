<?php

namespace App\Http\Middleware;

use Closure;

class DisableRouteAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $user_agents = [
        "FARMUNITE_ANDROID" => [
            "token" => 'test_$2y$10$3vONa6abE/53tpmBCj0Xb.KcgVrB1zTaj3LSOcckF4ftUMuHO9cFu',
            "use_token" => true,
            "use_ip" => false
        ],
        "FARMUNITE_IOS" => [
            "token" => 'test_$2y$10$pFw76XeU83xCOYhZUoMjz.yYVLlM5KnPwTxFxBhnrZ0sqzedi1aAe',
            "use_token" => true,
            "use_ip" => false
        ],
        "FARMUNITE_WEB" => [
            "token" => "V3V9SsRVaOu6Gu1Cq",
//            "token" => "test_$2y$10$85Myy8Eqmuz.V3V9SsRVaOu6GuqC8999lYkHHGBjsLgkX6HIXQ1Cq",
            "use_token" => true,
            "use_ip" => false
        ]
    ];
    public function handle($request, Closure $next)
    {

       return $user_agent = $request->headers->get("User-Agent");
        $user_agent_web_key = $request->headers->get("User-Agent-Key");
        $user_agent_token = $request->headers->get("User-Agent-Token");
        $user_ip = $request->ip();


        $user_agent_keys = array_keys($this->user_agents);
        if($user_agent_web_key && $user_agent_web_key =="FARMUNITE_WEB"){
            $user_agent = $user_agent_web_key;
        }

        return $next($request);
    }
}
