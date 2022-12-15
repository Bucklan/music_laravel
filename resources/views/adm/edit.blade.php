@extends('layouts.adm')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.users.update',$user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{$user->name}}" readonly>
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{$user->email}}" readonly>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="balance" class="form-label">Balance: KZT</label>
                        <input type="number" id="balance" name="my_balance"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{$user->my_balance}}" readonly>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror"
                                aria-label="Default select example">
                            @foreach($roles as $role)

                                <option value="{{$role->id}}" @if($role->id==$user->role_id) selected @endif>
                                    {{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


