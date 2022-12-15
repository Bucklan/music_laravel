@extends('layouts.adm')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <a href="{{route('adm.categories.show',$category->id)}}" class="btn btn-success">Go to Back</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.categories.update',$category->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Name Category</label>
                        <input type="text" id="title" name="name" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Name Category">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Code</label>
                        <input type="text" id="title" name="code" value="{{$category->code}}" class="form-control @error('code') is-invalid @enderror"
                        placeholder="Code">
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success">EDIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


