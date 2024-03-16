<?php

namespace App\Http\Controllers;

use App\Models\CountryBlogItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit(CountryBlogItems $countryBlogItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CountryBlogItems $countryBlogItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CountryBlogItems $countryBlogItems)
    {
        //
    }
}
