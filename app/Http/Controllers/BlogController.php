<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Utilities\SanitiserUtility;
use Illuminate\Support\Str;

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
     * Done via a GET request.
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
     * Done via a GET request.
     *
     * @return JsonResponse Returns a JsonResponse containg all blogs.
     */
    public function getRecentBlogs(): JsonResponse
    {
       return response()->json(['blogs' => Blog::all()]);
    }

    /**
     * Displays an empty blog template that an Admin or Blogger can add to so as to
     * create a blog.
     * Done via a GET request.
     *
     * @return View Returns a view showing an empty blog template.
     */
    public function getCreateBlog(): View
    {
        return view('blog_editorial', ['user' => Auth::user()->firstname . ' ' . Auth::user()->lastname, 'date' => Carbon::now()->format('M d, Y')]);
    }

    /**
     * Once information pertaining to the blog has been entered, a blogger / admin
     * can then add the blog to the database.
     * Done via a POST request.
     *
     * @param Request $request Obtain the incoming request.
     *
     * @return RedirectResponse Returns a RedirectResponse based on the inputted data.
     */
    public function postCreateBlog(Request $request): RedirectResponse
    {
        // Validate and sanitise input.
        // Check to see if the inputs are 'generally' valid.
        $validator = Validator::make($request->all(), [
            'blog-image' => 'bail|required|url|starts_with:https://i.imgur.com/|max:255',
            'blog-title' => 'bail|required|min:3|max:255',
            'blog-abstract' => 'bail|required|min:3|max:255',
            'blog-section' => 'required|min:3|max:5000',
        ]);

        // Now check if it fails, if so, send back to the GET page.
        if ($validator->fails()) {
            return redirect()->to('/blog/create')->with('error', 'Failed to validate')->withInput($request->all());
        }

        // Create an instance of SanitiserUtility and perform stripping and trimming.
        $sanitiser = new SanitiserUtility($request->only(['blog-image', 'blog-title', 'blog-abstract', 'blog-section']));
        $sanitiser->strip()
                  ->trim();

        // Get the now sanitised inputs back from the sanitiser.
        $sanitisedInputs = $sanitiser->getSanitisedInputs();

        // Check if blog title already exists.
        if (Blog::where('blog_title', $sanitisedInputs['blog-title'])->first()) {
            return redirect()->to('/blog/create')->with('error', 'Blog already exists')->withInput($request->all());
        }

        // With everything sanitised, now create the slug based off the title.
        $slug = Str::slug($sanitisedInputs['blog-title'], '_');

        // Now add the blog to the database.
        Blog::create([
            'blog_title' => $sanitisedInputs['blog-title'],
            'blog_abstract' => $sanitisedInputs['blog-abstract'],
            'blog_content' => $sanitisedInputs['blog-section'],
            'user_id' => Auth::user()->user_id,
            'blog_image' => $sanitisedInputs['blog-image'],
            'blog_slug' => $slug,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // If successful, go to created blog, else return an error message.
        return Blog::where('blog_title', $sanitisedInputs['blog-title'])->first() ? redirect()->to("/blog/${slug}") : redirect()->to('/blog/create')->with('error', 'Failed to create')->withInput($request->all());
    }

    /**
     * Used to confirm if the user wants to publish their inputted data
     * as a blog.
     * Done via a GET request.
     *
     * @return JsonResponse Returns a JsonResponse confirming if the blog should be created.
     */
    public function getBlogConfirm(): JsonResponse
    {
        // Set 'viewName' and 'message' for modal.
        $viewName = 'confirmation_modal';
        $message = 'Are you sure you want to create this blog?';

        // Returns the modal confirmation view.
        return response()->json(['modal' => view('confirmation_modal', ['message' => $message])->render()]);
    }
}
