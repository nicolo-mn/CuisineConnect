
<h2 class="d-none d-md-block text-secondary text-center fw-bold mb-5">Le mie ricette</h2>
<div class="row row-cols-3 pt-2 col-md-8 mx-md-auto gap-1">
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