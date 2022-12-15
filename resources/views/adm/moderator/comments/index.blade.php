@extends('layouts.adm')

@section('title','users page')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('users.Name')}}</th>
            <th scope="col">{{__('users.Email')}}</th>
            <th scope="col">{{__('users.comments')}}</th>
            <th>{{__('buttons.Delete')}}</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($comments); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$comments[$i]->user->name}}</td>
                <td>{{$comments[$i]->user->email}}</td>
                <td>{{$comments[$i]->text}}</td>

                <td>
                    <form action="{{route('comments.destroy',$comments[$i]->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">{{__('buttons.Delete')}}</button>
                    </form>
                </td>
            </tr>
        @endfor

        </tbody>
    </table>


@endsection
