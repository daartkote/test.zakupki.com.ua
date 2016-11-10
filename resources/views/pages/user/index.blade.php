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
                <td>
                    <ul>
                    @foreach($user->image as $image)
                            <li>{!! Html::link($image->getPath(), $image->name, ['rel' => 'popover']) !!}</li>
                    @endforeach
                    </ul>
                </td>
                <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal"
                       data-type="{{App\Image::TYPE_USER}}" data-model-id="{{$user->id}}">Upload Image</a></td>

            </tr>
        @endforeach
    </table>
    @include('pages.include.upload-form')
@endsection