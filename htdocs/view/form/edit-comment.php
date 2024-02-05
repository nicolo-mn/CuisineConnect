<div class="modal fade" id="editComment" tabindex="-1" aria-labelledby="editComment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCommentForm" action="/submit-post" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="commentField">Commento:</label>
                        <input type="text" class="form-control" id="commentText" name="commentText" required>
                    </div>
                    <input type="hidden" id="commentID" name="commentID">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>