<?php $templateParams = $GLOBALS['templateParams']?>
<div class="row mb-5 mx-0">
    <form action="/update-profile" method="POST" enctype = "multipart/form-data" class="col-md-10 mx-auto">
        <div class="row justify-content-center py-4">
            <div class="col-3">
                <div class="ratio ratio-1x1">
                    <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="profile picture" class="img-fluid rounded-circle" />
                    <label for="profile-image"><span class="fa-solid fa-pencil text-primary bg-secondary position-absolute rounded-circle p-2 edit-profile-pic"></span><span hidden>Change profile image:</span></label>
                    <input type="file" name="profile-image" id="profile-image" class="d-none"/>
                </div>
            </div>
        </div>
        <label for="nome" class="text-white mb-3">Nome</label>
        <input type="text" name="nome" class="form-control mb-5 bg-dark border-0 rounded-3 text-white" id="nome" value="<?php echo $templateParams["Nome"]?>" required />
        <label for="bio" class="text-white mb-3">Bio</label>
        <textarea name="bio" class="form-control bg-dark border-0 rounded-3 text-white" id="bio" rows="5"><?php echo $templateParams["Bio"]?></textarea>
        <div class="row justify-content-between mt-7">
            <a href="/profile" class="bg-secondary rounded-pill border-0 fw-bold m-0 p-0 py-2 col-5 ms-3 text-decoration-none text-center">Cancel</a>
            <input type="submit" value="Save changes"
                class="bg-secondary rounded-pill border-0 fw-bold py-2 col-5 me-3" />
        </div>
    </form>
</div>