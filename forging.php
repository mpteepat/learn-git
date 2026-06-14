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
                <h4 class="mb-0">Forging Scetion OEE DASHBOARD</h4>
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
        <a href="forging.php" class="active"><i class="fa-solid fa-gauge-high me-1"></i>OEE Dashboard</a>
        <a href="planning_forging.php"><i class="fa-solid fa-chart-bar me-1"></i>Production Plan</a>
        <a href="#"><i class="fa-solid fa-gears me-1"></i>Machine Status</a>
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
                        <div class="kpi-label">Quality Rate</div>
                        <div class="kpi-value">99.8%</div>
                        <div class="kpi-sub">Good pcs / Total pcs</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card h-100" style="background:#fff3cd; border-left: 4px solid #fd7e14;">
                    <div class="card-body py-3">
                        <div class="kpi-label text-warning-emphasis">Today Production</div>
                        <div class="kpi-value text-dark">7,627</div>
                        <div class="kpi-sub text-muted">Plan: 7,627 pcs/day</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card h-100" style="background:#d1ecf1; border-left: 4px solid #0dcaf0;">
                    <div class="card-body py-3">
                        <div class="kpi-label text-info-emphasis">Shift A</div>
                        <div class="kpi-value text-dark">3,814</div>
                        <div class="kpi-sub text-muted">pcs produced</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card h-100" style="background:#fce4d6; border-left: 4px solid #dc3545;">
                    <div class="card-body py-3">
                        <div class="kpi-label text-danger">Shift B</div>
                        <div class="kpi-value text-dark">3,813</div>
                        <div class="kpi-sub text-muted">pcs produced</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#198754;">
                    <div class="card-body py-3">
                        <div class="kpi-label">Stock On Hand</div>
                        <div class="kpi-value">4,230</div>
                        <div class="kpi-sub">pcs in buffer</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Charts Row -->
        <div class="row g-3 mb-3">

            <!-- Cumulative Plan vs Actual -->
            <div class="col-12 col-xl-8">
                <div class="chart-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="section-title mb-0">Cumulative Production Plan vs Actual (May 2026)</div>
                        <div class="d-flex gap-2" style="font-size:0.72rem;">
                            <span><span class="legend-dot" style="background:#dc3545;"></span>Plan Accum.</span>
                            <span><span class="legend-dot" style="background:#0d6efd;"></span>Actual Accum.</span>
                        </div>
                    </div>
                    <div style="position:relative; height:220px;">
                        <canvas id="cumulativeChart" role="img" aria-label="Cumulative production plan vs actual for May 2026">Loading chart...</canvas>
                    </div>
                </div>
            </div>

            <!-- OEE Gauges -->
            <div class="col-12 col-xl-4">
                <div class="chart-card h-100">
                    <div class="section-title">OEE Components</div>
                    <div class="d-flex justify-content-around align-items-center flex-wrap gap-2 mt-2">
                        <div class="text-center">
                            <canvas id="oeeGauge" width="110" height="110" role="img" aria-label="OEE 84.2%"></canvas>
                            <div style="font-size:0.75rem; font-weight:700; color:#1a7a3a; margin-top:2px;">OEE</div>
                            <div style="font-size:1.1rem; font-weight:800;">84.2%</div>
                        </div>
                        <div class="text-center">
                            <canvas id="availGauge" width="110" height="110" role="img" aria-label="Availability 91.5%"></canvas>
                            <div style="font-size:0.75rem; font-weight:700; color:#fd7e14; margin-top:2px;">Availability</div>
                            <div style="font-size:1.1rem; font-weight:800;">91.5%</div>
                        </div>
                        <div class="text-center">
                            <canvas id="perfGauge" width="110" height="110" role="img" aria-label="Performance 92.0%"></canvas>
                            <div style="font-size:0.75rem; font-weight:700; color:#0d6efd; margin-top:2px;">Performance</div>
                            <div style="font-size:1.1rem; font-weight:800;">92.0%</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1" style="font-size:0.75rem;"><span>Quality</span><span class="fw-bold text-success">99.8%</span></div>
                        <div class="progress progress-oee">
                            <div class="progress-bar bg-success" style="width:99.8%"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 mb-1" style="font-size:0.75rem;"><span>O.A. Target</span><span class="fw-bold" style="color:#1a7a3a;">≥ 85%</span></div>
                        <div class="d-flex gap-1 mt-1">
                            <span class="badge bg-success">O.A. ≥ Target ✓</span>
                            <span class="badge bg-warning text-dark">Judge: Day 22 ⚠</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Bar Chart + Shift Table -->
        <div class="row g-3 mb-3">

            <!-- Daily Bar Chart -->
            <div class="col-12 col-xl-8">
                <div class="chart-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="section-title mb-0">Daily Production Plan vs Actual — Shift A &amp; B</div>
                        <div class="d-flex gap-2 flex-wrap" style="font-size:0.72rem;">
                            <span><span class="legend-dot" style="background:#1a7a3a;"></span>Shift A (Actual ≥ target)</span>
                            <span><span class="legend-dot" style="background:#fd7e14;"></span>Shift A (Actual &lt; target)</span>
                            <span><span class="legend-dot" style="background:#adb5bd;"></span>Plan/Day</span>
                        </div>
                    </div>
                    <div style="position:relative; height:220px;">
                        <canvas id="dailyBarChart" role="img" aria-label="Daily production bar chart for May 2026, showing plan and actual per day">Loading...</canvas>
                    </div>
                </div>
            </div>

            <!-- Part Code Summary -->
            <div class="col-12 col-xl-4">
                <div class="chart-card h-100">
                    <div class="section-title">Part Code — Order vs Actual (Month)</div>
                    <div style="position:relative; height:220px;">
                        <canvas id="partChart" role="img" aria-label="Part code order vs actual bar chart">Loading...</canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Production Data Table -->
        <div class="row g-3 mb-3">
            <div class="col-12">
                <div class="chart-card">
                    <div class="section-title">Daily Production Record — May 2026 (KT-163 · COMMON)</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-production mb-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <?php
                                    $days = range(1, 31);
                                    foreach ($days as $d) {
                                        echo "<th>$d</th>";
                                    }
                                    echo "<th>Total</th>";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $deliveryPlan = [0,0,0,7427,7427,7427,7427,7427,7427,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617];
                                $actualPlan   = [0,0,0,6890,7150,7520,7180,7400,7320,7810,7500,7420,7630,7200,7700,7550,7480,7900,7620,7430,7800,7400,7627,7500,7380,7610,7490,7530,7560,7410,7580];
                                $shiftA       = [0,0,0,3200,3450,3680,3510,3720,3580,3950,3700,3620,3810,3500,3820,3760,3640,3990,3800,3650,3900,3650,3814,3700,3620,3760,3650,3740,3730,3600,3720];
                                $shiftB       = [0,0,0,3690,3700,3840,3670,3680,3740,3860,3800,3800,3820,3700,3880,3790,3840,3910,3820,3780,3900,3750,3813,3800,3760,3850,3840,3790,3830,3810,3860];

                                $totalDP = array_sum($deliveryPlan);
                                $totalAP = array_sum($actualPlan);
                                $totalSA = array_sum($shiftA);
                                $totalSB = array_sum($shiftB);

                                $rows = [
                                    ['Delivery Plan',   'pcs', $deliveryPlan,  $totalDP,  ''],
                                    ['Production Plan', 'pcs', $actualPlan,   $totalAP,  ''],
                                    ['Production Shift A', 'pcs', $shiftA,    $totalSA,  'text-info'],
                                    ['Production Shift B', 'pcs', $shiftB,    $totalSB,  'text-danger'],
                                ];

                                foreach ($rows as $row) {
                                    [$label, $unit, $data, $total, $cls] = $row;
                                    echo "<tr>";
                                    echo "<td class='fw-semibold'>$label</td>";
                                    echo "<td class='text-center text-muted'>$unit</td>";
                                    foreach ($data as $val) {
                                        $display = $val === 0 ? '-' : number_format($val);
                                        echo "<td class='text-end $cls'>$display</td>";
                                    }
                                    echo "<td class='text-end fw-bold $cls'>" . number_format($total) . "</td>";
                                    echo "</tr>";
                                }

                                // Balance row
                                echo "<tr class='table-warning'>";
                                echo "<td class='fw-bold'>Production Balance</td>";
                                echo "<td class='text-center text-muted'>pcs</td>";
                                foreach ($deliveryPlan as $i => $plan) {
                                    $bal = $plan > 0 ? $actualPlan[$i] - $plan : 0;
                                    $display = $bal === 0 ? '-' : ($bal > 0 ? "+".number_format($bal) : number_format($bal));
                                    $c = $bal >= 0 ? 'text-success' : 'text-danger';
                                    echo "<td class='text-end fw-semibold $c'>$display</td>";
                                }
                                $totalBal = $totalAP - $totalDP;
                                $bc = $totalBal >= 0 ? 'text-success' : 'text-danger';
                                echo "<td class='text-end fw-bold $bc'>" . ($totalBal >= 0 ? "+".number_format($totalBal) : number_format($totalBal)) . "</td>";
                                echo "</tr>";

                                // OEE row
                                echo "<tr class='part-row-head'>";
                                echo "<td class='fw-bold text-success'>OEE (O.A.) %</td>";
                                echo "<td class='text-center text-muted'>%</td>";
                                $oeeVals = [0,0,0,81,82,84,82,83,82,86,85,84,86,83,85,85,84,87,85,84,86,83,84,84,83,85,84,84,85,83,85];
                                $oeeTotal = round(array_sum(array_filter($oeeVals)) / count(array_filter($oeeVals)), 1);
                                foreach ($oeeVals as $v) {
                                    if ($v === 0) { echo "<td class='text-center'>-</td>"; continue; }
                                    $c = $v >= 85 ? 'text-success fw-bold' : ($v >= 80 ? 'text-warning fw-semibold' : 'text-danger');
                                    echo "<td class='text-center $c'>$v</td>";
                                }
                                echo "<td class='text-center fw-bold text-success'>$oeeTotal</td>";
                                echo "</tr>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Part Code Order Table -->
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-7">
                <div class="chart-card">
                    <div class="section-title">Part Code — Order/Month Detail</div>
                    <table class="table table-bordered table-sm table-production mb-0">
                        <thead>
                            <tr>
                                <th>Part Code</th>
                                <th class="text-end">Order/Month (pcs)</th>
                                <th class="text-end">Actual MTD (pcs)</th>
                                <th class="text-end">Balance</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $parts = [
                                ['EPC',   46620, 45800],
                                ['D03B',  28000, 28000],
                                ['PJR',   46620, 45950],
                                ['MOC-S', 18000, 17800],
                                ['S8XD',  14000, 13920],
                                ['SK45',   9720,  9703],
                                ['CNH',       0,     0],
                            ];
                            foreach ($parts as $p) {
                                [$code, $order, $actual] = $p;
                                $bal = $actual - $order;
                                $pct = $order > 0 ? round($actual / $order * 100, 1) : 0;
                                $balStr = $bal >= 0 ? "+".number_format($bal) : number_format($bal);
                                $balCls = $bal >= 0 ? 'text-success' : 'text-danger';
                                $statusBadge = $pct >= 100 ? '<span class="badge bg-success">Complete</span>' : ($pct >= 90 ? '<span class="badge bg-warning text-dark">On Track</span>' : '<span class="badge bg-danger">Behind</span>');
                                $barCls = $pct >= 100 ? 'bg-success' : ($pct >= 90 ? 'bg-warning' : 'bg-danger');
                                if ($order == 0) {
                                    echo "<tr><td class='fw-bold'>$code</td><td class='text-end text-muted'>-</td><td class='text-end text-muted'>-</td><td class='text-end text-muted'>-</td><td>-</td><td class='text-center'><span class='badge bg-secondary'>N/A</span></td></tr>";
                                    continue;
                                }
                                echo "<tr>";
                                echo "<td class='fw-bold'>$code</td>";
                                echo "<td class='text-end'>" . number_format($order) . "</td>";
                                echo "<td class='text-end'>" . number_format($actual) . "</td>";
                                echo "<td class='text-end fw-semibold $balCls'>$balStr</td>";
                                echo "<td><div class='progress' style='height:8px;'><div class='progress-bar $barCls' style='width:$pct%'></div></div><div style='font-size:0.68rem;text-align:right;'>$pct%</div></td>";
                                echo "<td class='text-center'>$statusBadge</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <td class="fw-bold">TOTAL</td>
                                <td class="text-end fw-bold">162,960</td>
                                <td class="text-end fw-bold">161,173</td>
                                <td class="text-end fw-bold text-warning">-1,787</td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Leader / QC Sign -->
            <div class="col-12 col-lg-5">
                <div class="chart-card h-100">
                    <div class="section-title">Work Time / Approval</div>
                    <table class="table table-bordered table-sm table-production mb-3">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-end">Shift A</th>
                                <th class="text-end">Shift B</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $workRows = [
                                ['Working Time (hr)', '7.66', '7.66'],
                                ['Break / Lunch (hr)', '0.50', '0.50'],
                                ['Planned Down (hr)', '0.25', '0.25'],
                                ['Unplanned Down (hr)', '0.63', '0.75'],
                                ['Net Production Time', '6.28', '6.16'],
                            ];
                            foreach ($workRows as $r) {
                                echo "<tr><td>{$r[0]}</td><td class='text-end text-info fw-semibold'>{$r[1]}</td><td class='text-end text-danger fw-semibold'>{$r[2]}</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="section-title">Sign-off</div>
                    <div class="row g-2">
                        <?php
                        $signoff = [
                            ['Leader (ผู้นำกลุ่ม)', '1 ส. / กะ', 'text-success'],
                            ['QC Inspector', '1 ส. / กะ', 'text-info'],
                            ['GM (OM)', '1 ส./เดือน', 'text-warning'],
                        ];
                        foreach ($signoff as $s) {
                            echo "<div class='col-12'>";
                            echo "<div class='d-flex justify-content-between align-items-center bg-light rounded px-3 py-2'>";
                            echo "<span style='font-size:0.78rem;'><i class='fa fa-user-check me-2 {$s[2]}'></i>{$s[0]}</span>";
                            echo "<span class='badge bg-secondary'>{$s[1]}</span>";
                            echo "</div></div>";
                        }
                        ?>
                    </div>
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

    <script>
        // ---- Cumulative Chart ----
        (function() {
            const days = Array.from({
                length: 31
            }, (_, i) => i + 1);
            const planPerDay = 7427;
            let planAccum = [],
                actAccum = [];
            const dailyAct = [0, 0, 0, 6890, 7150, 7520, 7180, 7400, 7320, 7810, 7500, 7420, 7630, 7200, 7700, 7550, 7480, 7900, 7620, 7430, 7800, 7400, 7627, 7500, 7380, 7610, 7490, 7530, 7560, 7410, 7580];
            let cp = 0,
                ca = 0;
            for (let i = 0; i < 31; i++) {
                cp += (i >= 3 ? planPerDay : 0);
                ca += dailyAct[i];
                planAccum.push(cp);
                actAccum.push(ca);
            }
            new Chart(document.getElementById('cumulativeChart'), {
                type: 'line',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Plan Accum.',
                        data: planAccum,
                        borderColor: '#dc3545',
                        borderWidth: 2,
                        borderDash: [6, 3],
                        pointRadius: 0,
                        fill: false,
                        tension: 0.1
                    }, {
                        label: 'Actual Accum.',
                        data: actAccum,
                        borderColor: '#0d6efd',
                        borderWidth: 2.5,
                        pointRadius: 3,
                        pointBackgroundColor: '#0d6efd',
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                maxRotation: 0
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                callback: v => (v / 1000).toFixed(0) + 'K'
                            },
                            grid: {
                                color: '#f0f0f0'
                            }
                        }
                    }
                }
            });
        })();

        // ---- Daily Bar Chart ----
        (function() {
            const days = Array.from({
                length: 31
            }, (_, i) => i + 1);
            const plan = [0, 0, 0, 7427, 7427, 7427, 7427, 7427, 7427, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617, 7617];
            const actual = [0, 0, 0, 6890, 7150, 7520, 7180, 7400, 7320, 7810, 7500, 7420, 7630, 7200, 7700, 7550, 7480, 7900, 7620, 7430, 7800, 7400, 7627, 7500, 7380, 7610, 7490, 7530, 7560, 7410, 7580];
            const barColors = actual.map((a, i) => plan[i] > 0 ? (a >= plan[i] ? '#1a7a3a' : '#fd7e14') : 'transparent');

            new Chart(document.getElementById('dailyBarChart'), {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Actual',
                        data: actual,
                        backgroundColor: barColors,
                        borderWidth: 0,
                        borderRadius: 2
                    }, {
                        label: 'Plan',
                        data: plan,
                        type: 'line',
                        borderColor: '#6c757d',
                        borderWidth: 1.5,
                        borderDash: [4, 3],
                        pointRadius: 0,
                        fill: false,
                        tension: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 9
                                },
                                maxRotation: 0
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                callback: v => (v / 1000).toFixed(1) + 'K'
                            },
                            min: 0,
                            max: 9000,
                            grid: {
                                color: '#f0f0f0'
                            }
                        }
                    }
                }
            });
        })();

        // ---- Part Code Chart ----
        (function() {
            const parts = ['EPC', 'D03B', 'PJR', 'MOC-S', 'S8XD', 'SK45'];
            const orders = [46620, 28000, 46620, 18000, 14000, 9720];
            const actuals = [45800, 28000, 45950, 17800, 13920, 9703];
            new Chart(document.getElementById('partChart'), {
                type: 'bar',
                data: {
                    labels: parts,
                    datasets: [{
                        label: 'Order',
                        data: orders,
                        backgroundColor: '#adb5bd',
                        borderRadius: 3
                    }, {
                        label: 'Actual',
                        data: actuals,
                        backgroundColor: '#1a7a3a',
                        borderRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                }
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                callback: v => (v / 1000).toFixed(0) + 'K'
                            },
                            grid: {
                                color: '#f0f0f0'
                            }
                        }
                    }
                }
            });
        })();

        // ---- Donut Gauge Helper ----
        function drawGauge(id, value, color) {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [value, 100 - value],
                        backgroundColor: [color, '#e9ecef'],
                        borderWidth: 0,
                        circumference: 270,
                        rotation: 225
                    }]
                },
                options: {
                    responsive: false,
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });
        }

        drawGauge('oeeGauge', 84.2, '#1a7a3a');
        drawGauge('availGauge', 91.5, '#fd7e14');
        drawGauge('perfGauge', 92.0, '#0d6efd');
    </script>

</body>

</html>