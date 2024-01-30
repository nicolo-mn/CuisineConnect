<?php $templateParams = $GLOBALS['templateParams']?>
<div class="row justify-content-center py-4">
    <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="" class="img-fluid rounded-circle col-3 col-md-2">
</div>
<div class="row mb-5">
    <form action="#" class="col-md-10 mx-auto">
        <label for="nome" class="text-white mb-3">Nome</label>
        <input type="text" class="form-control mb-5 bg-dark border-0 rounded-3 text-white" id="nome" placeholder="<?php echo $templateParams["Nome"]?>">
        <label for="bio" class="text-white mb-3">Bio</label>
        <textarea type="text" class="form-control bg-dark border-0 rounded-3 text-white" id="bio" rows="5" placeholder="<?php echo $templateParams["Bio"]?>"></textarea>
        <div class="row justify-content-between mt-7">
            <input type="reset" value="Cancella" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 ms-3">
            <input type="submit" value="Salva modifiche"
                class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 me-3">
        </div>
    </form>
</div>