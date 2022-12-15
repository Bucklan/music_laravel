<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    public function index(Category $allcategory)
    {

        return view('adm.moderator.categories', ['categories' => $allcategory::with('musics')->get()]);
    }


    public function create()
    {
        $this->authorize('create', Category::class);
        return view('adm.moderator.create');
    }

    public function store(Request $request)
    {


        $validate = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
        ]);
        Category::create([$validate]);
        return redirect()->route('adm.moderator.categories')->with('message', 'musics saved');
    }

    public function show(Category $category)
    {
        return view('adm.moderator.show', ['category' => $category]);
    }

    public function edit(Category $category)
    {
        return view('adm.moderator.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
        ]);

        $category->update($validate);
        return redirect()->route('adm.categories.index')->with('message', 'musics successfully changed');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('adm.categories.index')->with('message', 'musics successfully deleted');
    }

}
