@extends('layouts.main')

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
                <td>
                    <ul>
                        @foreach($product->image as $image)
                            <li>{!! Html::link($image->getPath(), $image->name, ['rel' => 'popover']) !!}</li>
                        @endforeach
                    </ul>
                </td>
                <td><a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal"
                       data-type="{{App\Image::TYPE_PRODUCT}}" data-model-id="{{$product->id}}">Upload Image</a></td>
            </tr>
        @endforeach
    </table>
    @include('pages.include.upload-form')
@endsection