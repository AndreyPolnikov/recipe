@extends('layouts.app')

@section('content')

    <h1>Recipes</h1>

    <a href="{{ route('recipes.create') }}" class="btn btn-primary">Add Recipe</a>

    @if ($recipes->count() > 0)
        <ul class="list-group">
            @foreach ($recipes as $recipe)
                <li class="list-group-item">
                    <h3 class="mb-3">{{ $recipe->name }}</h3>
                    <p>{{ $recipe->description }}</p>

                    <h4>Ingredients:</h4>
                    <ul class="list-group">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">View</a>
                    @if ($recipe->public)
                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-primary">Edit</a>
                    @endif
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No recipes found.</p>
    @endif
    <ul>
        <li><a href="{{ route('ingredients.index') }}">Manage Ingredients</a></li>
    </ul>
@endsection
