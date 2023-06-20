@extends('layouts.app')

@section('content')
    <h1>Edit Recipe</h1>

    <form action="{{ route('recipes.update', $recipe) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $recipe->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ $recipe->description }}</textarea>
        </div>

        <h3>Ingredients:</h3>
        <div id="ingredients-container">
            @foreach ($recipe->ingredients as $index => $ingredient)
                <div class="ingredient-container">
                    <div class="form-group">
                        <label for="ingredient{{ $index }}">Ingredient:</label>
                        <select name="ingredients[{{ $index }}][ingredient_id]" id="ingredient{{ $index }}" class="form-control">
                            @foreach ($ingredients as $optionIngredient)
                                <option value="{{ $optionIngredient->id }}" {{ $optionIngredient->id == $ingredient->id ? 'selected' : '' }}>
                                    {{ $optionIngredient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity{{ $index }}">Quantity:</label>
                        <input type="text" name="ingredients[{{ $index }}][quantity]" id="quantity{{ $index }}" value="{{ $ingredient->pivot->quantity }}" class="form-control">
                    </div>

                    <button type="button" class="btn btn-danger delete-ingredient">Delete Ingredient</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-ingredient" class="btn btn-primary">Add Ingredient</button>

        <button type="submit" class="btn btn-success">Update Recipe</button>
    </form>
    <ul>
        <li><a href="{{ route('ingredients.index') }}">Manage Ingredients</a></li>
        <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ingredientIndex = {{ $recipe->ingredients->count() }};

            document.getElementById('add-ingredient').addEventListener('click', function() {
                var container = document.getElementById('ingredients-container');
                var ingredientContainer = document.createElement('div');
                ingredientContainer.classList.add('ingredient-container');

                var selectIngredient = document.createElement('select');
                selectIngredient.setAttribute('name', 'ingredients[' + ingredientIndex + '][ingredient_id]');
                selectIngredient.setAttribute('class', 'form-control');

                @foreach ($ingredients as $optionIngredient)
                var option = document.createElement('option');
                option.value = '{{ $optionIngredient->id }}';
                option.text = '{{ $optionIngredient->name }}';
                selectIngredient.appendChild(option);
                @endforeach

                var inputQuantity = document.createElement('input');
                inputQuantity.setAttribute('type', 'text');
                inputQuantity.setAttribute('name', 'ingredients[' + ingredientIndex + '][quantity]');
                inputQuantity.setAttribute('class', 'form-control');

                var deleteButton = document.createElement('button');
                deleteButton.setAttribute('type', 'button');
                deleteButton.setAttribute('class', 'btn btn-danger delete-ingredient');
                deleteButton.innerText = 'Delete Ingredient';

                ingredientContainer.appendChild(selectIngredient);
                ingredientContainer.appendChild(inputQuantity);
                ingredientContainer.appendChild(deleteButton);

                container.appendChild(ingredientContainer);

                ingredientIndex++;
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-ingredient')) {
                    var ingredientContainer = event.target.parentNode;
                    ingredientContainer.parentNode.removeChild(ingredientContainer);
                }
            });
        });
    </script>
@endsection
