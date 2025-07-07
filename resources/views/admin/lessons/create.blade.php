@extends('admin.layouts.app')
@section('title', 'Tambah Materi Baru')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.lessons.store') }}" method="POST">
            @include('admin.lessons._form')
        </form>
    </div>
@endsection