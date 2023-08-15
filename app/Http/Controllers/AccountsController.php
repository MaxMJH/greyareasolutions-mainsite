<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @return View Returns a View based on the selected user.
     */
    public function postViewAccount(Request $request): View
    {
        return view('view_account');
    }

    /**
     * Allows an administrator to observe an editable form of current
     * user information. Once the changes have been made, an update POST
     * request will be sent, and return the user back to the accounts view.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return View Returns a View based on the selected user.
     */
    public function postEditAccount(Request $request): View
    {
        return view('edit_account');
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
     * @return RedirectResponse Returns a RedirectResponse based on the selected user.
     */
    public function postRemoveAccount(Request $request): RedirectResponse
    {

    }
}
