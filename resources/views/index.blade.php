@extends('layouts.app')

@section('title', 'Bem-vindo à Doc4You')

@section('content')

    @if (session('success'))
        <div class="alert alert-success text-center mx-3">
            {{ session('success') }}
        </div>
    @endif
    <section class="d-flex justify-content-center align-items-center w-95 mt-5">
        <img src="{{ asset('images/banner-home.png') }}" alt="Banner" class="img-fluid w-100">
    </section>
    
    
@endsection