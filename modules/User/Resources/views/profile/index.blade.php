@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', 'Edit Profile')
    <li class="active">Edit Profile</li>
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <!-- Left sidebar navigation -->
                    <div class="col-md-3">
                        <div class="nav flex-column nav-tabs">
                            <a href="#profile-information" class="nav-link {{ !session('tab') && request()->segment(1) == 'profile' ? '' : '' }}" data-toggle="tab">
                                Profile Information
                            </a>
                            <a href="#account" class="nav-link {{ session('tab') == 'account' || !session('tab') ? 'active' : '' }}" data-toggle="tab">
                                Account
                            </a>
                            <a href="#new-password" class="nav-link {{ session('tab') == 'password' ? 'active' : '' }}" data-toggle="tab">
                                New Password
                            </a>
                        </div>
                    </div>

                    <!-- Right content area -->
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- Profile Information Tab -->
                            <div class="tab-pane fade" id="profile-information">
                                <h3>Profile Information</h3>
                                <hr>

                                <div class="account-details">
                                    <div class="user-info">
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Full Name:</div>
                                            <div class="col-md-8">{{ Auth::user()->full_name ?? '' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Email:</div>
                                            <div class="col-md-8">{{ Auth::user()->email ?? '' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Phone:</div>
                                            <div class="col-md-8">{{ Auth::user()->phone ?? 'Not set' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Role:</div>
                                            <div class="col-md-8">
                                                <span class="badge {{ Auth::user()->isAdmin() ? 'badge-primary' : 'badge-info' }}">
                                                    {{ Auth::user()->isAdmin() ? 'Administrator' : 'Member' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Last Login:</div>
                                            <div class="col-md-8">{{ Auth::user()->last_login ? Auth::user()->last_login->diffForHumans() : 'Never' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Tab -->
                            <div class="tab-pane fade {{ session('tab') == 'account' || !session('tab') ? 'show active' : '' }}" id="account">
                                <h3>Account</h3>
                                <hr>

                                <form method="POST" action="{{ route('user.profile.update.account') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="first_name">
                                            First Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', Auth::user()->first_name ?? '') }}">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name">
                                            Last Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', Auth::user()->last_name ?? '') }}">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">
                                            Phone <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', Auth::user()->email ?? '') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- New Password Tab -->
                            <div class="tab-pane fade {{ session('tab') == 'password' ? 'show active' : '' }}" id="new-password">
                                <h3>New Password</h3>
                                <hr>

                                <form method="POST" action="{{ route('user.profile.update.password') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="password">
                                            New Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">
                                            Confirm New Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs {
        background: #f5f5f5;
        border-radius: 4px;
        padding: 20px;
    }

    .nav-tabs .nav-link {
        display: block;
        padding: 10px 15px;
        margin-bottom: 5px;
        color: #495057;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }

    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .nav-tabs .nav-link:not(.active):hover {
        background-color: #e9ecef;
    }

    .tab-content {
        padding: 20px;
        background: #fff;
        border-radius: 4px;
    }

    .tab-pane h3 {
        color: #333;
        margin-bottom: 10px;
    }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        // Bootstrap 4 tab activation
        $('.nav-tabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Show tab based on hash in URL
        var hash = window.location.hash;
        if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }

        // Update hash in URL when tab changes
        $('.nav-tabs a').on('shown.bs.tab', function(e) {
            if (history.pushState) {
                history.pushState(null, null, $(this).attr('href'));
            } else {
                window.location.hash = $(this).attr('href');
            }
        });

        @if (session()->has('message'))
            @if (session('status') === \Modules\Admin\Enums\StatusResponse::SUCCESS)
                success("{{ session('message') }}")
            @elseif (session('status') === \Modules\Admin\Enums\StatusResponse::FAILURE)
                error("{{ session('message') }}")
            @endif
        @endif
    });
</script>
@endpush
