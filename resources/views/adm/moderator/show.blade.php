@extends('layouts.adm')

@section('title','DETAILS PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{route('adm.categories.index')}}" class="btn btn-success center">Go to Back</a>
                <br><br>
                <div class="mb-3">
                    <label for="title" class="form-label">Name Category</label>
                    <input type="text" id="title" name="name" value="{{$category->name}}"  readonly class="form-control @error('name') is-invalid @enderror"
                           placeholder="Name Category">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Code</label>
                    <input type="text" id="title" readonly name="code" value="{{$category->code}}" class="form-control @error('code') is-invalid @enderror"
                           placeholder="Code">
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    @auth
                            <form action="{{route('adm.categories.destroy',$category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                                <a href="{{route('adm.categories.edit',$category->id)}}"
                                   class="btn btn-success me-lg-5">EDIT</a>

                            </form>
                    @endauth
                </div>
@endsection
