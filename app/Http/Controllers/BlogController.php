<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

/**
 * This class acts as the Blog model's controller, therefore
 * processing various data sent by a user, and conducting
 * various tasks against the model itself.
 *
 * Each of this class's methods map to a specific route, or if
 * private, a decoupler.
 *
 * @package App\Http\Controllers
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @version v0.0.1
 */
class BlogController extends Controller
{
    /**
     * Displays the blogs page that contain all blogs created
     * by admins / bloggers.
     * Done via a GET request.
     *
     * @return View Returns a view showing all blogs within the database.
     */
    public function getBlogsView(): View
    {
        return view('all_blogs', ['blogs' => Blog::all(), 'users' => Blog::getBlogOwners()]);
    }

    /**
     * Displays an individual blog, depending on if the passed slug in the route
     * actually exists within the table.
     *
     * @param Blog $blog The corresponding blog that contains the passed slug, if any.
     *
     * @return View Returns a view showing the contents of a specific blog.
     */
    public function getBlogView(Blog $blog): View
    {
        return view('blog', ['blog' => $blog]);
    }

    /**
     * Allows for all blogs to be returned as a JSON so that JavaScript can be used to
     * show recently created blogs by users.
     *
     * @return JsonResponse Returns a JsonResponse containg all blogs.
     */
    public function getRecentBlogs(): JsonResponse
    {
       return response()->json(['blogs' => Blog::all()]);
    }
}
