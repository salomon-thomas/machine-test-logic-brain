@extends('layouts.app')

@section('content')
    @livewire('blog-show', ['blog' => $blog])
@endsection
