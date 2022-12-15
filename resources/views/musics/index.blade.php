@extends('layouts.app')

@section('title','MAIN PAGE')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12">
                                @can('create',App\Models\Music::class)
                    <a href="{{route('musics.create')}}" class="btn btn-success mb-4">{{__('music.Go to Create new Music')}}</a>
                                    @endcan

                <table class="table">
                    <thead>
                    <th>{{__('music.ID')}}</th>
                    <th>{{__('music.SINGER')}}</th>
                    <th>{{__('music.NAME-SONG')}}</th>
                    <th>{{__('music.CATEGORY')}}</th>
                    <th>{{__('music.RELEASE DATE')}}</th>
                    <th width="7%">{{__('music.DETAILS')}}</th>
                    </thead>
                    <tbody>

                    @foreach ($allMusic as $music)
                    <tr>
                        <td>{{$music->id}}</td>
                        <td>{{$music->singer}}</td>
                        <td>{{$music->name_music}}</td>
                        <td>{{$music->category->{ 'name_'.app()->getLocale() } }}</td>
                        <td>{{$music->date}}</td>
                        <td><a href="{{route('musics.show',$music->id)}}"
                               class="btn btn-success me-lg-5">{{__('music.DETAILS')}}</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

