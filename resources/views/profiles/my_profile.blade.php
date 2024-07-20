@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profil tafsilotlari</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">To'liq ism</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ $user->name }}"
                                    />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Telefon raqami</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">+99 8</span>
                                        <input
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            class="form-control"
                                            placeholder="912345678"
                                            value="{{ $user->phone }}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">O'zgarishlarni saqlang</button>
                                <button type="reset" class="btn btn-outline-secondary">Bekor qilish</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
