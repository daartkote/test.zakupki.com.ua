@extends('layouts.main')

@section('content')
    <table class="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Images</th>
            <th></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><ul style="padding-left: 0px;">
                        @foreach($user->images as $image)
                        <li><a href="/public/images/{{$image->image_path}}">{{$image->image_name}}</a></li>
                        @endforeach
                    </ul>
                </td>
                <td> <button id="upload_image" data-target="#upload" data-toggle="modal" data-id="{{$user->id}}" class="btn btn-success">Upload Image</button></td>

            </tr>
        @endforeach
    </table>
@endsection

@include('plugins.upload_modal')