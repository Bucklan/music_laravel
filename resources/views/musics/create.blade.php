@extends('layouts.app')

@section('title','CREATE PAGE')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('musics.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{__('music.NAME-SONG')}}</label>
                        <input type="text" id="title" name="name_music"
                               class="form-control @error('name_music') is-invalid @enderror"
                               placeholder="{{__('music.NAME-SONG')}}">
                        @error('name_music')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                aria-label="Default select example">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale() } }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationTextarea" class="form-label">{{__('music.SINGER')}}</label>
                        <input name="singer" class="form-control @error('singer') is-invalid @enderror"
                               id="validationTextarea" placeholder="{{__('music.SINGER')}}">
                        @error('singer')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationTextarea" class="form-label">{{__('music.RELEASE DATE')}}</label>
                        <input type="date" id="validationTextarea" name="date"
                               value="2022-10-22"
                               min="1950-01-01" max="2022-10-22"
                               class="form-control @error('singer') is-invalid @enderror">
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationTextarea" class="form-label">{{__('music.Text Music')}}</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" placeholder="{{__('music.Text Music')}}"></textarea>
                        @error('text')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">{{__('music.Image Music')}}</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" type="file"
                               accept="image/png, image/gif, image/jpeg" name="image">

                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mp3" class="form-label">{{__('music.Mp3 Music')}}</label>
                        <input class="form-control @error('mp3') is-invalid @enderror" id="mp3" type="file"
                               accept="audio/mp3" name="mp3">
                        @error('mp3')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success">{{__('buttons.SAVE')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

