@extends('layouts.app')

@section('title','DETAILS PAGE')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{route('musics.index')}}" class="btn btn-success center">{{__('buttons.Go to Back')}}</a>
                <br><br>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset($music->image)}}" class="img-fluid"/>
                        </div>

                        <div class="col-md-8">

                            <div class="card-body">
                                <h5 class="card-title">{{$music->name_music}} - {{$music->singer}}</h5>
                                <p class="card-text">{{__('music.CATEGORY')}} - {{$music->category->{ 'name_'. app()->getLocale() } }}</p>
                                <p class="card-text"><small class="text-muted">{{__('music.RELEASE DATE')}}
                                        - {{$music->date}}</small></p>
                            @if($avg != 0)
                                    <div class="flex items-center">
                                    @for($i=0;$i<$avg;$i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @endfor
                                    @for($i = 5;$i>$avg;$i--)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <div class="text-xs text-slate-500 ml-1">{{__('buttons.AVG Rating')}}:{{$avg}}+</div>

                                @endif
                                {{__('buttons.Likes')}}:{{$count}}
                            @auth()
                                @if($like)
                                        <form action="{{route('musics.like',$music->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="like" value="false">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('musics.like',$music->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="like" value="true">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path
                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{route('musics.rate',$music->id)}}" method="post">
                                        @csrf
                                        <select name="rating">
                                        @for($i=0;$i<=5;$i++)
                                                <option
                                                {{ $myRating==$i ? 'selected' : ''}} value="{{$i}}">{{ $i==0 ? __('buttons.Not rated'):$i}}</option>
                                            @endfor
                                        </select>
                                        <button class="btn btn-success">{{__('buttons.ADD')}}</button>
                                    </form>
                                    <form action="{{route('musics.unrate',$music->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-secondary">{{__('buttons.Clear')}}</button>
                                    </form>

                                @endauth
                                <audio controls>
                                    <source src="{{asset($music->mp3)}}" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            @auth
                                @can('delete',$music)
                                        <form class="py-4" action="{{route('musics.destroy',$music->id)}}"
                                        method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">{{__('buttons.Delete')}}</button>
                                            <a href="{{route('musics.edit',$music->id)}}"
                                            class="btn btn-success me-lg-5">{{__('buttons.Edit')}}</a>

                                        </form>
                                    @endcan
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <form action="{{route('musics.subscribe',$music->id)}}" method="POST">
            @csrf
            <div id="radio-cards">
                <p class="h4">Choose an option</p>
                <hr class="my-5" style="background-color: hsl(0, 0%, 65%)" />
                <div class="row gx-lg-5">
                    <div class="col-md-3 mb-4">
                        <label>
                            <input id="radioDefault1" type="radio" name="months" value="1" class="card-input-element" />

                            <div class="card card-input">
                                <div class="card-body">
                                    <p class="text-uppercase fw-bold text-muted">Basic</p>
                                    <p class="mb-0">Free / 1 Months</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>
                            <input id="radioDefault2" type="radio" name="months" value="3" class="card-input-element" checked />

                            <div class="card card-input">
                                <div class="card-body">
                                    <p class="text-uppercase fw-bold text-muted">Essential</p>
                                    <p class="mb-0">3000 KZT / 3 month</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>
                            <input id="radioDefault3" type="radio" name="months" value="6" class="card-input-element" />

                            <div class="card card-input">
                                <div class="card-body">
                                    <p class="text-uppercase fw-bold text-muted">Advanced</p>
                                    <p class="mb-0">5000 KZT / 3 month</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
                        <button class="btn btn-success">{{__('buttons.Subscription')}}</button>
            {{--            <select name="months">--}}
            {{--                <option value="1">1 {{__('buttons.months')}} free</option>--}}
            {{--                <option value="3">3 {{__('buttons.months')}}</option>--}}
            {{--                <option value="6">6 {{__('buttons.months')}}</option>--}}
            {{--            </select>--}}
        </form>
        <hr>
        @can('watch',$music)
            <div class="col-2">
                <h4>{{$music->text}}</h4>

            </div>
        @endcan
            <hr>

            <div class="row">
                <div class="col-12">
                    <div class="py-lg-2">
                        @foreach($music->comments as $com)
                            <ol class="list-group mb-3"> {{$com->user->name}}
                                <li class="list-group-item d-flex justify-content-between align-items-start mb-sm-1">
                                    <div class="me-auto mb-auto">
                                        {{$com->text}}
                                    </div>
                                    {{--                                <a href="{{route('comments.edit',$com->id)}}" class="btn btn-secondary">EDIT</a>--}}
                                    @auth
                                        @can('delete',$com)
                                            <form action="{{route('comments.destroy',$com->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">{{__('buttons.Delete')}}</button>
                                            </form>
                                        @endcan
                                    @endauth

                                </li>
                            </ol>
                        @endforeach
                    </div>
                </div>
            </div>
            @can('create',App\Models\Comment::class)
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{route('comments.store')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="hidden" value="{{$music->id}}" name="music_id">
                                <textarea name="text" class="form-control" placeholder="Leave a comment here"
                                          id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">{{__('buttons.Comments')}}</label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success">{{__('buttons.ADD')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
    @endcan
<style>
    #radio-cards label {
        width: 100%;
    }

    #radio-cards .card-input-element {
        display: none;
    }

    #radio-cards .card-input:hover {
        cursor: pointer;
        background-color: hsl(144, 60%, 95.9%);
        -webkit-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
    }

    #radio-cards .card-input-element:checked + .card-input {
        border: 1px solid hsl(144, 100%, 35.9%);
    }
</style>
@endsection
