@extends('layouts.adm')

@section('title','users page')

@section('content')

   <form action ="{{route('adm.users.search')}}" method="GET">
       <div class="input-group mb-3">
           <div class="input-group-prepend">
           </div>
           <input type="text" name="search" class="form-control" placeholder="{{__('buttons.Search')}}" aria-label="Username" aria-describedby="basic-addon1">
           <button class="btn btn-success" type= "submit">{{__('buttons.Search')}}</button>
       </div>
   </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('users.Name')}}</th>
            <th scope="col">{{__('users.Email')}}</th>
            <th scope="col">{{__('users.Role')}}</th>
            <th>{{__('users.Status')}}</th>
            <th>{{__('buttons.details')}}</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($users); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>
                    <form action="
                    @if($users[$i]->is_active)
                         {{route('adm.users.ban',  $users[$i]->id)}}
                    @else
                         {{route('adm.users.unban', $users[$i]->id)}}
                    @endif
                    " method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn {{$users[$i]->is_active ? 'btn-outline-danger' : 'btn-outline-success'}}" type="submit">
                            @if($users[$i]->is_active)
                                {{__('buttons.ban')}}
                            @else
                                {{__('buttons.unban')}}
                            @endif

                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{route('adm.users.edit',$users[$i]->id)}}" class="btn btn-success">{{__('buttons.details')}}</a>

                </td>
            </tr>
        @endfor

        </tbody>
    </table>


@endsection
