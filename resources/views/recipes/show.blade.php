@extends('layouts.app')

@section('content')

    @if ($recipe->public)
        <h4>Full Information:</h4>
        <!-- Display the full information of the recipe here -->
        <p>Name: {{ $recipe->name }}</p>
        <p>Description: {{ $recipe->description }}</p>
        <h5>Ingredients:</h5>
        <ul>
            @foreach ($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }}</li>
            @endforeach
        </ul>

    @endif

    <form id="public-form" action="{{ route('recipes.updatePublicStatus', $recipe) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="public" value="{{ $recipe->public ? 0 : 1 }}">
        <button type="submit" class="btn btn-primary">
            {{ $recipe->public ? 'Make Private' : 'Make Public' }}
        </button>
    </form>

@endsection
