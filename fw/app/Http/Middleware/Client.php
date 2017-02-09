<?php

namespace DwSetpoint\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class Client {
    private $auth = null;
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if($this->auth->user()->profile_id === \DwSetpoint\Models\Profile::CLIENT) {
            return $next($request);
        } 
        return redirect()->guest('/');
    }
}