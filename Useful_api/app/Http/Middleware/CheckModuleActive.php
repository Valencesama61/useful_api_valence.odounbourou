<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\UserModule;
use App\Traits\HttpResponses;

class CheckModuleActive
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,  Closure $next): Response
    {
        $user = $request->user();
        
        $exist = UserModule::where('user_id', $user->id)
                            ->where('module_id', $module->id)
                            ->exists();

        if(Auth::check() &&  $exist) {
            return $next($request);
        }
        return $this->error([
            'error' => 'Module inactive. Please activate this module to use it.'
        ],'', 403);
    }
}
