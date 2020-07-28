<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->content = $request->content;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords = $request->keywords;
            if ($request->hasFile('meta_image')) {
                $page->meta_image = $request->meta_image->store('uploads/custom-pages');;
            }
            $page->save();

            flash('New page has been created successfully')->success();
            return redirect()->route('pages.index');
        }

        flash('Slug has been used already')->warning();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::where('slug', $id)->first();
        if($page != null){
            return view('pages.edit', compact('page'));
        }
        abort(404);
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
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() != null) {
            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->content = $request->content;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords = $request->keywords;
            if ($request->hasFile('meta_image')) {
                $page->meta_image = $request->meta_image->store('uploads/custom-pages');;
            }
            $page->save();

            flash('New page has been created successfully')->success();
            return redirect()->route('pages.index');
        }

        flash('Slug has been used already')->warning();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Page::destroy($id)){
            flash('Page has been deleted successfully')->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.custom_page', compact('page'));
        }
        abort(404);
    }
}
