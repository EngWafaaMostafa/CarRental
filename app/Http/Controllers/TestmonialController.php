<?php

namespace App\Http\Controllers;

use App\Models\Testmonial;
use Illuminate\Http\Request;
use App\Traits\Common;

class TestmonialController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    use Common;
    public function index()
    {
        $testmonials = Testmonial::get();
        return view('testmonials', compact("testmonials"));
    }
    public function list()
    {
        $testmonials = Testmonial::latest()->take(3)->get();
        //$testmonials = Testmonial::get();
        return view('showtestimonials', compact("testmonials"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addtestmonial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only("name", "content", "position", "published", "image");
        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image'] = $fileName;

        $data['published'] = isset($request->published);
        Testmonial::create($data);
        return redirect('testmonials');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testmonials = Testmonial::findOrFail($id);
        return view('testmonials', compact('testmonials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testmonials = Testmonial::get();
        $testmonial = Testmonial::findOrFail($id);
        return view('updatetestmonial', compact('testmonial', 'testmonials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only("name", "content", "position", "published", "image");
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->image, 'assets/images');
            $data['image'] = $fileName;
            // unlink("assets/images/" . $request->oldImage);
        }
        $data["published"] = isset($request->published);
        Testmonial::where('id', $id)->update($data);
        return redirect('testmonials');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Testmonial::where('id', $id)->delete();
        return redirect('testmonials');
    }
}
