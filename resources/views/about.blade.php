@extends('layouts.welcome')

@section('title', 'About Us')
@section('description', 'Learn more about our company and team.')
@section('keywords', 'about, company, team')
@section('author', 'john doe')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('main')
<div class="container">
    <h1 class="my-4">About Us</h1>
    <p>We are a company dedicated to providing the best services to our customers.</p>
</div>
@endsection
