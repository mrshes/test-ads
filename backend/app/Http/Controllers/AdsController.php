<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {
//        dd($request->all());
        return Ads::paginate(1);
    }

    /**
     * @param Request $request
     * @return Ads
     */
    public function store(Request $request): Ads
    {
        $data = $request->validate([
           'title' => 'required|string',
           'image' => 'required|image',
        ]);

        $imageFile = $request->file('image')->store('images','public');
        return Ads::create([
            'title' => $data['title'],
            'image' => $imageFile
        ]);
    }

}
