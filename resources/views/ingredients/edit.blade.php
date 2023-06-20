@extends('layouts.app')

@section('content')
    <h1>Edit Ingredient</h1>

    <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $ingredient->name }}" required>
        <button type="submit">Update Ingredient</button>
    </form>
    <ul>
        <li><a href="{{ route('ingredients.index') }}">Manage Ingredients</a></li>
        <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
    </ul>
@endsection
