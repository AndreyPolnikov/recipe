<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $recipe = new Recipe();
        $recipe->name = $request->input('name');
        $recipe->description = $request->input('description');
        $recipe->save();

        $ingredients = $request->input('ingredients');

        foreach ($ingredients as $index => $ingredientId) {
            $ingredient = Ingredient::find($ingredientId);
            if ($ingredient) {
                $recipe->ingredients()->attach($ingredient, ['ingredient_id' => $ingredientId['ingredient'],'quantity' => $ingredientId['quantity']]);
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function edit(Recipe $recipe)
    {
        $ingredients = Ingredient::all();
        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $recipe->name = $request->input('name');
        $recipe->description = $request->input('description');
        $recipe->save();

        $ingredients = $request->input('ingredients');

        // Sync the ingredients with their quantities
        $recipe->ingredients()->sync($ingredients);

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }


    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }

    public function updatePublicStatus(Request $request, Recipe $recipe)
    {
        $status = $request->input('public', $recipe->public);
        $recipe->update([
            'public' => $status,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe public status updated successfully.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }
}
