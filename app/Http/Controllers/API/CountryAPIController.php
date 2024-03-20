<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CountryBlog;
use Illuminate\Http\JsonResponse;

class CountryAPIController extends Controller
{
    public function country(): JsonResponse
    {
        try {
            $country = CountryBlog::where('status', 1)->get()->map(function ($item) {
                return collect($item)->except('seo_title', 'seo_description', 'seo_tags', 'status', 'created_at', 'updated_at');
            });

            return response()->json([
                'status'    => 1,
                'country'   => $country,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Conflict error with fetching',
            ], 409);
        }
    }

    public function countrySlugs($slugs): JsonResponse
    {
        //check if country exists or not
        $country = CountryBlog::with('contents', 'faqs')->where('slugs', $slugs)->first();
        if (!$country) {
            return response()->json([
                'status' => 0,
                'message' => 'No data found'
            ], 400);
        }

        return response()->json([
            'status'    => 1,
            'country'   => $country, //with content
        ]);
    }
}
