<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * This class is to be utilised as a middleware that checks
 * if the calling page's referrer. In more detail, it is expected
 * that this middleware will be used when synergised with a JS
 * script, sending a request to the route in which this middleware
 * is attached to. If the referrer is not what is expected, return a
 * 403 status code.
 *
 * @package App\Http\Middleware
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @version v0.0.1
 */
class CheckReferrer
{
    /**
     * Handles the incoming request. Checks the route where the
     * inteded request was called. So, if a GET request was sent from
     * '/accounts' to '/accounts/allusers', then the referrer would be
     * '/accounts'. If the inteded route is called from any other route
     * that has not been specified as the expected referrer, status code
     * 403 will be returned.
     *
     * @param Request $request Obtain the incoming request.
     * @param Closure $next    Obtain the desired closure that will be sent
     *                         if the correct referrer matches the expected.
     * @param string $referrer Expected referrer that calls the route to which
     *                         this middleware is attached to.
     *
     * @return Response If the correct referrer is specified, the route's controller
     *                  will be called, if not, an abort of status code 403 will be
     *                  returned,
     */
    public function handle(Request $request, Closure $next, string $referrer): Response
    {
        // Check if the calling route has the specified referrer.
        if (str_contains(url()->previous(), $referrer)) {
            // If so, call the route's inteded controller method.
            return $next($request);
        }

        // If the referrer is incorrect, abort.
        abort(403);
    }
}
