@extends('admin.layouts.app')

@section('title', 'Edit Kursus')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.courses._form')
        </form>
    </div>
@endsection