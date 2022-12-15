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
                    <th width="7%">{{__('music.delete')}}</th>
                    </thead>
                    <tbody>

                    @foreach ($selecteds as $selected)
                    <tr>
                        <td>{{$selected->id}}</td>
                        <td>{{$selected->singer}}</td>
                        <td>{{$selected->name_music}}</td>
                        <td>{{$selected->category->{ 'name_'.app()->getLocale() } }}</td>
                        <td>{{$selected->date}}</td>
                        <td><a href="{{route('musics.show',$selected->id)}}"
                               class="btn btn-danger me-lg-5">{{__('buttons.Delete')}}</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

