<?php

namespace App\Http\Controllers;

use Photo;
use App\Models\CountryBlog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = CountryBlog::paginate(15);
        return view('pages.countryBlog.index', [
            'countries' => $country
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.countryBlog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'thumbnail'     => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
            'banner'        => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        try {
            DB::beginTransaction();

            $country = new CountryBlog();
            $country->name          = $request->name;
            $country->slugs         = Str::slug($request->name);
            $country->title         = $request->title;
            $country->description   = $request->description;

            //seo
            $country->seo_title         = $request->seo_title;
            $country->seo_description   = $request->seo_description;
            $country->seo_tags          = $request->seo_tags;
            if ($request->thumbnail) {
                Photo::upload($request->thumbnail, 'uploads/country', 'THUM', ['640', '780']);
                $country->thumbnail   = Photo::$name;
            }

            if ($request->banner) {
                Photo::upload($request->banner, 'uploads/country', 'BAN', ['2050', '605']);
                $country->banner   = Photo::$name;
            }
            $country->save();

            DB::commit();

            return back()->with('succ', 'Country added successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('err', 'Check again! something wrong with form.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CountryBlog $countryBlog)
    {
        return view('pages.countryBlog.view', [
            'country' => $countryBlog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CountryBlog $countryBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CountryBlog $countryBlog)
    {
        $request->validate([
            'name'          => 'required',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        try {
            DB::beginTransaction();
            $country = $countryBlog;
            $country->name          = $request->name;
            $country->slugs         = Str::slug($request->name);
            $country->title         = $request->title;
            $country->description   = $request->description;

            //seo
            $country->seo_title         = $request->seo_title;
            $country->seo_description   = $request->seo_description;
            $country->seo_tags          = $request->seo_tags;

            if ($request->thumbnail) {
                Photo::delete('uploads/country', $country->thumbnail);
                Photo::upload($request->thumbnail, 'uploads/country', 'THUM', ['640', '780']);
                $country->thumbnail   = Photo::$name;
            }

            if ($request->banner) {
                Photo::delete('uploads/country', $country->banner);
                Photo::upload($request->banner, 'uploads/country', 'BAN', ['2050', '605']);
                $country->banner   = Photo::$name;
            }
            $country->save();

            DB::commit();

            return back()->with('succ', 'Country update successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('err', 'Check again! something wrong with form.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CountryBlog $countryBlog)
    {
        //
    }
}
