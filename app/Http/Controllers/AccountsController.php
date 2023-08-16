<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Utilities\SanitiserUtility;
use Carbon\Carbon;

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
        return view('accounts');
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
        return $this->obtainCorrectView($request->only(['user_id']), 'view_account_modal');
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
        return $this->obtainCorrectView($request->only(['user_id']), 'edit_account_modal');
    }

    /**
     * Allows an administrator to updata inputted data from the edit form.
     * There will be checks prior to see if any of the changed data, mainly
     * the email does not already exist when changed (unless it is the same).
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return RedirectResponse Returns a RedirectResponse based on the selected user.
     */
    public function postUpdateAccount(Request $request): RedirectResponse
    {

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
        // Will launch the confirmation modal.
        // If the confirm is clicked, need to send a post request to update.
        // Probably needs to be done via jquery.
        return $this->obtainCorrectView($request->only(['user_id']), 'confirmation_modal', 'Are you sure you want to delete the following user?');
    }

    /**
     * Aims to populate the correct view with data pertaining to the passed userid.
     * If at any point the method fails, such failure is returned in JSON form.
     * If the method runs as intended, the entire user is returned in JSON form.
     *
     * @param array $userId The intended user ID to fetch from the database.
     * @param string $viewName Name of the inteded modal view.
     *
     * @return JsonResponse Returns a JsonResponse based on the selected user.
     */
    private function obtainCorrectView(array $userId, string $viewName, string $message = null): JsonResponse
    {
        // Validate credentials.
        // Check to see if the inputs are 'generally valid'.
        $validator = Validator::make($userId, [
            'user_id' => 'numeric',
        ]);

        // Now check if it fails.
        if ($validator->fails()) {
            // If so, return a JSON signifying that the user ID failed to validate.
            return response()->json(['error' => 'Failed to validate']);
        }

        // Attempt to get a user via a user ID.
        $user = User::find($userId['user_id']);

        // Check to see if a user was returned via the inputted ID.
        if ($user) {
            // Check to see if a custom message has been passed (generally used for confirmation modal usage).
            if ($message) {
                // Add the results of the found user to the modal, and get the final HTML.
                $view = view($viewName, ['user' => $user, 'message' => $message])->render();
            } else {
                // Add the results of the found user to the modal, and get the final HTML.
                $view = view($viewName, ['user' => $user])->render();
            }
            // Return the view as JSON so it can be used via JQuery.
            return response()->json(['modal' => $view]);

        } else {
            // Return a JSON signifying that the user could not be found.
            return response()->json(['error' => 'User does not exist']);
        }
    }
}
