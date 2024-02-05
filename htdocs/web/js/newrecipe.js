document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("add-ingredient").addEventListener("click", function(event) {
        event.preventDefault();
        const ingredient =
        `
        <div class="row justify-content-start gap-3 mx-0 ingredient-container">
            <div class="col-7 p-0">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white ingredient" placeholder="Ingrediente">
            </div>
            <div class="col-3">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white quantity" placeholder="Quantità">
            </div>
            <div class="col-1">
                <p class="text-secondary">g</p>
            </div>
        </div>
        `;
        document.getElementById("ingredients").innerHTML += ingredient;
    });
    
    const food_api_id = '3629cdf5';
    const food_api_key = '84f704a2a8b233566ce7dd659b78f123';
    const nutrition_api_id = 'f05f76cc';
    const nutrition_api_key = 'e7ed1f6e1b40fb76a56a496515884e1a';
    


    document.getElementById("recipe-form").addEventListener("submit", function(event) {
        event.preventDefault();
        let ingredients = [];
        const nomeRicetta = document.getElementById("nome").value;
        document.querySelectorAll(".ingredient-container").forEach( elem => {
                const ingredient = elem.querySelector(".ingredient").value;
                const quantity = elem.querySelector(".quantity").value;
                ingredients.push(`${quantity}g of ${ingredient}`);
            }
        );
        console.log("ingredienti: " + ingredients);
        $.ajax({
            url: 'https://api.edamam.com/api/nutrition-details',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                "title": nomeRicetta,
                "ingr": ingredients
            }),
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Basic " + btoa(nutrition_api_id + ":" + nutrition_api_key)
            },
            success: function(response) {
                console.log(response);
                // Gestisci la risposta ottenuta dall'API qui
            },
            error: function(error) {
                console.error('Errore nella richiesta API:', error);
            }
        });
    });
    

    // $.ajax({
    //     url: `https://api.edamam.com/api/food-database/v2/parser`,
    //     type: 'GET',
    //     data: {
    //         'ingr': "apple",
    //         'app_id': food_api_id,
    //         'app_key': food_api_key,
    //     },
    //     success: function(response) {
    //         // Gestisci la risposta ottenuta dall'API qui
    //         console.log(response);
    //         // const hints = response.hints;
    //         // let result = "";
    //         // hints.array.forEach(element => {
    //         //     result +=
    //         //     `
    //         //         <option value="${element.food.label}">
    //         //     `;
    //         // });
    //         // document.getElementById("ingredient-1-list").innerHTML = result;
    //     },
    //     error: function(error) {
    //         console.error('Errore nella richiesta API:', error);
    //     }
    // });
    
    
    
    
    
});
