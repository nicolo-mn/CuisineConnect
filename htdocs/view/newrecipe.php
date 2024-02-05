<h2 class="d-none d-md-block text-secondary text-center mb-5 fw-bold">Aggiunta ricetta</h2>
<div class="row mb-5 mx-0">
    <form action="#" class="col-md-10 mx-auto d-flex flex-column gap-5">
        <input type="text" class="form-control bg-dark border-0 rounded-3" id="nome" placeholder="Nome ricetta">
        <textarea type="text" class="form-control bg-dark border-0 rounded-3" id="bio" rows="5" placeholder="Procedimento"></textarea>
        <fieldset id="ingredients">
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
        </fieldset>
        <div class="d-flex justify-content-end">
            <a href="#" class="d-inline me-3" id="add-ingredient">
                <i class="fa-solid fa-plus-circle fa-2x text-secondary"></i>
            </a>
        </div>
        <div class="row justify-content-between mt-7 mx-0">
            <input type="reset" value="Cancella" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 ms-3">
            <input type="submit" value="Salva modifiche" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 me-3">
        </div>
    </form>
</div>

<script src="/web/js/newrecipe.js" type="text/javascript"></script>
