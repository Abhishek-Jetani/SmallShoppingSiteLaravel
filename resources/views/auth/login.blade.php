@extends('layouts.app')

@section('content')

<div class="py-5 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="app-card">
                    <h3 class="mb-3">Opening Login</h3>
                    <p class="text-muted">You will be prompted to sign in via the modal.</p>
                    <div class="mt-4">
                        <button id="openAuthModalBtn" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#authModal" style="display:none">Open</button>
                        <p class="small text-muted">If nothing happens, click the button below:</p>
                        <button class="btn btn-outline-secondary" onclick="document.getElementById('openAuthModalBtn').click();">Open Login / Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        // auto-open auth modal (uses Bootstrap 5)
        try {
            var el = document.getElementById('authModal');
            if (el) {
                var modal = new bootstrap.Modal(el);
                modal.show();
            }
        } catch (e) {
            // fallback: click hidden button
            var btn = document.getElementById('openAuthModalBtn');
            if (btn) btn.click();
        }
    });
</div>

@endsection
