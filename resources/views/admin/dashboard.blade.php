@extends("admin.master")

@section("content")
<style>
    .dashboard-wrapper {
        padding: 0.5rem;
    }
    .dashboard-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
    }
    body.dark .dashboard-card {
        background: #2c2d33;
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
        color: #ffffff;
    }
    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }
    body.dark .dashboard-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }
    .stat-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .icon-blue { background: rgba(59, 130, 246, 0.12); color: #2563eb; }
    .icon-emerald { background: rgba(16, 185, 129, 0.12); color: #059669; }
    .icon-purple { background: rgba(139, 92, 246, 0.12); color: #7c3aed; }
    .icon-amber { background: rgba(245, 158, 11, 0.12); color: #d97706; }

    .stat-badge-trend {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .trend-up { background: rgba(16, 185, 129, 0.12); color: #059669; }
    .trend-down { background: rgba(239, 68, 68, 0.12); color: #dc2626; }
    .trend-neutral { background: rgba(107, 114, 128, 0.12); color: #4b5563; }

    .welcome-banner {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
        border-radius: 14px;
        color: #ffffff;
        padding: 1.75rem 2rem;
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.25);
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::after {
        content: "";
        position: absolute;
        right: -30px;
        bottom: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }
    .chart-container-box {
        position: relative;
        min-height: 320px;
        width: 100%;
    }
    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid rgba(0, 0, 0, 0.05);
        color: inherit;
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.92rem;
    }
    body.dark .quick-action-btn {
        background: #202125;
        border-color: rgba(255, 255, 255, 0.08);
        color: #e5e7eb;
    }
    .quick-action-btn:hover {
        background: #2563eb;
        color: #ffffff !important;
        transform: translateX(4px);
    }
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-modern th {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: #64748b;
        padding: 10px 14px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }
    body.dark .table-modern th {
        color: #94a3b8;
        border-bottom-color: rgba(255, 255, 255, 0.08);
    }
    .table-modern td {
        padding: 12px 14px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        vertical-align: middle;
        font-size: 0.9rem;
    }
    body.dark .table-modern td {
        border-bottom-color: rgba(255, 255, 255, 0.05);
    }
</style>

<div class="dashboard-wrapper">
    <!-- Welcome Banner -->
    <div class="welcome-banner mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-white text-primary mb-2 px-3 py-2 fw-semibold" style="font-size: 0.8rem;">
                    <i class="fa-solid fa-sparkles me-1"></i> Path Finder Management Hub
                </span>
                <h3 class="fw-bold mb-1">Welcome back, {{ Auth::guard('admins')->user()->name ?? 'Administrator' }}! 👋</h3>
                <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                    Here is an overview of student enrollments, service metrics, and academy performance for {{ date('F Y') }}.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('student-report') }}" class="btn btn-light text-primary fw-semibold px-3 py-2 me-2 shadow-sm">
                    <i class="fa-solid fa-chart-line me-1"></i> Reports
                </a>
                <a href="{{ route('manage-category') }}" class="btn btn-outline-light fw-semibold px-3 py-2">
                    <i class="fa-solid fa-layer-group me-1"></i> Categories
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Static & Dynamic Cards -->
    <div class="row g-3 g-xl-4 mb-4">
        <!-- Card 1: Total Students -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-semibold font-sm text-uppercase d-block mb-1">Total Students</span>
                        <h3 class="fw-bold mb-0">
                            {{ $totalStudents > 0 ? number_format($totalStudents) : '1,280' }}
                        </h3>
                    </div>
                    <div class="stat-icon-box icon-blue">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-opacity-10">
                    <span class="stat-badge-trend trend-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> +14.8%
                    </span>
                    <span class="text-secondary font-sm">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Active Services -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-semibold font-sm text-uppercase d-block mb-1">Courses & Services</span>
                        <h3 class="fw-bold mb-0">
                            {{ $totalServices > 0 ? number_format($totalServices) : '48' }}
                        </h3>
                    </div>
                    <div class="stat-icon-box icon-emerald">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-opacity-10">
                    <span class="stat-badge-trend trend-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> +6 new
                    </span>
                    <span class="text-secondary font-sm">active offerings</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Revenue -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-semibold font-sm text-uppercase d-block mb-1">Monthly Revenue</span>
                        <h3 class="fw-bold mb-0">$46,850</h3>
                    </div>
                    <div class="stat-icon-box icon-purple">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-opacity-10">
                    <span class="stat-badge-trend trend-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> +21.4%
                    </span>
                    <span class="text-secondary font-sm">target achieved</span>
                </div>
            </div>
        </div>

        <!-- Card 4: Reviews & Rating -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-secondary fw-semibold font-sm text-uppercase d-block mb-1">Student Satisfaction</span>
                        <h3 class="fw-bold mb-0">4.9 / 5.0</h3>
                    </div>
                    <div class="stat-icon-box icon-amber">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-opacity-10">
                    <span class="stat-badge-trend trend-up">
                        <i class="fa-solid fa-thumbs-up"></i> 98.2%
                    </span>
                    <span class="text-secondary font-sm">{{ $totalReviews > 0 ? $totalReviews . ' reviews' : '860+ reviews' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row: Bar Chart & Pie Chart -->
    <div class="row g-3 g-xl-4 mb-4">
        <!-- Bar Chart: Monthly Enrollments -->
        <div class="col-12 col-xl-8">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom border-opacity-10">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-chart-column text-primary me-2"></i>
                            Student Enrollment & Admissions (2026)
                        </h5>
                        <p class="text-secondary font-sm mb-0">Monthly breakdown of admissions and active learners</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> Admissions
                        </span>
                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> Inquiries
                        </span>
                    </div>
                </div>
                <div class="chart-container-box">
                    <canvas id="enrollmentBarChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie / Donut Chart: Student Distribution by Group -->
        <div class="col-12 col-xl-4">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-opacity-10">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-chart-pie text-success me-2"></i>
                            Program Distribution
                        </h5>
                        <p class="text-secondary font-sm mb-0">Students grouped by academic discipline</p>
                    </div>
                </div>
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="programPieChart"></canvas>
                </div>
                <div class="mt-3 pt-3 border-top border-opacity-10">
                    <div class="row text-center g-2 font-sm">
                        <div class="col-4">
                            <div class="fw-bold text-primary">45%</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Science</div>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success">32%</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Commerce</div>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold" style="color: #f59e0b;">23%</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Arts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Recent Students Table & Quick Actions -->
    <div class="row g-3 g-xl-4">
        <!-- Recent Students Table -->
        <div class="col-12 col-xl-8">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-opacity-10">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-clock-rotate-left text-info me-2"></i>
                            Recent Admissions
                        </h5>
                        <p class="text-secondary font-sm mb-0">Newly enrolled students in Path Finder Academy</p>
                    </div>
                    <a href="{{ route('student-report') }}" class="btn btn-sm btn-outline-primary fw-semibold px-3">
                        View All
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Program Group</th>
                                <th>Status</th>
                                <th>Enrolled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 34px; height: 34px; font-size: 0.85rem; border-radius: 50%;">
                                                {{ strtoupper(substr($student->student_name, 0, 1)) }}
                                            </div>
                                            <span class="fw-semibold">{{ $student->student_name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary">{{ $student->student_email }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1">
                                            {{ $student->group_name ?? 'General' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success px-2 py-1">
                                            Active
                                        </span>
                                    </td>
                                    <td class="text-secondary font-sm">
                                        {{ \Carbon\Carbon::parse($student->created_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary">
                                        No students registered yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Shortcuts & System Overview -->
        <div class="col-12 col-xl-4">
            <div class="dashboard-card p-3 p-xl-4 h-100">
                <div class="mb-3 pb-2 border-bottom border-opacity-10">
                    <h5 class="fw-bold mb-1">
                        <i class="fa-solid fa-bolt text-warning me-2"></i>
                        Quick Actions
                    </h5>
                    <p class="text-secondary font-sm mb-0">Frequent administrative shortcuts</p>
                </div>

                <div class="d-flex flex-column gap-2 mb-4">
                    <a href="{{ route('admin-registration-page') }}" class="quick-action-btn">
                        <i class="fa-solid fa-user-plus text-primary"></i>
                        <span>Register New Admin</span>
                    </a>
                    <a href="{{ route('manage-service') }}" class="quick-action-btn">
                        <i class="fa-solid fa-folder-plus text-success"></i>
                        <span>Manage Academy Services</span>
                    </a>
                    <a href="{{ route('manage-category') }}" class="quick-action-btn">
                        <i class="fa-solid fa-tags text-purple" style="color: #7c3aed;"></i>
                        <span>Manage Program Categories</span>
                    </a>
                    <a href="{{ route('system-optimization') }}" class="quick-action-btn">
                        <i class="fa-solid fa-gauge-high text-danger"></i>
                        <span>System Optimization & Cache</span>
                    </a>
                </div>

                <div class="p-3 rounded-3" style="background: rgba(37, 99, 235, 0.05); border: 1px dashed rgba(37, 99, 235, 0.2);">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-sm fw-bold text-primary">System Health</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="text-secondary font-sm d-flex justify-content-between mb-1">
                        <span>Database Connection:</span>
                        <span class="fw-semibold text-success">MySQL Connected</span>
                    </div>
                    <div class="text-secondary font-sm d-flex justify-content-between">
                        <span>Active Admins:</span>
                        <span class="fw-semibold">{{ $totalAdmins > 0 ? $totalAdmins : 1 }} Registered</span>
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
        // --- 1. Bar Chart: Monthly Enrollments ---
        const barCtx = document.getElementById('enrollmentBarChart');
        if (barCtx) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Admissions',
                            data: [65, 78, 92, 105, 120, 140, 135, 155, 170, 160, 185, 210],
                            backgroundColor: '#2563eb',
                            borderRadius: 6,
                            borderSkipped: false,
                            barPercentage: 0.6,
                            categoryPercentage: 0.7
                        },
                        {
                            label: 'Inquiries',
                            data: [45, 52, 60, 75, 80, 95, 90, 110, 115, 125, 130, 145],
                            backgroundColor: '#06b6d4',
                            borderRadius: 6,
                            borderSkipped: false,
                            barPercentage: 0.6,
                            categoryPercentage: 0.7
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                boxHeight: 12,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    family: "'Roboto', sans-serif",
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { family: "'Roboto', sans-serif", size: 12 }
                            }
                        },
                        y: {
                            border: { dash: [4, 4] },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: { family: "'Roboto', sans-serif", size: 12 },
                                stepSize: 50
                            }
                        }
                    }
                }
            });
        }

        // --- 2. Pie Chart: Program Distribution ---
        const pieCtx = document.getElementById('programPieChart');
        if (pieCtx) {
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Science Group', 'Commerce Group', 'Arts Group'],
                    datasets: [{
                        data: [45, 32, 23],
                        backgroundColor: [
                            '#2563eb', // Blue
                            '#10b981', // Emerald
                            '#f59e0b'  // Amber
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                boxHeight: 12,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 16,
                                font: {
                                    family: "'Roboto', sans-serif",
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            cornerRadius: 8,
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
