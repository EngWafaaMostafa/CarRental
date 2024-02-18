<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Traits\Common;

class CarController extends Controller
{
    use Common;
    public function index()
    {
        $cars = Car::get();
        return view('cars', compact("cars"));
    }
    public function list()
    {
        $cars = Car::get();
        return view('listing', compact("cars"));
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
        return redirect('cars');
        //Alert::success("Add ","Add Successfully");
        //return redirect()->back();

    }
    public function show(string $id)
    {
        $categories = Category::get();
        $cars = Car::findOrFail($id);
        return view('single', compact('cars', 'categories'));
    }
    public function edit(string $id)
    {
        $categories = Category::get();
        $car = Car::findOrFail($id);
        return view('updatecar', compact('car', 'categories'));
    }
    public function update(Request $request, string $id)
    {
        $data = $request->only("title", "content", "luggage", "active", "doors", "passengers", "price", "image", "category_id");
        //dd($data);
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->image, 'assets/images');
            $data['image'] = $fileName;
            // unlink("assets/images/" . $request->oldImage);
        }
        $data["active"] = isset($request->active);
        Car::where('id', $id)->update($data);
        return redirect('cars');
    }

    public function destroy(string $id)
    {
        Car::where('id', $id)->delete();
        return redirect('cars');
    }
}
