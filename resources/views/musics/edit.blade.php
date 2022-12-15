@extends('layouts.app')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <a href="{{route('musics.show',$music->id)}}" class="btn btn-success">{{__('buttons.Go to Back')}}</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('musics.update',$music->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="py-3">
                        <label for="name_music" class="form-label">{{__('music.NAME-SONG')}}</label>
                        <input type="text" id="name_music" name="name_music" value="{{$music->name_music}}" class="form-control @error('name_music') is-invalid @enderror"
                               placeholder="{{__('music.NAME-SONG')}}">
                        @error('name_music')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="singer" class="form-label">{{__('music.SINGER')}}</label>
                        <input type="text" id="singer" name="singer" value="{{$music->singer}}" class="form-control @error('singer') is-invalid @enderror"
                        placeholder="{{__('music.SINGER')}}">
                        @error('singer')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">{{__('music.CATEGORY')}}</label>
                        <select name="category_id" id="category" class="form-select" aria-label="Default select example">
                            @foreach($categories as $cat)
                                <option @if($cat->id==$music->category_id) selected
                                        @endif() value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">{{__('music.RELEASE DATE')}}</label>
                        <input type="date" id="date" name="date"
                               value="{{$music->date}}"
                               min="1950-01-01" max="2022-10-22"  class="form-control @error('singer') is-invalid @enderror">
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">{{__('music.Image Music')}}</label>
                        <input value="{{$music->image}}" class="form-control @error('image') is-invalid @enderror" id="image" type="file" accept="image/png, image/gif, image/jpeg" name="image">

                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success">{{__('buttons.Edit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


