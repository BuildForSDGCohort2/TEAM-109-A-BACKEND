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
           "token" => "test_$2y$10$85Myy8Eqmuz.V3V9SsRVaOu6GuqC8999lYkHHGBjsLgkX6HIXQ1Cq",
            "use_token" => true,
            "use_ip" => false
        ]
    ];
    public function handle($request, Closure $next)
    {

        
        $user_agent = $request->headers->get("User-Agent");
        $user_agent_token = $request->headers->get("User-Agent-Token");
      

        $user_agent_keys = array_keys($this->user_agents);
        
        if($user_agent_token != $this->user_agents['FARMUNITE_WEB']['token']) return redirect("https://www.google.com/search?q=welcome+to+google&oq=welcome+to+google");
        
        if(!in_array($user_agent,$user_agent_keys)) return redirect("https://www.google.com/search?q=welcome+to+google&oq=welcome+to+google");

        if(!$user_agent_token) return redirect("https://www.google.com/search?q=welcome+to+google&oq=welcome+to+google");
        
       
        return $next($request);
    }
}
