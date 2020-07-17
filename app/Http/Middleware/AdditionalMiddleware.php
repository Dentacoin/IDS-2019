<?php

namespace App\Http\Middleware;

use Closure;
use App;
use App\Http\Controllers\Admin\MainController;

class AdditionalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $params = $request->route()->parameters();
        if(isset($params['lang']) && $params['lang'] != 'ids-admin-access')  {
            $allowed_langs = ['de', 'en'];
            if(!in_array($params['lang'], $allowed_langs))    {
                //If website is loaded with not allowed language set locale bg and redirect to /bg
                App::setlocale('en');
                return redirect()->route('home', ['lang' => 'en']);
            }else {
                App::setlocale($request->route()->parameters()['lang']);
            }
            
            $response = $next($request);
            $response->headers->set('Referrer-Policy', 'no-referrer');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('X-Frame-Options', 'DENY');

            return (new App\Http\Controllers\Controller())->minifyHtml($response);
        } else {
            $admin_controller = new MainController();
            if($admin_controller->checkLogin()) {
                //LOGGED
                return response($admin_controller->getView());
                //return $next($request);
            }else {
                //NOT LOGGED
                return response($admin_controller->getAdminAccess());
            }
        }

    }
}
