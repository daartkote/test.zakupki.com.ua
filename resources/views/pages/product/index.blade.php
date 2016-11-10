@extends('layouts.main')

@section('title', 'Products')
@section('content')
    <table class="table">
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Images</th>
            <td></td>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->model}}</td>
                <td><ul style="padding-left: 0px;">
                    @foreach($product->images as $image)
                        <li><a href="/public/images/{{$image->image_path}}">{{$image->image_name}}</a></li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    <button id="upload_image" data-target="#upload" data-toggle="modal" data-id="{{$product->id}}" class="btn btn-danger">Upload Image</button>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@include('plugins.upload_modal')
