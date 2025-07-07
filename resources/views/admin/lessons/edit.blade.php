@extends('admin.layouts.app')
@section('title', 'Edit Materi')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST">
            @method('PUT')
            @include('admin.lessons._form')
        </form>
    </div>
@endsection