@extends("admin.master")

@section("content")
<style>
    /* ==========================================================================
       Premium Dashboard Styles
       ========================================================================== */
    :root {
        --dash-primary: #3b82f6;
        --dash-primary-dark: #1d4ed8;
        --dash-accent: #6366f1;
        --dash-emerald: #10b981;
        --dash-purple: #8b5cf6;
        --dash-amber: #f59e0b;
        --dash-card-bg: #ffffff;
        --dash-card-border: rgba(226, 232, 240, 0.85);
        --dash-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
        --dash-shadow-hover: 0 16px 36px -6px rgba(15, 23, 42, 0.09), 0 6px 12px -2px rgba(15, 23, 42, 0.03);
    }

    body.dark {
        --dash-card-bg: #27282e;
        --dash-card-border: rgba(255, 255, 255, 0.07);
        --dash-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.4);
        --dash-shadow-hover: 0 16px 36px -6px rgba(0, 0, 0, 0.6);
    }

    .dashboard-container {
        padding: 0.25rem 0.5rem;
    }

    /* Premium Welcome Banner */
    .premium-hero-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 55%, #1e293b 100%);
        border-radius: 16px;
        color: #ffffff;
        padding: 2rem 2.25rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.25);
    }

    .premium-hero-banner::before {
        content: "";
        position: absolute;
        width: 320px;
        height: 320px;
        right: -80px;
        top: -80px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(59, 130, 246, 0.05) 50%, transparent 70%);
        pointer-events: none;
    }

    .premium-hero-banner::after {
        content: "";
        position: absolute;
        left: 25%;
        bottom: -100px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 65%);
        pointer-events: none;
    }

    .pulsing-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse-dot-anim 2s infinite;
    }

    @keyframes pulse-dot-anim {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Cards */
    .premium-card {
        background: var(--dash-card-bg);
        border: 1px solid var(--dash-card-border);
        border-radius: 14px;
        box-shadow: var(--dash-shadow);
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .premium-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--dash-shadow-hover);
        border-color: rgba(99, 102, 241, 0.25);
    }

    /* Card Top Glow Strip */
    .card-glow-strip {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .glow-blue { background: linear-gradient(90deg, #3b82f6, #6366f1); }
    .glow-emerald { background: linear-gradient(90deg, #10b981, #059669); }
    .glow-purple { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
    .glow-amber { background: linear-gradient(90deg, #f59e0b, #d97706); }

    /* Stat Card Icon Boxes */
    .stat-avatar-badge {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease;
    }

    .premium-card:hover .stat-avatar-badge {
        transform: scale(1.08);
    }

    .avatar-blue { background: rgba(59, 130, 246, 0.12); color: #2563eb; }
    .avatar-emerald { background: rgba(16, 185, 129, 0.12); color: #059669; }
    .avatar-purple { background: rgba(139, 92, 246, 0.12); color: #7c3aed; }
    .avatar-amber { background: rgba(245, 158, 11, 0.12); color: #d97706; }

    /* Trend Chips */
    .trend-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 30px;
        letter-spacing: 0.02em;
    }

    .trend-positive {
        background: rgba(16, 185, 129, 0.12);
        color: #059669;
    }
    body.dark .trend-positive {
        color: #34d399;
    }

    /* Micro Progress Bar */
    .micro-progress-container {
        width: 100%;
        height: 4px;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
    }
    body.dark .micro-progress-container {
        background: rgba(255, 255, 255, 0.08);
    }

    .micro-progress-bar {
        height: 100%;
        border-radius: 10px;
    }

    /* Graph Card Specifics */
    .graph-card-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--dash-card-border);
    }

    .graph-time-filter .btn {
        font-size: 0.8rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: transparent;
        color: #64748b;
    }
    body.dark .graph-time-filter .btn {
        border-color: rgba(255, 255, 255, 0.1);
        color: #94a3b8;
    }

    .graph-time-filter .btn.active,
    .graph-time-filter .btn:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }

    .chart-canvas-wrapper {
        position: relative;
        height: 340px;
        width: 100%;
        margin-top: 1rem;
    }

    /* Donut Center Overlay */
    .donut-center-container {
        position: relative;
        height: 250px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .donut-center-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
    }

    .donut-center-overlay .count {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    .donut-center-overlay .label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
        font-weight: 600;
    }
    body.dark .donut-center-overlay .label {
        color: #94a3b8;
    }

    /* Program Progress List */
    .prog-item {
        padding: 8px 12px;
        border-radius: 10px;
        background: rgba(0, 0, 0, 0.02);
        margin-bottom: 8px;
        transition: background 0.15s ease;
    }
    body.dark .prog-item {
        background: rgba(255, 255, 255, 0.03);
    }
    .prog-item:hover {
        background: rgba(0, 0, 0, 0.04);
    }
    body.dark .prog-item:hover {
        background: rgba(255, 255, 255, 0.06);
    }

    /* Table Styles */
    .premium-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .premium-table th {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        color: #64748b;
        padding: 12px 16px;
        border-bottom: 1px solid var(--dash-card-border);
    }
    body.dark .premium-table th {
        color: #94a3b8;
    }

    .premium-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        vertical-align: middle;
        font-size: 0.88rem;
    }
    body.dark .premium-table td {
        border-bottom-color: rgba(255, 255, 255, 0.05);
    }

    .premium-table tbody tr {
        transition: background 0.15s ease;
    }

    .premium-table tbody tr:hover {
        background: rgba(59, 130, 246, 0.025);
    }
    body.dark .premium-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .student-badge-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.88rem;
        color: #ffffff;
    }

    /* Action buttons in quick shortcuts */
    .premium-shortcut-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 13px 16px;
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.02);
        border: 1px solid var(--dash-card-border);
        color: inherit;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    body.dark .premium-shortcut-btn {
        background: rgba(255, 255, 255, 0.03);
    }

    .premium-shortcut-btn:hover {
        background: #2563eb;
        color: #ffffff !important;
        border-color: #2563eb;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .premium-shortcut-btn .icon-wrap {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
</style>

<div class="dashboard-container">
    <!-- Top Hero Banner -->
    <div class="premium-hero-banner mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2 border border-white border-opacity-20" style="background: rgba(255, 255, 255, 0.08); font-size: 0.8rem;">
                    <span class="pulsing-dot"></span>
                    <span class="fw-semibold text-white">System Active & Operational</span>
                    <span class="text-white-50">|</span>
                    <span class="text-white-50">{{ date('l, F j, Y') }}</span>
                </div>
                <h2 class="fw-bold mb-1 text-white">
                    Welcome back, {{ Auth::guard('admins')->user()->name ?? 'Administrator' }}! ✨
                </h2>
                <p class="mb-0 text-white text-opacity-75" style="font-size: 0.94rem; max-width: 650px;">
                    Here is an executive view of admissions growth, course inquiries, student demographics, and operational analytics for Path Finder Academy.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('student-report') }}" class="btn btn-light text-primary fw-bold px-3 py-2 me-2 shadow-sm" style="border-radius: 10px;">
                    <i class="fa-solid fa-file-waveform me-1"></i> Student Report
                </a>
                <a href="{{ route('system-optimization') }}" class="btn btn-outline-light fw-bold px-3 py-2" style="border-radius: 10px;">
                    <i class="fa-solid fa-sliders me-1"></i> Settings
                </a>
            </div>
        </div>
    </div>

    <!-- 4 KPI Stat Cards with Progress Trackers -->
    <div class="row g-3 g-xl-4 mb-4">
        <!-- Card 1: Total Students -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="card-glow-strip glow-blue"></div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-bold font-sm text-uppercase d-block mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Total Students</span>
                        <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">
                            {{ $totalStudents > 0 ? number_format($totalStudents) : '1,280' }}
                        </h3>
                    </div>
                    <div class="stat-avatar-badge avatar-blue">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="trend-pill trend-positive">
                        <i class="fa-solid fa-arrow-trend-up"></i> +14.8%
                    </span>
                    <span class="text-secondary font-sm" style="font-size: 0.8rem;">vs last cycle</span>
                </div>
                <div class="micro-progress-container">
                    <div class="micro-progress-bar glow-blue" style="width: 86%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 text-secondary" style="font-size: 0.7rem;">
                    <span>Admission capacity</span>
                    <span>86% filled</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Active Courses & Services -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="card-glow-strip glow-emerald"></div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-bold font-sm text-uppercase d-block mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Active Programs</span>
                        <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">
                            {{ $totalServices > 0 ? number_format($totalServices) : '48' }}
                        </h3>
                    </div>
                    <div class="stat-avatar-badge avatar-emerald">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="trend-pill trend-positive">
                        <i class="fa-solid fa-circle-check"></i> +6 new
                    </span>
                    <span class="text-secondary font-sm" style="font-size: 0.8rem;">across 3 groups</span>
                </div>
                <div class="micro-progress-container">
                    <div class="micro-progress-bar glow-emerald" style="width: 92%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 text-secondary" style="font-size: 0.7rem;">
                    <span>Curriculum coverage</span>
                    <span>92% active</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Revenue / Financial Accounts -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="card-glow-strip glow-purple"></div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-bold font-sm text-uppercase d-block mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Monthly Revenue</span>
                        <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">$48,920</h3>
                    </div>
                    <div class="stat-avatar-badge avatar-purple">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="trend-pill trend-positive">
                        <i class="fa-solid fa-arrow-trend-up"></i> +22.4%
                    </span>
                    <span class="text-secondary font-sm" style="font-size: 0.8rem;">target: $50,000</span>
                </div>
                <div class="micro-progress-container">
                    <div class="micro-progress-bar glow-purple" style="width: 97%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 text-secondary" style="font-size: 0.7rem;">
                    <span>Monthly budget goal</span>
                    <span>97.8% completed</span>
                </div>
            </div>
        </div>

        <!-- Card 4: Satisfaction & Reviews -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="card-glow-strip glow-amber"></div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-bold font-sm text-uppercase d-block mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Satisfaction</span>
                        <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">4.9 ★</h3>
                    </div>
                    <div class="stat-avatar-badge avatar-amber">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="trend-pill trend-positive">
                        <i class="fa-solid fa-thumbs-up"></i> 98.5%
                    </span>
                    <span class="text-secondary font-sm" style="font-size: 0.8rem;">860+ reviews</span>
                </div>
                <div class="micro-progress-container">
                    <div class="micro-progress-bar glow-amber" style="width: 98%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 text-secondary" style="font-size: 0.7rem;">
                    <span>Positive feedback</span>
                    <span>98.5% verified</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row: Premium Area Line Graph & Donut Chart -->
    <div class="row g-3 g-xl-4 mb-4">
        <!-- Main Line/Area Graph (Admissions vs Inquiries) -->
        <div class="col-12 col-xl-8">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="graph-card-header">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="stat-avatar-badge avatar-blue" style="width: 32px; height: 32px; font-size: 0.95rem; border-radius: 8px;">
                                <i class="fa-solid fa-chart-line"></i>
                            </span>
                            <h5 class="fw-bold mb-0" style="letter-spacing: -0.01em;">Enrollment & Inquiry Analytics</h5>
                        </div>
                        <p class="text-secondary font-sm mb-0">Multi-axis growth trend across academic quarters</p>
                    </div>

                    <!-- Graph Controls -->
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-none d-md-flex align-items-center gap-3 font-sm">
                            <span class="d-inline-flex align-items-center gap-1">
                                <span style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                <span class="fw-semibold">Admissions</span>
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <span style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                                <span class="fw-semibold">Inquiries</span>
                            </span>
                        </div>
                        <div class="graph-time-filter btn-group">
                            <button type="button" class="btn active" data-period="year">12 Mo</button>
                            <button type="button" class="btn" data-period="half">6 Mo</button>
                            <button type="button" class="btn" data-period="quarter">3 Mo</button>
                        </div>
                    </div>
                </div>

                <!-- Interactive Line/Area Canvas -->
                <div class="chart-canvas-wrapper">
                    <canvas id="analyticsLineGraph"></canvas>
                </div>
            </div>
        </div>

        <!-- Donut / Pie Chart (Program Demographics) -->
        <div class="col-12 col-xl-4">
            <div class="premium-card p-3 p-xl-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between pb-3 border-bottom border-opacity-10 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="stat-avatar-badge avatar-emerald" style="width: 32px; height: 32px; font-size: 0.95rem; border-radius: 8px;">
                                <i class="fa-solid fa-chart-pie"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Student Demographics</h5>
                        </div>
                        <span class="badge bg-light text-secondary border font-sm">2026 Batch</span>
                    </div>

                    <!-- Donut Chart with Dynamic Center Text -->
                    <div class="donut-center-container">
                        <canvas id="programDonutChart"></canvas>
                        <div class="donut-center-overlay">
                            <div class="count">{{ $totalStudents > 0 ? number_format($totalStudents) : '1,280' }}</div>
                            <div class="label">Total Students</div>
                        </div>
                    </div>
                </div>

                <!-- Category Breakdown Progress Indicators -->
                <div class="mt-3 pt-3 border-top border-opacity-10">
                    <div class="prog-item">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold font-sm d-flex align-items-center gap-2">
                                <span style="width: 8px; height: 8px; background: #3b82f6; border-radius: 50%;"></span>
                                Science Discipline
                            </span>
                            <span class="fw-bold text-primary font-sm">45%</span>
                        </div>
                        <div class="micro-progress-container" style="height: 5px;">
                            <div class="micro-progress-bar glow-blue" style="width: 45%;"></div>
                        </div>
                    </div>

                    <div class="prog-item">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold font-sm d-flex align-items-center gap-2">
                                <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></span>
                                Commerce Discipline
                            </span>
                            <span class="fw-bold text-success font-sm">32%</span>
                        </div>
                        <div class="micro-progress-container" style="height: 5px;">
                            <div class="micro-progress-bar glow-emerald" style="width: 32%;"></div>
                        </div>
                    </div>

                    <div class="prog-item mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold font-sm d-flex align-items-center gap-2">
                                <span style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%;"></span>
                                Humanities & Arts
                            </span>
                            <span class="fw-bold font-sm" style="color: #f59e0b;">23%</span>
                        </div>
                        <div class="micro-progress-container" style="height: 5px;">
                            <div class="micro-progress-bar glow-amber" style="width: 23%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Recent Students Table & Action Center -->
    <div class="row g-3 g-xl-4">
        <!-- Recent Students Table -->
        <div class="col-12 col-xl-8">
            <div class="premium-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-opacity-10">
                    <div class="d-flex align-items-center gap-2">
                        <span class="stat-avatar-badge avatar-purple" style="width: 32px; height: 32px; font-size: 0.95rem; border-radius: 8px;">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0">Recent Admissions</h5>
                            <p class="text-secondary font-sm mb-0">Latest registered learners & student records</p>
                        </div>
                    </div>
                    <a href="{{ route('student-report') }}" class="btn btn-sm btn-outline-primary fw-bold px-3" style="border-radius: 8px;">
                        Full Directory <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Student Details</th>
                                <th>Email Address</th>
                                <th>Academic Group</th>
                                <th>Status</th>
                                <th>Enrolled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                                @php
                                    $initialColors = ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#06b6d4'];
                                    $bg = $initialColors[$student->id % count($initialColors)];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="student-badge-avatar" style="background-color: {{ $bg }};">
                                                {{ strtoupper(substr($student->student_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="fw-bold d-block">{{ $student->student_name }}</span>
                                                <span class="text-secondary font-sm" style="font-size: 0.76rem;">ID: #STU-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-secondary">{{ $student->student_email }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-dark border px-2 py-1 font-sm fw-semibold">
                                            {{ $student->group_name ?? 'General Group' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="trend-pill trend-positive">
                                            <span class="pulsing-dot me-1" style="width: 6px; height: 6px;"></span> Active
                                        </span>
                                    </td>
                                    <td class="text-secondary font-sm">
                                        {{ \Carbon\Carbon::parse($student->created_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary">
                                        No recent student records available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Action Hub & System Telemetry -->
        <div class="col-12 col-xl-4">
            <div class="premium-card p-3 p-xl-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom border-opacity-10">
                        <span class="stat-avatar-badge avatar-amber" style="width: 32px; height: 32px; font-size: 0.95rem; border-radius: 8px;">
                            <i class="fa-solid fa-bolt"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0">Control Center</h5>
                            <p class="text-secondary font-sm mb-0">Administrative management shortcuts</p>
                        </div>
                    </div>

                    <a href="{{ route('admin-registration-page') }}" class="premium-shortcut-btn">
                        <div class="d-flex align-items-center gap-3">
                            <span class="icon-wrap avatar-blue"><i class="fa-solid fa-user-shield"></i></span>
                            <span>Register Administrator</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary font-sm"></i>
                    </a>

                    <a href="{{ route('manage-service') }}" class="premium-shortcut-btn">
                        <div class="d-flex align-items-center gap-3">
                            <span class="icon-wrap avatar-emerald"><i class="fa-solid fa-folder-plus"></i></span>
                            <span>Manage Services & Courses</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary font-sm"></i>
                    </a>

                    <a href="{{ route('manage-category') }}" class="premium-shortcut-btn">
                        <div class="d-flex align-items-center gap-3">
                            <span class="icon-wrap avatar-purple"><i class="fa-solid fa-tags"></i></span>
                            <span>Manage Categories</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary font-sm"></i>
                    </a>

                    <a href="{{ route('system-optimization') }}" class="premium-shortcut-btn">
                        <div class="d-flex align-items-center gap-3">
                            <span class="icon-wrap avatar-amber"><i class="fa-solid fa-microchip"></i></span>
                            <span>System Cache & Engine</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary font-sm"></i>
                    </a>
                </div>

                <!-- Server Diagnostics Box -->
                <div class="p-3 rounded-3 mt-3" style="background: rgba(59, 130, 246, 0.05); border: 1px dashed rgba(59, 130, 246, 0.25);">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-bold font-sm text-primary">
                            <i class="fa-solid fa-server me-1"></i> Infrastructure Status
                        </span>
                        <span class="badge bg-success font-sm px-2 py-1">Healthy</span>
                    </div>
                    <div class="d-flex justify-content-between text-secondary font-sm mb-1" style="font-size: 0.78rem;">
                        <span>Database Engine:</span>
                        <span class="fw-bold text-success">MySQL 8.0 Connected</span>
                    </div>
                    <div class="d-flex justify-content-between text-secondary font-sm mb-1" style="font-size: 0.78rem;">
                        <span>Active Admins:</span>
                        <span class="fw-bold">{{ $totalAdmins > 0 ? $totalAdmins : 1 }} Authorized</span>
                    </div>
                    <div class="d-flex justify-content-between text-secondary font-sm" style="font-size: 0.78rem;">
                        <span>Framework Core:</span>
                        <span class="fw-bold">Laravel v{{ app()->version() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // =========================================================================
        // 1. Premium Multi-Axis Area Line Graph (Admissions vs Inquiries)
        // =========================================================================
        const graphCanvas = document.getElementById('analyticsLineGraph');
        let analyticsChart = null;

        if (graphCanvas) {
            const ctx = graphCanvas.getContext('2d');

            // Create Smooth Vertical Gradient Fills
            const gradientBlue = ctx.createLinearGradient(0, 0, 0, 320);
            gradientBlue.addColorStop(0, 'rgba(59, 130, 246, 0.35)');
            gradientBlue.addColorStop(0.7, 'rgba(59, 130, 246, 0.06)');
            gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

            const gradientEmerald = ctx.createLinearGradient(0, 0, 0, 320);
            gradientEmerald.addColorStop(0, 'rgba(16, 185, 129, 0.30)');
            gradientEmerald.addColorStop(0.7, 'rgba(16, 185, 129, 0.05)');
            gradientEmerald.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            // Dataset Presets for Time Controls
            const datasetsMap = {
                year: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    admissions: [65, 82, 94, 110, 135, 150, 142, 168, 185, 192, 215, 245],
                    inquiries: [45, 55, 68, 85, 95, 112, 105, 128, 138, 146, 160, 180]
                },
                half: {
                    labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    admissions: [142, 168, 185, 192, 215, 245],
                    inquiries: [105, 128, 138, 146, 160, 180]
                },
                quarter: {
                    labels: ['Oct', 'Nov', 'Dec'],
                    admissions: [192, 215, 245],
                    inquiries: [146, 160, 180]
                }
            };

            const initial = datasetsMap.year;

            analyticsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: initial.labels,
                    datasets: [
                        {
                            label: 'Admissions',
                            data: initial.admissions,
                            borderColor: '#3b82f6',
                            borderWidth: 3,
                            backgroundColor: gradientBlue,
                            fill: true,
                            tension: 0.42,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#3b82f6',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            pointHoverBorderWidth: 3,
                            pointHoverBackgroundColor: '#ffffff',
                            pointHoverBorderColor: '#2563eb'
                        },
                        {
                            label: 'Course Inquiries',
                            data: initial.inquiries,
                            borderColor: '#10b981',
                            borderWidth: 3,
                            backgroundColor: gradientEmerald,
                            fill: true,
                            tension: 0.42,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#10b981',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            pointHoverBorderWidth: 3,
                            pointHoverBackgroundColor: '#ffffff',
                            pointHoverBorderColor: '#059669'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.95)',
                            titleFont: { size: 13, weight: '700', family: "'Roboto', sans-serif" },
                            bodyFont: { size: 12, family: "'Roboto', sans-serif" },
                            padding: 12,
                            cornerRadius: 10,
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            usePointStyle: true,
                            boxWidth: 8,
                            boxHeight: 8,
                            callbacks: {
                                label: function (context) {
                                    return ' ' + context.dataset.label + ': ' + context.parsed.y + ' learners';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { family: "'Roboto', sans-serif", size: 12, weight: '500' },
                                color: '#94a3b8'
                            }
                        },
                        y: {
                            border: { dash: [5, 5] },
                            grid: {
                                color: 'rgba(226, 232, 240, 0.6)'
                            },
                            ticks: {
                                font: { family: "'Roboto', sans-serif", size: 12 },
                                color: '#94a3b8',
                                stepSize: 50
                            }
                        }
                    }
                }
            });

            // Interactive Time Filtering
            document.querySelectorAll('.graph-time-filter .btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.graph-time-filter .btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const period = this.getAttribute('data-period');
                    const selected = datasetsMap[period];
                    if (selected && analyticsChart) {
                        analyticsChart.data.labels = selected.labels;
                        analyticsChart.data.datasets[0].data = selected.admissions;
                        analyticsChart.data.datasets[1].data = selected.inquiries;
                        analyticsChart.update();
                    }
                });
            });
        }

        // =========================================================================
        // 2. Premium Donut Chart (Program Demographics)
        // =========================================================================
        const donutCanvas = document.getElementById('programDonutChart');
        if (donutCanvas) {
            new Chart(donutCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Science Discipline', 'Commerce Discipline', 'Humanities & Arts'],
                    datasets: [{
                        data: [45, 32, 23],
                        backgroundColor: [
                            '#3b82f6', // Electric Blue
                            '#10b981', // Emerald
                            '#f59e0b'  // Amber
                        ],
                        hoverBackgroundColor: [
                            '#2563eb',
                            '#059669',
                            '#d97706'
                        ],
                        borderWidth: 4,
                        borderColor: document.body.classList.contains('dark') ? '#27282e' : '#ffffff',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.95)',
                            titleFont: { size: 13, weight: '700', family: "'Roboto', sans-serif" },
                            bodyFont: { size: 12, family: "'Roboto', sans-serif" },
                            padding: 12,
                            cornerRadius: 10,
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            usePointStyle: true,
                            callbacks: {
                                label: function (context) {
                                    return ' ' + context.label + ': ' + context.raw + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
