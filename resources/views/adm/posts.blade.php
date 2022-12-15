@extends('layouts.adm')

@section('title','USERS PAGE')

@section('content')
    <div class="container">
        <form action="{{route('adm.categories.search')}}" method="GET">
            <div class="col-3">
                <input type="text" name="search" class="search__input form-control border-transparent"
                       placeholder="Search...">
            </div>
            <div class="col-3">
                <input type="number" name="price_search" class="search__input form-control border-transparent"
                       placeholder="Search...">
            </div>

            <button class="btn btn-dark">SEARCH</button>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Content</th>
                        <th scope="col">Price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0;$i<count($gifts);$i++)
                        <tr>
                            <th scope="row">{{$i+1}}</th>
                            <td>{{$gifts[$i]->name}}</td>
                            <td>{{$gifts[$i]->content}}</td>
                            <td>{{$gifts[$i]->price}}</td>
                            <td>{{$gifts[$i]->category->name}}</td>
                            <td>
                                <a href="" class="btn btn-success">DETAILS</a>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

