<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menus = $request->all();
        // $menus['name'] = $request->name;
        // $menus['description'] = $request->description;
        // $menus['image'] = $this->uploadMenuImage($request);
        // $menus['price'] = $request->price;
        // Menu::create($menus);
        $menus=Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $this->uploadMenuImage($request),
            'price' => $request->price
        ]);
        if($request->has('categories'))
        {
            $menus->categories()->attach($request->categories);
        }
        return to_route('admin.menus.index')->with('success', 'Menu Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:5',
            'image' => 'required|image',
            'price' => 'required',
        ]);
        $image = $menu->image;
        if ($request->hasFile('image')) {
            Storage::delete($menu->image);
            $image = $this->uploadMenuImage($request);
        }
        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price
        ]);
        if($request->has('categories'))
        {
            $menu->categories()->sync($request->categories);
        }
        return to_route('admin.menus.index')->with('success', 'Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->image);
        $menu->delete();
        $menu->categories()->detach();
        return to_route('admin.menus.index')->with('danger', 'Menu Deleted Successfully');
    }
    public function uploadMenuImage($request){
        $files = $request->file('image');
        $name = time() . '.' . $files->getClientOriginalExtension();
        $files->move(public_path('uploads/menus'), $name);
        $name = 'uploads/menus/' . $name;
        return $name;
    }
}
