$(".show-recipe").on("click", function () {
    let RecipeID = $(this).siblings("input").first();
    let formData = new FormData();
    formData.append("RecipeID", RecipeID.val());
    $.ajax({
        type: "POST",
        url: "/get-recipe",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            let recipe = JSON.parse(response);
            let $modal = $("#popupRecipe");
            console.log(recipe);
            $modal.find(".recipe-name").text(recipe["Nome"]);
            let nutritionalValues = JSON.parse(recipe["ValoriNutrizionali"]);
            console.log(nutritionalValues)
            let nutritionalValuesText = "";
            for (const key in nutritionalValues) {
                const [quantity, unit] = nutritionalValues[key];
                nutritionalValuesText +=
                    `
                    <div class="text-center text-white">
                        <p class="mb-0">${Math.floor(quantity)} ${unit}</p>
                        <p>${key}</p>
                    </div>
                    `;
            }
            $modal.find(".recipe-nutritional-values").html(nutritionalValuesText);
            let ingredientsText = "";
            const ingredientsList = JSON.parse(recipe["Ingredienti"]);
            ingredientsList.forEach(ingredient => {
                ingredientsText += `<li>${ingredient}</li>`;
            })
            $modal.find(".recipe-ingredients").html(ingredientsText);
            $modal.find(".recipe-instructions").text(recipe["Procedimento"]);
        },
        error: function (error) {
            console.error("Errore nella richiesta AJAX: ", error);
        }
    });
})