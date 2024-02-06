<div class="row justify-content-end mb-5 mx-0">
    <div class="col-md-6 mb-5 mb-md-0 p-0">
        <h2 class="text-secondary text-center fw-bold ">Le mie ricette</h2>
    </div>
    <div class="col-md-3">
        <a href="/newrecipe" class="btn btn-secondary w-100 shadow-none">Add a new recipe!</a>
    </div>
</div>
<div class="row row-cols-3 pt-2 col-md-8 mx-0 mx-md-auto gap-1">
    <?php foreach ($GLOBALS["templateParams"]["Ricette"] as $ricetta): ?>
        <a href="#" class="p-0">
            <div class="col g-0 bg-brick">
                <div class="ratio ratio-1x1">
                    <div class="h-100 d-flex justify-content-center align-items-center">
                        <h3 class="text-secondary text-center align-self-center fw-bold"><?php echo $ricetta["Nome"] ?></h3>   
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>