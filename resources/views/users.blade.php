@extends('template.layout')
@section('title') {{config('app.name')}} : Users @endsection
@section('content')

@if(!session('update-failed'))
@include('template.alerts')
@endif

@if(Auth()->user()->isAdminUser)
@include('user-edit')
<form action="{{route('store-user')}}" method="POST" class="my-4">
    @csrf
    <div class="row">

        <div class="col my-2 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin" value="true">
                <label class="form-check-label" for="isAdmin">Is admin user.</label>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <input type="text" value="{{old('username')}}" class="form-control" placeholder="Username" aria-label="Username" name="username" id="username">
        </div>

        <div class="col-lg-3 my-2">
            <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
        </div>

        <div class="col-lg-4 my-2">
            <div class="input-group">
                <input class="form-control" value="{{old('username')}}" type="password" name="password" id="password" placeholder="Password">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary ms-4" type="submit">Add user</button>
                </div>
            </div>
        </div>

    </div>

</form>


<hr>
@endif
<ul class="list-group my-4">

    @foreach($users as $user)

    <li class="list-group-item ">
        <div class="row d-flex align-items-center">

            <div class="col-lg-6">
                <strong> {{($user->name)}} </strong> : <a href="mailto:{{$user->email}}">{{$user->email}}</a> <i> {{$user->isAdminUser ? "(Admin user.)"  : ''}} </i>
            </div>

            @if(Auth()->user()->isAdminUser)
            <div class="col-lg-6">
                <form class="float-end" action="{{route('destroy-user')}}" method="POST" onsubmit="return confirm('This action will also delete the tasks associated to this user. \nAre you sure?')">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="id">
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
                <div class="float-end">
                    <button type="button" class="btn btn-primary btn-sm me-2" id="editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{$user->id}}" data-name="{{$user->name}}" data-admin="{{$user->isAdminUser}}" data-email="{{$user->email}}">Edit</button>
                </div>
            </div>
            @endif


        </div>
    </li>
    @endforeach
</ul>

<script>
    //Functions used to load edit modal on page-load, close it and add edit values
    function openModal() {
        document.body.classList.add('modal-open')

        let editModal = document.getElementById('editModal')
        editModal.classList.add('show')

        let backdrop = document.createElement('DIV')
        backdrop.classList.add("modal-backdrop", 'fade', 'show')
        backdrop.setAttribute('id', 'backdrop')

        document.body.appendChild(backdrop)
        document.getElementById('editModal').style.display = 'block'
    }

    function addValuesToModal() {

        let editModal = document.getElementById('editModal')

        editModal.addEventListener('show.bs.modal', function(event) {

            let button = event.relatedTarget

            let id = editModal.querySelector('.modal-body .id')
            id.value = button.getAttribute('data-id')

            let admin = editModal.querySelector('.modal-body #updAdmin')
            let dataAdmin = button.getAttribute('data-admin');

            if (dataAdmin == false || dataAdmin == 0) {
                admin.checked = false
            } else {
                admin.checked = true
            }

            let name = editModal.querySelector('.modal-body #updName')
            name.value = button.getAttribute('data-name')

            let email = editModal.querySelector('.modal-body #updEmail')
            email.value = button.getAttribute('data-email')
        })
    }
</script>

@if(!session('update-failed'))
<script>
    addValuesToModal();
</script>
@else

<script>
    openModal()

    // Reloads page when clicking outside modal
    let editModal = document.getElementsByClassName('modal-content')[0];

    document.addEventListener('click', function(event) {
        let editModalClick = editModal.contains(event.target);

        if (!editModalClick) {
            document.location.reload(false);
        }
    });

    document.getElementsByClassName('btn-close')[0].addEventListener('click', function() {
        document.location.reload(false);
    }, true)

    document.getElementById('close').addEventListener('click', function() {
        document.location.reload(false);
    }, true)
</script>

@endif



@endsection