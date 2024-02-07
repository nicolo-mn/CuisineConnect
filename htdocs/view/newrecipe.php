<h2 class="text-secondary text-center mb-5 fw-bold">New Recipe</h2>
<div class="row mb-5 mx-0">
    <form action="#" id="recipe-form" class="col-md-10 mx-auto d-flex flex-column gap-5">
        <input type="text" class="form-control bg-dark border-0 rounded-3 text-white" id="nome" placeholder="Recipe name" />
        <textarea type="text" class="form-control bg-dark border-0 rounded-3 text-white" id="process" rows="5" placeholder="Instructions"></textarea>
        <fieldset id="ingredients" class="d-flex flex-column gap-5">
            <div class="row justify-content-start gap-3 mx-0 ingredient-container">
                <div class="col-7 p-0">
                    <input type="text" class="form-control bg-dark border-0 rounded-3 text-white ingredient" placeholder="Ingredient" />
                </div>
                <div class="col-3">
                    <input type="text" class="form-control bg-dark border-0 rounded-3 text-white quantity" placeholder="Quantity" />
                </div>
                <div class="col-1">
                    <p class="text-secondary">g</p>
                </div>
            </div>
        </fieldset>
        <div class="d-flex justify-content-end">
            <a href="#" class="d-inline me-3" id="add-ingredient">
                <span class="fa-solid fa-plus-circle fa-2x text-secondary"></span >
            </a>
        </div>
        <div class="row justify-content-between mt-7 mx-0">
            <input type="reset" value="Cancel" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 ms-3" />
            <input type="submit" value="Add Recipe" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 me-3" />
        </div>
        <p id="error-check" class="d-none text-danger text-center">Check your ingredients for mistakes!</p>
    </form>
    <div id="loading-overlay" class="d-none position-absolute w-100 h-100 opacity-75 top-0">
        <div class="d-flex flex-column align-items-center justify-content-center h-100">
            <p class="fs-3 text-secondary mb-5">We're creating your recipe...</p>
            <div class="spinner-border text-secondary" role="status"></div>
        </div>
    </div>


</div>

<script src="/web/js/newrecipe.js"></script>
