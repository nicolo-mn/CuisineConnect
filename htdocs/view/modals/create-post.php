<div class="modal fade" id="addPost" tabindex="-1" aria-labelledby="addPostLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="addPostLabel">Add Post</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <form id="postForm" action="/submit-post" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required/>
                            <small id="titleHelp" class="form-text text-muted">Title must be at least 5 characters long.</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                      required></textarea>
                        </div>
                        <label for="recipe" hidden>Select your recipe</label>
                        <select class="form-select my-3" aria-label="Default select example" name="recipe" id="recipe">
                            <option value="null" selected>Open this select menu</option>
                            <?php foreach (RecipeController::getInstance()->loadUserRecipesIDs() as $recipesID): ?>
                                <option value="<?= $recipesID["RecipeID"] ?>">
                                    <?= $recipesID["Nome"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="mention">Mention someone:</label>
                        <input type="text" name="mention" id="mention" class="form-control mb-2">

                        <div class="form-group">
                            <label for="file">Add a file:</label>
                            <input type="file" class="form-control-file" id="file" name="file" required/>
                            <small id="titleHelp" class="form-text text-muted">File must be uploaded</small>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="post" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
