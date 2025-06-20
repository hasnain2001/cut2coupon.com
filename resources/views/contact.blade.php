@extends('layouts.welcome')

@section('title', 'Contact Us')
@section('description', 'Get in touch with us for any inquiries or support.')
@section('keywords', 'contact, support, inquiries')
@section('author', 'john doe')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<style>
    .contact-card {
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .contact-card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn-submit {
        background: linear-gradient(to right, #4e73df, #224abe);
        border: none;
        transition: all 0.4s;
    }
    .btn-submit:hover {
        background: linear-gradient(to right, #224abe, #4e73df);
        transform: translateY(-2px);
    }
</style>
@endpush

@section('main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card contact-card border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h1 class="h3 mb-0 text-center">Contact Us</h1>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center mb-4">Fill out the form below and we'll get back to you as soon as possible</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control py-2" id="name" name="name" required placeholder="Your name">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control py-2" id="email" name="email" required placeholder="your.email@example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control py-2" id="subject" name="subject" placeholder="What's this about?">
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control py-2" id="message" name="message" rows="5" required placeholder="Your message here..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-submit btn-lg text-white py-2">
                                <i class="fas fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Our Location</h5>
                            <p class="card-text text-muted">123 Main Street, City, Country</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-phone-alt text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Call Us</h5>
                            <p class="card-text text-muted">+1 (123) 456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Email Us</h5>
                            <p class="card-text text-muted">info@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
