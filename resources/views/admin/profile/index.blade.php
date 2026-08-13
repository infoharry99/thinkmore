@extends('admin.layouts.app')

@section('title', 'Admin Account & Security Settings')

@section('content')
<div style="margin-bottom: 24px;">
    <h3 style="font-size: 22px; font-weight: 800; color: #111827; margin: 0;">Admin Profile & Security Settings</h3>
    <p style="font-size: 13px; color: #6B7280; margin-top: 4px;">Update your administrator account name, email address, and change your login password.</p>
</div>

<!-- Admin Summary Card -->
<div class="card-box" style="padding: 24px; margin-bottom: 28px; background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); color: white; border: none;">
    <div style="display: flex; align-items: center; gap: 20px;">
        @php $initials = strtoupper(substr($admin->name, 0, 2)); @endphp
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #1E6146; color: white; font-weight: 800; font-size: 24px; display: flex; align-items: center; justify-content: center; border: 3px solid #4ADE80; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
            {{ $initials }}
        </div>
        <div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <h3 style="font-size: 20px; font-weight: 800; margin: 0; color: white;">{{ $admin->name }}</h3>
                <span class="badge" style="background: #4ADE80; color: #0F172A; font-weight: 800; font-size: 11px;">Super Admin</span>
            </div>
            <p style="font-size: 13px; color: #94A3B8; margin-top: 4px; margin-bottom: 0;">
                <i class="bi bi-envelope"></i> {{ $admin->email }} &nbsp;•&nbsp; 
                <i class="bi bi-shield-check"></i> System Administrator &nbsp;•&nbsp; 
                <i class="bi bi-calendar3"></i> Joined {{ $admin->created_at ? $admin->created_at->format('M d, Y') : '—' }}
            </p>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 28px;">
    
    <!-- Left Column: Update Name & Email -->
    <div class="card-box" style="padding: 28px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 14px;">
            <i class="bi bi-person-bounding-box" style="font-size: 20px; color: #1E6146;"></i>
            <h4 style="font-size: 16px; font-weight: 800; color: #111827; margin: 0;">1. Personal Account Details</h4>
        </div>

        @if($errors->has('name') || $errors->has('email'))
            <div class="alert alert-danger" style="border-radius: 10px; font-size: 13px;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->get('name') as $err) <li>{{ $err }}</li> @endforeach
                    @foreach($errors->get('email') as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" style="font-weight: 700; font-size: 13px; color: #374151;">Full Name *</label>
                <div style="position: relative;">
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" style="padding-left: 38px; border-radius: 10px; font-size: 14px;" required>
                    <i class="bi bi-person" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label" style="font-weight: 700; font-size: 13px; color: #374151;">Email Address *</label>
                <div style="position: relative;">
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" style="padding-left: 38px; border-radius: 10px; font-size: 14px;" required>
                    <i class="bi bi-envelope" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; justify-content: center; border-radius: 10px;">
                <i class="bi bi-check-circle-fill"></i> Save Account Details
            </button>
        </form>
    </div>

    <!-- Right Column: Change Password -->
    <div class="card-box" style="padding: 28px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 14px;">
            <i class="bi bi-shield-lock-fill" style="font-size: 20px; color: #EF4444;"></i>
            <h4 style="font-size: 16px; font-weight: 800; color: #111827; margin: 0;">2. Security & Change Password</h4>
        </div>

        @if($errors->has('current_password') || $errors->has('new_password'))
            <div class="alert alert-danger" style="border-radius: 10px; font-size: 13px;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->get('current_password') as $err) <li>{{ $err }}</li> @endforeach
                    @foreach($errors->get('new_password') as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" style="font-weight: 700; font-size: 13px; color: #374151;">Current Password *</label>
                <div style="position: relative;">
                    <input type="password" id="current_password" name="current_password" class="form-control" style="padding-left: 38px; border-radius: 10px; font-size: 14px;" required placeholder="••••••••">
                    <i class="bi bi-key" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: 700; font-size: 13px; color: #374151;">New Password * (Min 8 Characters)</label>
                <div style="position: relative;">
                    <input type="password" id="new_password" name="new_password" class="form-control" style="padding-left: 38px; border-radius: 10px; font-size: 14px;" required placeholder="••••••••">
                    <i class="bi bi-lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label" style="font-weight: 700; font-size: 13px; color: #374151;">Confirm New Password *</label>
                <div style="position: relative;">
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" style="padding-left: 38px; border-radius: 10px; font-size: 14px;" required placeholder="••••••••">
                    <i class="bi bi-lock-fill" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; justify-content: center; border-radius: 10px; background: #DC2626 !important;">
                <i class="bi bi-shield-check"></i> Update Password
            </button>
        </form>
    </div>

</div>
@endsection
