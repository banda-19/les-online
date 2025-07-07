@extends('admin.layouts.app')

@section('title', 'Tambah Kursus Baru')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.courses._form')
        </form>
    </div>
@endsection