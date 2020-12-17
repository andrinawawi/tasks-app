<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editing User:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update-user')}}" method="POST">
                <div class="modal-body">

                    <div>
                        @if(session('update-failed'))
                        @include('template.alerts')
                        @endif
                    </div>

                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="updName">Uusername</label>
                        <input class="form-control" type="text" name="updName" id="updName" value="{{old('updName')}}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="updEmail">Email</label>
                        <input class="form-control" type="email" name="updEmail" id="updEmail" value="{{old('updEmail')}}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="updPwd">Password</label>
                        <input class="form-control" type="password" name="updPwd" id="updPwd" value="{{old('updPwd')}}" placeholder="Leave it blank if you don't want to change it">
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="updAdmin" name="updAdmin" value="true" {{old('updAdmin') ? 'true' : 'false'}}> 
                            <label class="form-check-label" for="updAdmin">Is admin user.</label>
                        </div>
                    </div>

                    <input type="hidden" class="id" name="id" value="{{old('id')}}">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>