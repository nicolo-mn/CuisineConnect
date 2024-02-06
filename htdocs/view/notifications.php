<?php foreach($GLOBALS["templateParams"]["Notifiche"] as $notifica) : ?>
    <!-- TODO metti link a post ed eventualmente correggi parametri
    presi dal database per ogni notifica -->
    <a href="<?php echo '/user/' . $notifica["Username"]?>" class="text-decoration-none">
        <div class="row mx-0">
            <div class="d-flex justify-content-between py-3 align-items-center">
                <div class="d-flex align-items-center justify-content-start gap-3 col-10">
                    <?php if ($notifica["Letta"] == 0) : ?>
                        <div class="bg-info rounded-circle p-1"></div>
                    <?php endif; ?>
                    <div class="col-1">
                        <div class="ratio ratio-1x1">
                            <img src="<?php echo $notifica["ImmagineProfilo"] ?>" alt="" class="img-fluid rounded-circle">
                        </div>
                    </div>
                    <p class="text-white m-0 notifications-text">
                        <?php echo $notifica["Nome"] . " " . InteractionController::getInstance()->getTextFromNotificationType($notifica["Tipo"]) ?>
                        <?php if ($notifica["Testo"] != null) {
                            echo ": \"" . $notifica["Testo"] . "\"";
                        } ?>
                    </p>
                </div>
                <?php if ($notifica["PostID"] != null) : ?>
                    <div class="col-1">
                        <div class="ratio ratio-1x1">
                            <img src="<?php echo $notifica["Foto"] ?>" alt="foto post" class="img-fluid">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </a>
    <!-- <?php var_dump($notifica); ?> -->
<?php endforeach; ?>