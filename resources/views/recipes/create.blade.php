@extends('layouts.app')

@section('content')
    <h1>Add Recipe</h1>

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <h2>Ingredients</h2>
        <button type="button" id="add-ingredient">Add Ingredient</button>
        <div id="ingredients-container"></div>

        <button type="submit">Add Recipe</button>
    </form>
    <ul>
        <li><a href="{{ route('ingredients.index') }}">Manage Ingredients</a></li>
        <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ingredientIndex = 0;

            document.getElementById('add-ingredient').addEventListener('click', function() {
                var container = document.getElementById('ingredients-container');
                var selectIngredient = document.createElement('select');

                var inputQuantity = document.createElement('input');

                // Add options to the select dropdown
                var ingredients = <?php echo json_encode($ingredients); ?>; // Assuming you have an array of ingredients in the view
                for (var i = 0; i < ingredients.length; i++) {
                    var option = document.createElement('option');
                    option.text = ingredients[i].name;
                    option.value = ingredients[i].id;

                    selectIngredient.appendChild(option);
                }
                selectIngredient.setAttribute('name', 'ingredients[' + ingredientIndex + '][ingredient]');
                inputQuantity.setAttribute('type', 'text');
                inputQuantity.setAttribute('name', 'ingredients[' + ingredientIndex + '][quantity]');
                inputQuantity.setAttribute('placeholder', 'Quantity');

                container.appendChild(selectIngredient);
                container.appendChild(inputQuantity);

                ingredientIndex++;
            });
        });
    </script>
@endsection
