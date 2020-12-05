<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editing task:</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group mb-3">
                        <label for="taskName">Task name</label>
                        <input class="form-control" type="text" name="taskName" id="taskName" value="">
                    </div>

                    <div class="form-group mb-3">
                        <label for="user">User</label>
                        <select class="form-select" aria-label="User" name="user" id="user">
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="dueDate">Due Date</label>
                        <input class="form-control" type="datetime-local" name="dueDate" id="dueDate" value="">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>