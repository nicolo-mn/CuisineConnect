<?php $templateParams = $GLOBALS['templateParams']?>
<div class="row justify-content-center py-4">
    <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="" class="img-fluid rounded-circle col-3 col-md-2">
</div>
<div class="row mb-5 mx-0">
    <form action="/update-profile" method="POST" class="col-md-10 mx-auto">
        <label for="nome" class="text-white mb-3">Nome</label>
        <input type="text" name="nome" class="form-control mb-5 bg-dark border-0 rounded-3 text-white" id="nome" value="<?php echo $templateParams["Nome"]?>" required>
        <label for="bio" class="text-white mb-3">Bio</label>
        <textarea type="text" name="bio" class="form-control bg-dark border-0 rounded-3 text-white" id="bio" rows="5"><?php echo $templateParams["Bio"]?></textarea>
        <div class="row justify-content-between mt-7">
            <a href="/profile" class="bg-secondary rounded-pill border-0 fw-bold m-0 p-0 py-2 col-5 ms-3 text-decoration-none text-center">Annulla</a>
            <!-- <input type="reset" value="Cancella" class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 ms-3"> -->
            <input type="submit" value="Salva modifiche"
                class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 me-3">
        </div>
    </form>
</div>