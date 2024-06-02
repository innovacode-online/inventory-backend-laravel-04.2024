<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\FullCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $request['slug'] = $this->createSlug($request['name']);

        $new_category = Category::create($request->all());

        return response()->json([
            "message" => "La categoria " . $new_category->name . " se guardo con exito",
            "category" => new CategoryResource($new_category),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
        $category = Category::where('id', $term)
            ->orWhere('slug', $term)
            ->get();

        if (count($category) == 0) {
            return response()->json([
                "message" => "No se encontro la categoria"
            ], 404);
        }

        return new FullCategoryResource($category[0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if ( !$category ) {
            return response()->json([
                "message" => "No se encontro la categoria"
            ], 404);
        }

        if( $request['name'] )
        {
            $request['slug'] = $this->createSlug($request['name']);
        }

        $category->update($request->all());

        return response()->json([
            "message" => "La categoria ". $category->name ." fue actualizada",
            "category" => new CategoryResource($category),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if ( !$category ) {
            return response()->json([
                "message" => "No se encontro la categoria"
            ], 404);
        }

        $category->delete();

        return response()->json([
            "message" => "Se elimino la categoria"
        ]);

    }

    private function createSlug(string $text)
    {
        $text = strtolower($text);

        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');

        $text = preg_replace("/_+/", '-', $text);
        return $text;
    }
}
