@extends('layouts.adm')

@section('title','CATEGORY PAGE')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('categories.category')}}</th>
                        <th scope="col">{{__('categories.code')}}</th>
                        <th scope="col">{{__('buttons.details')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0;$i<count($categories);$i++)
                        <tr>
                            <th scope="row">{{$i+1}}</th>
                            <td>{{$categories[$i]->{'name_'.app()->getLocale() } }}</td>
                            <td>{{$categories[$i]->code}}</td>
                            <td>
                                <a href="{{route('adm.categories.show',$categories[$i]->id)}}" class="btn btn-success">{{__('buttons.details')}}</a>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

