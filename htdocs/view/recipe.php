<?php if (isset($recipe)): ?>
    <section class="recipe bg-brick text-secondary d-flex flex-column
     justify-content-center g-0 post h-100 overflow-hidden p-3">
        <h3 class="font-bold"><?= $recipe["Nome"] ?></h3>
        <div class="d-flex justify-content-between align-items-center">
            <?php
            foreach (json_decode($recipe["ValoriNutrizionali"]) as $macro => $valore): ?>
                <div class="text-center text-white">
                    <p class="mb-0"><?= number_format($valore->quantity, $decimals = 0) . $valore->unit; ?></p>
                    <p><?= $macro ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <section class="ingredients">
            <h4 class="fw-light fs-5">Ingredients:</h4>
            <ul class="text-white">
                <?php foreach (json_decode($recipe["Ingredienti"]) as $ingredient): ?>
                    <li><?= $ingredient ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="instructions">
            <h4 class="fw-light fs-5">Instructions:</h4>
            <p class="text-white">
                <?= $recipe["Procedimento"] ?>
            </p>
        </section>
    </section>
<?php endif; ?>
