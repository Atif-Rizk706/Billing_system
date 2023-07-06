<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Session as Session;

class local
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('local.status')) {
            if (Session::has('locale') && array_key_exists(Session::get('locale'), config('local.languages'))) {
                App::setLocale(Session::get('locale'));
            }
            else {

                $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $language) {

                    if (array_key_exists($language, config('local.languages'))) {
                        App::setLocale($language);


                        setlocale(LC_TIME, config('local.languages')[$language][2]);

                        Carbon::setLocale(config("local.languages") [$language][0]);

                        if (config('local.languages') [$language][2]) {

                            \session(['Lang-rtl' => true]);

                        } else {
                            Session::forget('lang-rtl');
                        }
                        break;

                    }
                }
            }
        }
        return $next($request);
    }
}

