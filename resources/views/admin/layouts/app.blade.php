<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ThinkClear</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --brand-green: #1E6146;
            --brand-dark: #0B131F;
            --sidebar-bg: #0F172A;
            --body-bg: #F4F6F9;
            --card-bg: #FFFFFF;
            --text-dark: #111827;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--body-bg); color: var(--text-dark); display: flex; min-height: 100vh; }

        /* Sidebar Navigation */
        .sidebar { width: 260px; background: var(--sidebar-bg); color: #ffffff; flex-shrink: 0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 24px 20px; font-size: 20px; font-weight: 800; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand span { color: #4ADE80; }
        .nav-menu { padding: 20px 12px; display: flex; flex-direction: column; gap: 4px; flex: 1; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #9CA3AF; text-decoration: none; border-radius: 10px; font-weight: 500; font-size: 14px; transition: all 0.2s; }
        .nav-item:hover, .nav-item.active { background: var(--brand-green); color: #ffffff; }

        /* Main Container */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        .topbar { height: 64px; background: #ffffff; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 32px; }
        .user-info { display: flex; align-items: center; gap: 16px; font-size: 14px; font-weight: 600; }
        .btn-logout { background: none; border: none; color: #EF4444; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; }

        .content-area { padding: 32px; flex: 1; }
        
        /* Dashboard Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: var(--card-bg); padding: 24px; border-radius: 16px; border: 1px solid var(--border-color); }
        .stat-label { font-size: 13px; color: var(--text-muted); font-weight: 500; margin-bottom: 8px; }
        .stat-value { font-size: 28px; font-weight: 800; color: var(--text-dark); }

        /* Tables & Forms */
        .card-box { background: #ffffff; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; }
        .card-header-flex { padding: 20px 24px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background: #FAFAFA; padding: 14px 20px; font-weight: 600; color: var(--text-muted); border-bottom: 1px solid var(--border-color); }
        td { padding: 16px 20px; border-bottom: 1px solid var(--border-color); }

        .btn-primary { background: var(--brand-green); color: #ffffff; padding: 10px 18px; border-radius: 10px; text-decoration: none; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; }
        .badge { padding: 4px 10px; border-radius: 99px; font-size: 12px; font-weight: 600; }
        .badge-green { background: #E8F3EE; color: var(--brand-green); }
        .badge-gray { background: #F3F4F6; color: #4B5563; }
        
        .alert-success { background: #DEF7EC; color: #03543F; padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; font-weight: 500; }

        /* Laravel Pagination Styling Fix */
        nav[role="navigation"] svg { display: none !important; width: 0 !important; height: 0 !important; }
        nav[role="navigation"] { display: flex; flex-direction: column; gap: 12px; width: 100%; }
        nav[role="navigation"] > div:first-child { display: none !important; }
        nav[role="navigation"] > div:last-child { display: flex; justify-content: space-between; align-items: center; width: 100%; }
        nav[role="navigation"] span.relative, nav[role="navigation"] a.relative {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 8px 14px !important;
            border-radius: 8px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            color: #374151 !important;
            border: 1px solid #D1D5DB !important;
            background: #ffffff !important;
            margin: 0 2px !important;
        }
        nav[role="navigation"] span[aria-current="page"] span {
            background: var(--brand-green) !important;
            color: #ffffff !important;
            border-color: var(--brand-green) !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-crosshair"></i> ThinkClear <span>Admin</span>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.cases.index') }}" class="nav-item {{ request()->routeIs('admin.cases*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Case Library
            </a>
            <a href="{{ route('admin.feedbacks.index') }}" class="nav-item {{ request()->routeIs('admin.feedbacks*') ? 'active' : '' }}">
                <i class="bi bi-chat-square-quote"></i> Foundation Feedbacks
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> User Progress
            </a>
        </nav>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <header class="topbar">
            <h2>@yield('title', 'Dashboard')</h2>
            <div class="user-info">
                <span><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </div>
        </header>

        <main class="content-area">
            @if(session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
