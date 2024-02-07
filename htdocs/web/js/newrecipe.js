document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("add-ingredient").addEventListener("click", function(event) {
        event.preventDefault();
        const newIngredientDiv = document.createElement("div");
        newIngredientDiv.className = "row justify-content-start gap-3 mx-0 ingredient-container";
        newIngredientDiv.innerHTML = `
            <div class="col-7 p-0">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white ingredient" placeholder="Ingredient"/>
            </div>
            <div class="col-3">
                <input type="text" class="form-control bg-dark border-0 rounded-3 text-white quantity" placeholder="Quantity"/>
            </div>
            <div class="col-1">
                <p class="text-secondary">g</p>
            </div>
        `;

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
                document.getElementById("recipe-form").classList.remove("d-none");
                document.getElementById("loading-overlay").classList.add("d-none");
                const nutrients = {
                    "Carbs": [response.totalNutrients.CHOCDF.quantity, response.totalNutrients.CHOCDF.unit],
                    "Proteins": [response.totalNutrients.PROCNT.quantity, response.totalNutrients.PROCNT.unit],
                    "Fats": [response.totalNutrients.FAT.quantity, response.totalNutrients.FAT.unit],
                    "Calories": [response.totalNutrients.ENERC_KCAL.quantity, response.totalNutrients.ENERC_KCAL.unit],
                };
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
                document.getElementById("recipe-form").classList.remove("d-none");
                document.getElementById("loading-overlay").classList.add("d-none");
                document.getElementById("error-check").classList.remove("d-none");
            }
        });
    });  
});
