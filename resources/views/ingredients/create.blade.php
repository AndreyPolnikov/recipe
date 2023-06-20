@extends('layouts.app')

@section('content')
    <h1>Add Ingredient</h1>

    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Add Ingredient</button>
    </form>
    <ul>
        <li><a href="{{ route('ingredients.index') }}">Manage Ingredients</a></li>
        <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
    </ul>
@endsection
