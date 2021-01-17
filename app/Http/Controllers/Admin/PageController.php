<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Image;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages =Page::all();
        return view('admin-panel.pages.index')->with('pages', Page::paginate(10));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @param \Fer\Admin\Form\Builder $builder
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasAnyRole('admin'))

        {
            return view('admin-panel.pages.create');

        }
        else {
            return redirect()->route('admin.pages.index')->with('warning', 'You are not allowed to create pages');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:250'
        ]);

        $page = new Page;
        
        // Handle the page upload of cover
        
    	if($request->hasFile('cover')){
    		$cover = $request->file('cover');
    		$filename = time() . '.' . $cover->getClientOriginalExtension();
    		Image::make($cover)->save( public_path('/uploads/covers/' . $filename ) );
    		$page->cover = $filename;
    		$page->save();
        }

        $page->title = $request->title;
        $slug = Str::slug($request->title, '-');
        $page->slug = $slug ;
        $page->subtitle = $request->subtitle;
        $page->content = $request->content;
        $page->save();

        return redirect()->to(route('admin.pages.index'))->with('success', 'Page created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))

        {
            $page = Page::find($id);
            return view ('admin-panel.pages.edit',compact('page'));

        }
        else {
            return redirect()->route('admin.pages.index')->with('warning', 'You are not allowed to edit pages');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))

        {
            $this->validate($request, [
                'title' => 'required|max:250'
            ]);
    
            $page = Page::find($id);
            
            // Handle the page upload of cover
            
            if($request->hasFile('cover')){
                $cover = $request->file('cover');
                $filename = time() . '.' . $cover->getClientOriginalExtension();
                Image::make($cover)->save( public_path('/uploads/covers/' . $filename ) );
                $page->cover = $filename;
                $page->save();
            }
    
            $page->title = $request->title;
            $slug = Str::slug($request->title, '-');
            $page->slug = $slug ;
            $page->subtitle = $request->subtitle;
            $page->content = $request->content;
    
            $page->update();
    
            return redirect()->route('admin.pages.index')->with('success', 'Page has been edited');

        }

        else {
            return redirect()->route('admin.pages.index')->with('warning', 'You are not allowed to edit pages');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Auth::user()->hasAnyRole('admin'))

        {
            $page = Page::find($id);

            if($page) {
                $page->delete();
                return redirect()->route('admin.pages.index')->with('success', 'Page has been deleted');
            }

        }
        else {
            return redirect()->route('admin.pages.index')->with('warning', 'This page cannot be deleted');
        }
    }
}
