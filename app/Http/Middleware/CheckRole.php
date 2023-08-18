<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;

/*
 * This class is to be utilised as a middleware that checks
 * if a user has a specific role. If a user has a specific role,
 * then they shall be gained access to the specific route. In order
 * to get the user's current role, they must be signed in, as the class
 * uses Laravel's Auth facade.
 *
 * @package App\Http\Middleware
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @version v0.0.1
 */
class CheckRole
{
    /**
     * Handles the incoming request. As it is expected for a specific role
     * to be passed when the route is created, said passed role will be checked,
     * and will determine whether or not the requesting user has access to that route.
     * At this current time, this middleware will check if the user has a role of 'Admin'
     * or 'Blogger'.
     *
     * @param Request $request Obtain the incoming request.
     * @param Closure $next    Obtain the desired closure that will be sent if the
     *                         user has the correct role.
     * @oaram string $role     Role specified that will have access to the route that
     *                         the middleware is attached to.
     *
     * @return Response If the user has the correct role, the request will be passed to
     *                  the actual route, if not, an abort of status code 401 will be
     *                  returned.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Get the currently authenticated user, if any.
        $user = Auth::user();

        // Check to see if a valid authenticated user exists.
        if (!$user) {
            // If not, the user is not logged in, meaning restrict access to following route.
            abort(401);
        }

        // Check to see if the role is 'Admin' or 'Blogger'.
        switch ($role) {
            case RoleEnum::Admin->value:
                // Check to see if the authenticated user's role is that of 'Admin'.
                if ($user->role === RoleEnum::Admin) {
                    // If so, allow the request to be passed to the actual route.
                    return $next($request);
                }
                break;
            case RoleEnum::Blogger->value:
                // Check to see if the authenticated user's role is that of 'Blogger'.
                if ($user->role === RoleEnum::Blogger) {
                    // If so, allow the request to be passed to the actual route.
                    return $next($request);
                }
                break;
            default:
                // If the authenticated user's role is not 'Admin' or 'Blogger', refuse access.
                abort(401);
        }
    }
}
