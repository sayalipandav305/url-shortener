<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $url = Url::where('original_url', $request->original_url)->first();

        if ($url) {
            return view('welcome', ['short_url' => url($url->short_code)]);
        }

        $shortCode = Str::random(6);

        Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return view('welcome', ['short_url' => url($shortCode)]);
    }

    public function redirect(string $shortcode)
    {
        $url = Url::where('short_code', $shortcode)->firstOrFail();

        return redirect($url->original_url);
    }
}