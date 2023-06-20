@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ingredients</h1>

        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Add Ingredient</a>

        @if ($ingredients->count() > 0)
            <ul class="list-group mt-3">
                @foreach ($ingredients as $ingredient)
                    <li class="list-group-item">{{ $ingredient->name }}</li>
                @endforeach
            </ul>
        @else
            <p>No ingredients found.</p>
        @endif
        <ul>
            <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
        </ul>
    </div>
@endsection
