document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("add-ingredient").addEventListener("click", function(event) {
        event.preventDefault();
        const newIngredientDiv = document.createElement("div");
        newIngredientDiv.className = "row justify-content-start gap-3 mx-0 ingredient-container";
        newIngredientDiv.innerHTML = `
            <div class="col-7 p-0">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white ingredient" placeholder="Ingrediente">
            </div>
            <div class="col-3">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white quantity" placeholder="Quantità">
            </div>
            <div class="col-1">
                <p class="text-secondary">g</p>
            </div>
        `;

        // Aggiungi il nuovo div al fieldset
        document.getElementById("ingredients").appendChild(newIngredientDiv);
    });
    
    const nutrition_api_id = 'f05f76cc';
    const nutrition_api_key = 'e7ed1f6e1b40fb76a56a496515884e1a';

    document.getElementById("recipe-form").addEventListener("submit", function(event) {
        event.preventDefault();
        let ingredients = [];
        const recipeName = document.getElementById("nome").value;
        const process = document.getElementById("process").value;
        document.querySelectorAll(".ingredient-container").forEach( elem => {
                const ingredient = elem.querySelector(".ingredient").value;
                const quantity = elem.querySelector(".quantity").value;
                ingredients.push(`${quantity}g of ${ingredient}`);
            }
        );
        // console.log("ingredienti: " + ingredients);
        document.getElementById("recipe-form").classList.add("d-none");
        document.getElementById("loading-overlay").classList.remove("d-none");
        $.ajax({
            url: 'https://api.edamam.com/api/nutrition-details',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                "title": recipeName,
                "ingr": ingredients
            }),
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Basic " + btoa(nutrition_api_id + ":" + nutrition_api_key)
            },
            success: function(response) {
                // console.log(response);
                document.getElementById("recipe-form").classList.remove("d-none");
                document.getElementById("loading-overlay").classList.add("d-none");
                const nutrients = {
                    "Carbs": response.totalNutrients.CHOCDF,
                    "Proteins": response.totalNutrients.PROCNT,
                    "Fats": response.totalNutrients.FAT,
                    "Calories": response.totalNutrients.ENERC_KCAL,
                };
                // console.log("Name: " + recipeName);
                // console.log("Process: " + process);
                // console.log("Ingredients: " + ingredients);
                // console.log(nutrients);
                const formData = new FormData();
                formData.append("recipeName", recipeName);
                formData.append("process", process);
                formData.append("ingredients", JSON.stringify(ingredients));
                formData.append("nutrients", JSON.stringify(nutrients));

                $.ajax({
                    type: "POST",
                    url: "/add-recipe", 
                    data: formData,
                    processData: false, 
                    contentType: false,
                    success: function (response) {
                        window.location.href = "/recipes";
                    },
                });
            },
            error: function(error) {
                // console.error('Errore nella richiesta API:', error);
                document.getElementById("recipe-form").classList.remove("d-none");
                document.getElementById("loading-overlay").classList.add("d-none");
                document.getElementById("error-check").classList.remove("d-none");
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
