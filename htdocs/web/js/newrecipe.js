document.addEventListener("DOMContentLoaded", function() {
    let ingredientCounter = 1;

    const ingredient_listener =  elem => {
        elem.addEventListener("change", function(event) {
            const elem_id = event.target.id;
            const query = event.target.value;
            $.ajax({
                url: `https://api.edamam.com/auto-complete`,
                type: 'GET',
                data: {
                    'q': query,
                    'app_id': food_api_id,
                    'app_key': food_api_key,
                },
                success: function(response) {
                    // Gestisci la risposta ottenuta dall'API qui
                    console.log(response);
                    // const hints = response.hints;
                    let result = "";
                    response.forEach(element => {
                        result +=
                        `
                            <option value="${element}">
                        `;
                    });
                    document.getElementById(elem_id + "-list").innerHTML = result;
                },
                error: function(error) {
                    console.error('Errore nella richiesta API:', error);
                }
            });
        });
    };

    document.getElementById("add-ingredient").addEventListener("click", function(event) {
        event.preventDefault();
        ingredientCounter++;
        const ingredient =
        `
        <div class="row justify-content-start gap-3 mb-3 mx-0">
            <div class="col-7">
                <input type="text" list="ingredient-${ingredientCounter}-list" id="ingredient-${ingredientCounter}" class="form-control bg-dark border-0 rounded-3 text-white ingredient" placeholder="Ingrediente">
                <datalist id="ingredient-${ingredientCounter}-list">
                </datalist>
            </div>
            <div class="col-3">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white" placeholder="Quantità">
            </div>
            <div class="col-1">
                <p class="text-secondary">g</p>
            </div>
        </div>
        `;
        document.getElementById("ingredients").innerHTML += ingredient;
        ingredient_listener(document.getElementById("ingredient-" + ingredientCounter));
    });
    
    

    const food_api_id = '3629cdf5';
    const food_api_key = '84f704a2a8b233566ce7dd659b78f123';
    const nutrition_api_id = 'f05f76cc';
    const nutrition_api_key = 'e7ed1f6e1b40fb76a56a496515884e1a';
    
    document.querySelectorAll(".ingredient").forEach(ingredient_listener);    
    
    // $.ajax({
    //     url: 'https://api.edamam.com/api/nutrition-details',
    //     type: 'POST',
    //     contentType: 'application/json',
    //     data: JSON.stringify({
    //         "title": "Nome della tua ricetta",
    //         "ingr": [
    //             "100g of apple",
    //             "100g of orange",
    //             "100g of banana",
    //             // Aggiungi gli ingredienti della tua ricetta
    //         ]
    //     }),
    //     headers: {
    //         "Content-Type": "application/json",
    //         "Authorization": "Basic " + btoa(nutrition_api_id + ":" + nutrition_api_key)
    //     },
    //     success: function(response) {
    //         console.log(response);
    //         // Gestisci la risposta ottenuta dall'API qui
    //     },
    //     error: function(error) {
    //         console.error('Errore nella richiesta API:', error);
    //     }
    // });
    
    
    
});
