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
        //Vérification module 1
        if(str_contains($request->path(), '/shorten') || str_contains($request->path(), '/s') 
            || str_contains($request->path(), '/links') ){
                
                $user = $request->user();
                
                $exist = UserModule::where('user_id', $user->id)
                                    ->where('module_id', 1)
                                    ->exists();

                if(Auth::check() &&  $exist) {
                    return $next($request);
                }   
            }
            //Vérification module 2
        if(str_contains($request->path(), '/wallet') || str_contains($request->path(), '/wallet/transfer') 
            || str_contains($request->path(), '/wallet/topup') || str_contains($request->path(), '/wallet/transactions')){
                
                $user = $request->user();
                
                $exist = UserModule::where('user_id', $user->id)
                                    ->where('module_id', 2)
                                    ->exists();

                if(Auth::check() &&  $exist) {
                    return $next($request);
                }   
            }
            //Vérification module 3
        if(str_contains($request->path(), '/products') || str_contains($request->path(), '/orders')){
                
                $user = $request->user();
                
                $exist = UserModule::where('user_id', $user->id)
                                    ->where('module_id', 3)
                                    ->exists();

                if(Auth::check() &&  $exist) {
                    return $next($request);
                }   
            }
        //Vérification module 4
        if(str_contains($request->path(), '/sessions')){
                    
             $user = $request->user();
                    
            $exist = UserModule::where('user_id', $user->id)
                                ->where('module_id', 4)
                                ->exists();

            if(Auth::check() &&  $exist) {
                return $next($request);
            }   
        }
            
            //Vérification module 5
        if(str_contains($request->path(), '/assets') || str_contains($request->path(), '/investments')
            || str_contains($request->path(), '/portfolio') || str_contains($request->path(), '/transactions')){
                    
            $user = $request->user();
                    
            $exist = UserModule::where('user_id', $user->id)
                                ->where('module_id', 5)
                                ->exists();

            if(Auth::check() &&  $exist) {
                return $next($request);
            }   
        }

        return $this->error([
            'error' => 'Module inactive. Please activate this module to use it.'
        ],'', 403);
    }
}
