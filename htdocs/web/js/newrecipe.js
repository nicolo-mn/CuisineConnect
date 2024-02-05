document.getElementById("add-ingredient").addEventListener("click", function(event) {
    event.preventDefault();
    const ingredient =
    `
    <div class="row justify-content-start gap-3 mb-3 mx-0">
        <div class="col-7">
            <input type="text" class="form-control bg-dark border-0 rounded-3" placeholder="Ingrediente">
        </div>
        <div class="col-3">
            <input type="text" class="form-control bg-dark border-0 rounded-3" placeholder="Quantità">
        </div>
        <div class="col-1">
            <p class="text-secondary">g</p>
        </div>
    </div>
    `;
    document.getElementById("ingredients").innerHTML += ingredient;
});