<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('index');
        //  $cars = Car::get();
        // return view('Cars', compact("cars"));
    }
    public function create()
    {
        $categories = Category::get();

        return view('addcar', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->only("title", "content", "luggage", "active", "doors", "passengers", "price", "image", "category_id");
        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image'] = $fileName;

        $data['active'] = isset($request->active);
        Car::create($data);
        return redirect('Cars');
        //Alert::success("Add ","Add Successfully");
        //return redirect()->back();

    }
    public function show(string $id)
    {
        $cars = Car::findOrFail($id);
        return view('cars', compact('cars'));
    }
    public function edit(string $id)
    {
        $cars = Car::get();
        $car = Car::findOrFail($id);
        return view('updatecar', compact('car', 'cars'));
    }
    public function update(Request $request, string $id)
    {
        $data = $request->only("title", "content", "luggage", "active", "doors", "passengers", "price", "image", "category_id");
        $data["active"] = isset($request->active);
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->image, 'assets/images');
            $data['image'] = $fileName;
            // unlink("assets/images/" . $request->oldImage);
        }
        Car::where('id', $id)->update($data);
        return redirect('cars');
    }
    public function destroy(string $id)
    {
        Car::where('id', $id)->delete();
        return redirect('cars');
    }
}
