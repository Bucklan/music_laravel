@extends('layouts.adm')

@section('title','CREATE PAGE')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.categories.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Name Category</label>
                        <input type="text" id="title" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Name Category">
                        @error('name')
                        <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationTextarea" class="form-label">Code</label>
                        <input name="code" class="form-control @error('code') is-invalid @enderror" id="validationTextarea" placeholder="Code" >
                        @error('code')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

