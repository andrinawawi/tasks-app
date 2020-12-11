<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editing task:</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div>
                    @include('template.alerts')
                </div>

                <form action="{{route('update-task')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="updName">Task name</label>
                        <input class="form-control" type="text" name="updName" id="updName" value="{{old('updName')}}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="updUser">User</label>
                        <select class="form-select" aria-label="User" name="updUser" id="updUser" required>
                            @foreach($users as $user)
                            @if(old('upduser') == $user->id)
                            <option selected value="{{$user->id}}"> {{$user->name}} </option>
                            @else
                            <option value="{{$user->id}}"> {{$user->name}} </option>
                            @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="updDueDate">Due Date</label>
                        <input class="form-control" type="datetime-local" name="updDueDate" id="updDueDate" value="{{old('updDueDate')}}" required>
                    </div>

                    <input type="hidden" class="id" name="id" value="{{old('id')}}">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>