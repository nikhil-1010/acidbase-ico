<?php

namespace App\Http\Middleware;
use App\Model\Setting;
use Illuminate\Support\Facades\View;
use Log;
use Closure;
 
class maintenance
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
        

        $settings=app('settings');
        // dd($request->is('api/*'));
        if(isset($settings['maintenance_mode']) && $settings['maintenance_mode']==1){
            
            if ($request->is('api/*')) {
              $res = [
                    'flag' => 8,
                    'msg'  => "Site is Under Maintenance.",
                ];
                return response()->json($res,200); 
            }
            // \Auth::guard('user')->logout();
            return redirect ('/maintainence');
            
        }else{
            return $next($request);
        }
         
        
    }


}
