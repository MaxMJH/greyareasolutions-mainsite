<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Utilities\SanitiserUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Enums\RoleEnum;
use Illuminate\Validation\Rules\Enum;

/**
 * This class acts as a way of managing registered accounts on the site.
 * In order to not create a model for this class, the User model will
 * be re-utilised.
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
class AccountsController extends Controller
{
    /**
     * Display the accounts view page of all registered users.
     * Bare in mind that this page is only available to administrators
     * due to the nature of shown information.
     * Done via a GET request.
     *
     * @return View Returns a View that allows the user to
     *              manage registered users.
     */
    public function getAccountsView(): View
    {
        // Check to see if a success or error has occurred.
        if (Session::has('error')) {
            // If an error has occurred, get its session value.
            $error = session('error');

            // Forget the session error.
            Session::forget('error');

            // Pass error to the view.
            return view('accounts', ['error' => $error]);
        } else if (Session::has('success')) {
            // If a success has occurred, get its session value.
            $success = session('success');

            // Forget the session success.
            Session::forget('success');

            // Pass the success to the view.
            return view('accounts', ['success' => $success]);
        } else {
            // If not, display the view normally.
            return view('accounts');
        }
    }

    /**
     * Displays a notification underlining whether or not the specified
     * user option failed or succeeded. Once that has been found, add a
     * session variable so that it can be displayed in the 'accounts'
     * view.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return View Returns the 'accounts.blade.php' view.
     */
    public function postAccounts(Request $request): View
    {
        // Check to see if success or error has been passed.
        if ($request->has('success')) {
            // If successful, return the success's value.
            Session::put('success', $request->input(['success']));
        } else {
            // If an error occurred, return the error's value.
            Session::put('error', $request->input(['error']));
        }

        // Return the 'accounts' view.
        return view('accounts');
    }

    /**
     * Returns all registered users to the site via JSON. Typically used
     * for the accounts table displayed in '/accounts'. This way, JS can be
     * used to display users within the table without any scrolling or
     * overflow, making it user-friendly.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return JsonResponse Returns a JsonResponse containing all users.
     */
    public function getAllUsers(Request $request): JsonResponse
    {
        // Return all users from the database in Json form, excluding password.
        return response()->json(['users' => User::all()]);
    }

    /**
     * Allows an administrator to view more information pertaining to the
     * selected user. This information contains account creation times,
     * how many times an account has failed to be logged into, etc...
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    public function postViewAccount(Request $request): JsonResponse
    {
        // Get the POST data.
        $userId = $request->input('user_id');
        $viewName = 'view_account_modal';

        // Return the JSON based on the 'obtainCorrectView's response.
        return $this->obtainCorrectView($userId, $viewName);
    }

    /**
     * Allows an administrator to observe an editable form of current
     * user information. Once the changes have been made, an update POST
     * request will be sent, and return the user back to the accounts view.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    public function postEditAccount(Request $request): JsonResponse
    {
        // Get the POST data.
        $userId = $request->input('user_id');
        $viewName = 'edit_account_modal';
        $action = $request->input('action');

        // Return the JSON based on the 'obtainCorrectView's response.
        return $this->obtainCorrectView($userId, $viewName, action: $action);
    }

    /**
     * Allows an administrator to updata inputted data from the edit form.
     * There will be checks prior to see if any of the changed data, mainly
     * the email does not already exist when changed (unless it is the same).
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    public function postUpdateAccount(Request $request): JsonResponse
    {
        // Obtain the intended action if one is specified.
        $action = $request->input('action');

        // Check to see if an action was specified.
        if ($action) {
            // Check to see if 'action/remove' was passed, 'action/edit', or send a failure.
            if ($action === '/accounts/remove') {
                // Get the passed user ID.
                $userId = $request->input('user')['user_id'];

                // Ensure that the user ID is validated.
                $validator = Validator::make(['userId' => $userId], [
                    'userId' => 'numeric',
                ]);

                // If the user ID failed to validate, send an error.
                if ($validator->fails()) {
                    return response()->json(['error' => 'Failed to validate']);
                }

                // Remove the user based on their ID, and store the number of deletions.
                $deleteCount = User::where('user_id', $userId)->delete();

                // Return a success if the user was deleted, error otherwise.
                return $deleteCount === 1 ? response()->json(['success' => 'Account Removed']) : response()->json(['error' => 'Failed to delete account']);
            } else if ($action === '/accounts/edit') {
                // Get the relevant data needed to edit a user, as well as the passed user ID.
                $userId = $request->input('user')['user_id'];
                $email = $request->input('user')['email'];
                $firstname = $request->input('user')['firstname'];
                $lastname = $request->input('user')['lastname'];
                $role = $request->input('user')['role'];

                // Ensure that the user ID is validated.
                $validator = Validator::make(['userId' => $userId, 'email' => $email, 'firstname' => $firstname, 'lastname' => $lastname, 'role' => $role], [
                    'userId' => 'bail|numeric',
                    'email' => 'min:6|max:255|email',
                    'firstname' => 'min:2|max:50',
                    'lastname' => 'min:2|max:50',
                    'role' => [new Enum(RoleEnum::class)],
                ]);

                // If the user ID fauled to validate, send an error.
                if ($validator->fails()) {
                    return response()->json(['error' => 'Failed to validate']);
                }

                // Check if the passed email exists anywhere in users.
                // If so, return error.
                // If not, updated on passed id (could be that we have a change in email entirely)
                $sanitiser = new SanitiserUtility(['email' => $email, 'firstname' => $firstname, 'lastname' => $lastname]);
                $sanitiser->strip()
                          ->trim()
                          ->forceToLower()
                          ->capitaliseFirstLetter(array_slice($sanitiser->getSanitisedInputs(), -2, null, true));

                // Get the sanitised inputs from the sanitiser.
                $sanitisedInputs = $sanitiser->getSanitisedInputs();

                // Paste the sanitised inputs back into the POST data.
                $email = $sanitisedInputs['email'];
                $firstname = $sanitisedInputs['firstname'];
                $lastname = $sanitisedInputs['lastname'];

                // Get a User instance based on the past user ID.
                $user = User::find($userId);

                // Check to see if the passed email, and the email from $user are the same.
                // If not, check to see if the passed email already exists in the table.
                // If none of the prior conditions are met, then an entirely new email has been passed.
                if ($user->email === $email) {
                    // If they are the same, note that role, firstname, or lastname is being changed.
                    $user->firstname = $firstname;
                    $user->lastname = $lastname;
                    $user->role = $role;

                    // Update the user based on the new data passed.
                    $user->save();

                    // Return a JSON signifying that the user was edited.
                    return response()->json(['success' => 'User edited']);
                } else if ($user->where('email', $email)->count() === 1) {
                    // New email passed already exists, so return an error.
                    return response()->json(['error' => 'User already exists']);
                } else {
                    // A non-database email has been passed, so create a new user based on the inputs.
                    $user = User::create([
                        'email' => $email,
                        'password' => $user->password,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'role' => $role,
                        'last_login' => null,
                        'failed_attempts' => 0,
                        'is_locked' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    // If a the user was created, return a success JSON, else return a JSON signifying that the user could not be found.
                    return $user ? response()->json(['success' => 'User created']) : response()->json(['error' => 'Failed to create user']);
                }
            } else {
                // Return a JSON signifying that the passed action is incorrect.
                return response()->json(['error' => 'Incorrect action']);
            }
        }
    }

    /**
     * Allows an administrator to remove a selected account from the database,
     * essentially deleting the entire user.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    public function postRemoveAccount(Request $request): JsonResponse
    {
        // Get the POST data as well as set 'viewName' and 'message'.
        $userId = $request->input('user_id');
        $viewName = 'confirmation_modal';
        $message = 'Are you sure you want to delete the following user?';
        $action = $request->input('action');

        // Return the JSON based on the 'obtainCorrectView's response.
        return $this->obtainCorrectView($userId, $viewName, $message, $action);
    }

    /**
     * Aims to populate the correct view with data pertaining to the passed userid.
     * If at any point the method fails, such failure is returned in JSON form.
     * If the method runs as intended, the entire user is returned in JSON form.
     *
     * @param string $userId   The intended user ID to fetch from the database.
     * @param string $viewName Name of the inteded modal view.
     * @param string $message  Message to show in modal. [Optional, Default = null]
     * @param string $action   Intended action. [Optional, Default = null]
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    private function obtainCorrectView(string $userId, string $viewName, string $message = null, string $action = null): JsonResponse
    {
        // Validate credentials.
        // Check to see if an action is specified, if so, ensure that is is equal to '/acounts/remove' or '/accounts/edit'.
        if ($action === '/accounts/remove') {
            $validator = Validator::make(['userId' => $userId, 'action' => $action], [
                'userId' => 'bail|numeric',
                'action' => 'in:/accounts/remove',
            ]);
        } else if ($action === '/accounts/edit') {
            $validator = Validator::make(['userId' => $userId, 'action' => $action], [
                'user_id' => 'bail|numeric',
                'action' => 'in:/accounts/edit',
            ]);
        } else {
            $validator = Validator::make(['userId' => $userId], [
                'user_id' => 'numeric',
            ]);
        }

        // Now check if it fails.
        if ($validator->fails()) {
            // If so, return a JSON signifying that the user ID failed to validate.
            return response()->json(['error' => 'Failed to validate']);
        }

        // Attempt to get a user via a user ID.
        $user = User::find($userId);

        // Check to see if a user was returned via the inputted ID.
        if ($user) {
            // Check to see if an message has been passed.
            $view = $message ? view($viewName, ['user' => $user, 'message' => $message])->render() : view($viewName, ['user' => $user])->render();

            // Return the view as JSON so it can be used via JQuery.
            return $action ? response()->json(['modal' => $view, 'user' => $user, 'action' => $action]) : response()->json(['modal' => $view, 'user' => $user]);
        } else {
            // Return a JSON signifying that the user could not be found.
            return response()->json(['error' => 'User does not exist']);
        }
    }
}
