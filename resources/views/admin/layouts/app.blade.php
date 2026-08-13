<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ThinkClear Portal</title>
    
    <!-- Google Fonts & Bootstrap 5 CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --brand-primary: #1E6146;
            --brand-primary-light: #2A835E;
            --brand-accent: #10B981;
            --brand-dark: #0F172A;
            --sidebar-bg: #0B132B;
            --body-bg: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --card-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
        }

        * { box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif; 
            background-color: var(--body-bg); 
            color: var(--text-main); 
            display: flex; 
            min-height: 100vh; 
            margin: 0; 
            padding: 0; 
            -webkit-font-smoothing: antialiased;
        }

        /* Sidebar Navigation */
        .sidebar { 
            width: 270px; 
            background: var(--sidebar-bg); 
            color: #ffffff; 
            flex-shrink: 0; 
            display: flex; 
            flex-direction: column; 
            border-right: 1px solid rgba(255,255,255,0.06);
            z-index: 1100;
        }
        .sidebar-brand { 
            padding: 24px 22px; 
            font-size: 20px; 
            font-weight: 800; 
            border-bottom: 1px solid rgba(255,255,255,0.06); 
            display: flex; 
            align-items: center; 
            gap: 12px;
            background: rgba(255,255,255,0.02);
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #10B981 0%, #1E6146 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .sidebar-brand span { color: #34D399; font-weight: 800; }
        
        .nav-menu { padding: 24px 14px; display: flex; flex-direction: column; gap: 6px; flex: 1; overflow-y: auto; }
        .nav-section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #475569;
            padding: 12px 14px 4px 14px;
        }

        .nav-item { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 12px 16px; 
            color: #94A3B8; 
            text-decoration: none; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 14px; 
            transition: all 0.25s ease;
            position: relative;
        }
        .nav-item i { font-size: 17px; transition: transform 0.2s; }
        .nav-item:hover { 
            background: rgba(255, 255, 255, 0.06); 
            color: #F8FAFC; 
            transform: translateX(3px);
        }
        .nav-item.active { 
            background: linear-gradient(135deg, #1E6146 0%, #154532 100%); 
            color: #ffffff; 
            box-shadow: 0 4px 15px rgba(30, 97, 70, 0.35);
        }
        .nav-item.active i { color: #34D399; }

        /* Sidebar Bottom Profile Card */
        .sidebar-user-card {
            margin: 14px;
            padding: 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #10B981;
            color: #0F172A;
            font-weight: 800;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Container */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow-x: hidden; min-width: 0; }
        .topbar { 
            height: 70px; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 36px; 
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .user-info { display: flex; align-items: center; gap: 16px; font-size: 14px; font-weight: 600; }
        .btn-logout { 
            background: #FEF2F2; 
            border: 1px solid #FCA5A5; 
            color: #EF4444; 
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 700; 
            cursor: pointer; 
            display: inline-flex; 
            align-items: center; 
            gap: 6px; 
            font-size: 13px;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: #FEE2E2; color: #DC2626; }

        .content-area { padding: 36px; flex: 1; }
        
        /* Dashboard Cards & Layout */
        .card-box { 
            background: #ffffff; 
            border-radius: 20px; 
            border: 1px solid var(--border-color); 
            box-shadow: var(--card-shadow);
            overflow: hidden; 
            transition: box-shadow 0.3s ease;
        }
        .card-header-flex { 
            padding: 22px 28px; 
            border-bottom: 1px solid var(--border-color); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
        }

        /* Buttons & Forms */
        .btn-primary { 
            background: linear-gradient(135deg, #1E6146 0%, #154532 100%) !important; 
            color: #ffffff !important; 
            padding: 11px 20px; 
            border-radius: 12px; 
            text-decoration: none; 
            border: none; 
            font-weight: 700; 
            cursor: pointer; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            font-size: 14px; 
            box-shadow: 0 4px 14px rgba(30, 97, 70, 0.25);
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(30, 97, 70, 0.35);
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #CBD5E1;
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(30, 97, 70, 0.12);
        }

        .badge { padding: 6px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; }
        .badge-green { background: #ECFDF5; color: #047857; }
        .badge-gray { background: #F1F5F9; color: #475569; }
        
        .alert-success { 
            background: #ECFDF5; 
            border: 1px solid #A7F3D0;
            color: #065F46; 
            padding: 16px 22px; 
            border-radius: 14px; 
            margin-bottom: 28px; 
            font-weight: 600; 
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }

        /* Table Design Upgrade */
        .table th {
            background: #F8FAFC !important;
            color: #475569 !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            text-transform: uppercase !spacing: 0.5px;
            padding: 14px 18px !important;
            border-bottom: 1px solid #E2E8F0 !important;
        }
        .table td {
            padding: 16px 18px !important;
            border-bottom: 1px solid #F1F5F9 !important;
        }
        .table-hover tbody tr:hover {
            background-color: #F8FAFC !important;
        }

        /* Bootstrap 5 Pagination Custom Styles */
        .pagination { margin-bottom: 0 !important; }
        .page-item .page-link {
            color: #475569;
            border-radius: 10px !important;
            margin: 0 3px;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 15px;
            border: 1px solid #E2E8F0;
            transition: all 0.2s;
        }
        .page-item.active .page-link {
            background-color: var(--brand-primary) !important;
            border-color: var(--brand-primary) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(30, 97, 70, 0.25);
        }
        .page-item.disabled .page-link {
            color: #CBD5E1;
            background-color: #F8FAFC;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-crosshair"></i>
            </div>
            <div>ThinkClear <span>Portal</span></div>
        </div>

        <nav class="nav-menu">
            <div class="nav-section-title">Main Navigation</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="nav-section-title" style="margin-top: 10px;">Curriculum & Content</div>
            <a href="{{ route('admin.foundation.index') }}" class="nav-item {{ request()->routeIs('admin.foundation*') ? 'active' : '' }}">
                <i class="bi bi-calendar2-check-fill"></i> Foundation Days (Phase 1)
            </a>
            <a href="{{ route('admin.feedbacks.index') }}" class="nav-item {{ request()->routeIs('admin.feedbacks*') ? 'active' : '' }}">
                <i class="bi bi-chat-square-quote-fill"></i> Student Feedbacks
            </a>

            <div class="nav-section-title" style="margin-top: 10px;">User & Admin Management</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Student Progress Tracker
            </a>
            <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Admin Account Settings
            </a>
        </nav>

        <!-- Sidebar Footer User Card -->
        <div class="sidebar-user-card">
            @php $initials = strtoupper(substr(Auth::user()->name, 0, 2)); @endphp
            <div class="user-avatar-circle">
                {{ $initials }}
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-size: 13px; font-weight: 700; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ Auth::user()->name }}
                </div>
                <div style="font-size: 11px; color: #34D399; font-weight: 600;">Super Admin</div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <header class="topbar">
            <div style="display: flex; align-items: center; gap: 10px;">
                <h2 style="font-size: 20px; font-weight: 800; margin: 0; color: #0F172A;">@yield('title', 'Dashboard')</h2>
                <span class="badge badge-green" style="font-size: 10px; padding: 4px 8px; letter-spacing: 0.5px;">LIVE API</span>
            </div>

            <div class="user-info">
                <a href="{{ route('admin.profile') }}" style="color: #0F172A; text-decoration: none; display: flex; align-items: center; gap: 10px; background: #F1F5F9; padding: 6px 14px; border-radius: 99px; border: 1px solid #E2E8F0; transition: all 0.2s;" title="Edit Admin Profile">
                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #1E6146; color: white; font-weight: 800; font-size: 11px; display: flex; align-items: center; justify-content: center;">
                        {{ $initials }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down" style="font-size: 11px; color: #64748B;"></i>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="content-area">
            @if(session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill" style="font-size: 20px;"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
