<?php

namespace App\Http\Controllers;

use App\Models\CountryBlogItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class CountryBlogItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        try {
            DB::beginTransaction();

            $content = new CountryBlogItems();
            $content->country_blog_id = $request->id;
            $content->title = $request->title;
            $content->content = $request->content;
            $content->status = 1;
            $content->save();

            DB::commit();
            return back()->with('succ', 'Content added successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('err', 'Form error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CountryBlogItems $countryBlogItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {

         $countryBlog = CountryBlogItems::find($id);
        return view('pages.countryBlog.edit-content',[
            'countryBlog'=> $countryBlog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $countryBlogItems = CountryBlogItems::find($id);
        $countryBlogItems->title = $request->title;
        $countryBlogItems->content = $request->content;
        $countryBlogItems->save();
        return redirect(route('country-blog.show',$countryBlogItems->country_blog_id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       CountryBlogItems::find($id)->delete();
        return back();
    }
}
