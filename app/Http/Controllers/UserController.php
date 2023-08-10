<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Utilities\SanitiserUtility;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * This class acts as the User model's controller, therefore
 * processing various data sent by the user, and conducting
 * various tasks against the model itself.
 *
 * Each of this class's methods map to a specific route.
 *
 * @package App\Http\Controllers
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @version v0.0.1
 */
class UserController extends Controller
{
    /**
     * Redirect the user to '/blogs' if logged in, or display the login page to
     * all users. Done via a GET request.
     *
     * @return RedirectResponse|View Returns a RedirectResponse that sends the
     *                               user back the '/blogs' if already logged in,
     *                               or returns a blade view which shows the login page.
     */
    public function getLoginView(): RedirectResponse | View
    {
        return Auth::check() ? redirect('/blogs') : view('login');
    }

    /**
     * Attemots to login a user depending on the entered
     * credentials. This method will currently first
     * attempt to validate the entered credentials, and if
     * correct, will then create a session pertaining to that
     * specific user. Done via a POST request.
     *
     * @param Request $request  Obtain the incoming request.
     *
     * @return RedirectResponse Returns a RedirectResponse based on the inputted data.
     */
    public function postLoginAuthenticate(Request $request): RedirectResponse
    {
        // Validate and sanitise credentials.
        // Check to see if the inputs are 'generally' valid.
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|min:6|max:255|email',
            'password' => 'required|min:6|max:255',
        ]);

        // Now check if it fails, if so, send errors back to the GET page.
        if ($validator->fails()) {
            // Rather than exposing the exact validation error, send back a generic error.
            return redirect()->back()->with('error', 'Unable to login')->withInput($request->only('email'));
        }

        // Create an instance of SanitiserUtility and perform stripping, trimming, and lowercasing.
        $sanitiser = new SanitiserUtility($request->only(['email', 'password']));
        $sanitiser->strip()->trim()->forceToLower();

        // Get the now sanitised inputs back from the sanitiser.
        $sanitisedInputs = $sanitiser->getSanitisedInputs();

        // Perform the validate method to check if the credentials are valid.
        if (Auth::attempt($sanitisedInputs)) {
            // User does exist within the database, and the password is correct, now start session.
            $request->session()->regenerate();

            // Redirect to the blogs page.
            return redirect()->to('/blogs');
        } else {
            // Send a redirect back indicating that login failed.
            return redirect()->back()->with('error', 'Unable to login')->withInput($request->only('email'));
        }
    }
}
