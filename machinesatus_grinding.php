<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP OEE Dashboard - Forging Section</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <style>
         :root {
            --green-main: #1a7a3a;
            --green-light: #d4edda;
            --green-dark: #0f5025;
            --orange-oee: #fd7e14;
            --header-bg: #1a7a3a;
        }
        
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
        }
        
        .top-header {
            background-color: var(--header-bg);
            color: white;
            padding: 10px 20px;
            border-bottom: 4px solid #ffdd00;
        }
        
        .top-header h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .machine-badge {
            background: #ffdd00;
            color: #1a7a3a;
            font-weight: 800;
            border-radius: 4px;
            padding: 2px 10px;
            font-size: 1rem;
        }
        
        .kpi-card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        
        .kpi-card .kpi-value {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.1;
        }
        
        .kpi-card .kpi-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.85;
        }
        
        .kpi-card .kpi-sub {
            font-size: 0.8rem;
            opacity: 0.75;
        }
        
        .oee-ring-wrap {
            position: relative;
            display: inline-block;
            width: 120px;
            height: 120px;
        }
        
        .oee-ring-wrap canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .oee-ring-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--green-dark);
            border-left: 4px solid var(--green-main);
            padding-left: 8px;
            margin-bottom: 10px;
        }
        
        .chart-card {
            background: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 16px;
        }
        
        .shift-badge {
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 3px;
            padding: 1px 6px;
        }
        
        .table-production th {
            background-color: #1a7a3a;
            color: white;
            font-size: 0.72rem;
            white-space: nowrap;
            border: 1px solid #145e2c;
            padding: 5px 6px;
        }
        
        .table-production td {
            font-size: 0.72rem;
            border: 1px solid #dee2e6;
            padding: 4px 6px;
            white-space: nowrap;
        }
        
        .table-production tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
        }
        
        .nav-bar-custom {
            background: #145e2c;
            padding: 6px 20px;
        }
        
        .nav-bar-custom a {
            color: #b5dfc5 !important;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 4px;
        }
        
        .nav-bar-custom a:hover,
        .nav-bar-custom a.active {
            background: #1a7a3a;
            color: white !important;
        }
        
        .footer-bar {
            background: #1a7a3a;
            color: #b5dfc5;
            text-align: center;
            font-size: 0.75rem;
            padding: 8px;
            margin-top: 20px;
        }
        
        .part-row-head {
            background: #e8f5e9;
            font-weight: 700;
        }
        
        .progress-oee {
            height: 10px;
            border-radius: 5px;
        }
        
        .legend-dot {
            width: 12px;
            height: 12px;
            display: inline-block;
            border-radius: 2px;
            margin-right: 4px;
        }
    </style>
</head>

<body>

    <!-- Top Header -->
    <div class="top-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-industry fa-lg"></i>
            <div>
                <h4 class="mb-0">Grinding Progressive Scetion OEE DASHBOARD</h4>
                <small class="opacity-75">Operational Availability &amp; Efficiency Monitoring · ERP System</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="machine-badge">KT-163</span>
            <span class="machine-badge">PRESS</span>
            <span class="text-warning fw-bold">May 2026</span>
        </div>
    </div>

    <!-- Nav -->
    <nav class="nav-bar-custom d-flex gap-1 flex-wrap">
        
    <a href="index.php"><i class="fa-solid fa-house me-1"></i>Home</a>
        <a href="grinding_progressive.php" class="active"><i class="fa-solid fa-gauge-high me-1"></i>OEE Dashboard</a>
        <a href="planning_grinding.php"><i class="fa-solid fa-chart-bar me-1"></i>Production Plan</a>
        <a href="machinesatus_grinding.php"><i class="fa-solid fa-gears me-1"></i>Machine Status</a>
        <a href="#"><i class="fa-solid fa-boxes-stacked me-1"></i>Part Codes</a>
        <a href="#"><i class="fa-solid fa-calendar-days me-1"></i>Shift Report</a>
        <a href="#"><i class="fa-solid fa-file-export me-1"></i>Export</a>
    </nav>

    <div class="container-fluid py-3 px-3">

        <!-- Machine Info Row -->
        <div class="row g-2 mb-3 align-items-center">
            <div class="col-auto">
                <div class="bg-white rounded px-3 py-2 shadow-sm d-flex align-items-center gap-3">
                    <div>
                        <div class="text-muted" style="font-size:0.7rem;">Process Time</div>
                        <div class="fw-bold">3.80 sec</div>
                    </div>
                    <div class="border-start ps-3">
                        <div class="text-muted" style="font-size:0.7rem;">Working Hr/Day</div>
                        <div class="fw-bold">15.32 hr</div>
                    </div>
                    <div class="border-start ps-3">
                        <div class="text-muted" style="font-size:0.7rem;">Target/Month</div>
                        <div class="fw-bold text-success">162,960 pcs</div>
                    </div>
                    <div class="border-start ps-3">
                        <div class="text-muted" style="font-size:0.7rem;">Actual MTD</div>
                        <div class="fw-bold text-primary">160,173 pcs</div>
                    </div>
                    <div class="border-start ps-3">
                        <div class="text-muted" style="font-size:0.7rem;">Balance</div>
                        <div class="fw-bold text-danger">2,787 pcs</div>
                    </div>
                </div>
            </div>
            <div class="col text-end">
                <span class="badge bg-success me-1"><span class="status-dot bg-white"></span>Line Running</span>
                <span class="badge bg-secondary">Last update: <?php echo date('d M Y H:i'); ?></span>
            </div>
        </div>

        <!-- KPI Cards Row -->
        <div class="row g-2 mb-3">

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#1a7a3a;">
                    <div class="card-body py-3">
                        <div class="kpi-label">OEE Overall</div>
                        <div class="kpi-value" id="oee-val">84.2%</div>
                        <div class="kpi-sub"><i class="fa fa-arrow-up me-1"></i>+2.1% vs last month</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#fd7e14;">
                    <div class="card-body py-3">
                        <div class="kpi-label">Availability</div>
                        <div class="kpi-value" id="avail-val">91.5%</div>
                        <div class="kpi-sub">Uptime / Planned Time</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#0d6efd;">
                    <div class="card-body py-3">
                        <div class="kpi-label">Performance</div>
                        <div class="kpi-value" id="perf-val">92.0%</div>
                        <div class="kpi-sub">Actual vs Ideal Rate</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#6f42c1;">
                    <div class="card-body py-3">
                        <div class="kpi-label">Tool life check</div>
                        <div class="kpi-value">80%</div>
                        <div class="kpi-sub">Good pcs / Total pcs</div>
                    </div>
                </div>
            </div>
        </div>

        

    <!-- Footer -->
    <div class="footer-bar">
        <i class="fa fa-industry me-2"></i>ERP Production Control System &nbsp;|&nbsp; Machine: KT-163 &nbsp;|&nbsp; Process: Press &nbsp;|&nbsp; Line: COMMON &nbsp;|&nbsp;
        <?php echo date('Y'); ?> &copy; Production Engineering Dept.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>