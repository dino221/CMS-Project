<?php

namespace App\Http\Controllers\App;

use Mail;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Page;
use Carbon\Carbon;

class Controller extends BaseController
{

    /**
     * Display a index page.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
	{

        return view('app.home');
    }

    /**
     * Display a index page.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
	{
      
        $pages = Page::get();

        /* MENU ROUTES */
        $aboutUs = Page::find(1);

        return view('app.index', compact('aboutUs'));
    }

	public function innerPageItem($slug, $id)
	{
		$page = Page::find($id);

		if (!$page) {
			abort(404);
        }
            
         return view('app.inner', compact('page'));
	}

    /**
     * Display a contact page.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
	{
        return view('app.contact');
    }
}
