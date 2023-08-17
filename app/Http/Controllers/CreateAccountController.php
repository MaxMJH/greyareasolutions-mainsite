<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Utilities\SanitiserUtility;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Enums\RoleEnum;

/**
 * This class acts as a way of creating a new account on the site.
 * In order to not create a model for this class, the User model
 * will be re-utilised.
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
class CreateAccountController extends Controller
{
    /**
     * Display the account creation page to all users.
     * Done via a GET request.
     *
     * @return View Returns a View that sends the user to the
     *              account creation page.
     */
    public function getCreateAccountView(): View
    {
        return view('create_account');
    }

    /**
     * Attempts to create a user based on the entered inputs. This
     * method will first validate and sanitise the input, and attempt
     * to create the new user, as well as logging said user into their account.
     * If the user is already logged in, their session will be switched to the newly
     * created user.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return RedirectResponse Returns a RedirectResponse based on the inputted data.
     */
    public function postCreateAccount(Request $request): RedirectResponse
    {
        // Validate and sanitiise credentials.
        // Check to see if the inputs are 'generally' valid.
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|min:6|max:255|email',
            'firstname' => 'required|min:2|max:50',
            'lastname' => 'required|min:2|max:50',
            'password' => 'required|min:6|max:255|same:confirmpassword',
            'confirmpassword' => 'required|min:6|max:255|same:password',
        ]);

        // Now check if it fails, if so, send error back to the GET page.
        if ($validator->fails()) {
            // Rather than exposing the exact validation error, send back a generic error.
            return redirect()->back()->with('error', 'Creation failed');
        }

        // Create an instance of SanitiserUtility and perform stripping, trimming, lowercasing, and capitalising the first letter of 'firstname' and 'lastname'.
        $sanitiser = new SanitiserUtility($request->only(['email', 'firstname', 'lastname', 'password', 'confirmpassword']));
        $sanitiser->strip()
                  ->trim()
                  ->forceToLower()
                  ->capitaliseFirstLetter($request->only(['firstname', 'lastname']));

        // Get the new sanitised inputs back from the sanitiser.
        $sanitisedInputs = $sanitiser->getSanitisedInputs();

        // Check to see if the passed email already exists.
        if (!User::userExists($sanitisedInputs['email'])) {
            // Now attempt to create the new user, as validation, sanitisation, and availability has passed.
            $user = User::create([
                'email' => $sanitisedInputs['email'],
                'password' => Hash::make($sanitisedInputs['password']),
                'firstname' => $sanitisedInputs['firstname'],
                'lastname' => $sanitisedInputs['lastname'],
                'role' => RoleEnum::User,
                'last_login' => Carbon::now(),
                'failed_attempts' => 0,
                'is_locked' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Check to see if the user failed to be created.
            if ($user === null) {
                return redirect()->back()->with('error', 'Creation failed');
            }

            // Before the user is logged in to the new account, ensure that they are logged out.
            if (Auth::check()) {
                Auth::logout();
                $request->session()->regenerate();
                $request->session()->regenerateToken();
            }

            // Now log the user into the newly created account.
            if (Auth::attempt(['email' => $sanitisedInputs['email'], 'password' => $sanitisedInputs['password']])) {
                $request->session()->regenerate();
            } else {
                // If user failed to login, return the user back to the creation page with a generic error.
                return redirect()->back()->with('error', 'Failed to login');
            }

            // Redirect to the blogs page.
            return redirect()->to('/blogs');
        } else {
            // If the email exists, return the user back to the creation page with a generic error.
            return redirect()->back()->with('error', 'User exists');
        }
    }
}
