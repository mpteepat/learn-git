<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KT - Industrial Digitization</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <style>
        :root {
            --kt-green: #1a7a3a;
            --kt-green-dark: #0f5025;
            --kt-green-light: #e8f5e9;
            --kt-yellow: #ffdd00;
            --kt-orange: #fd7e14;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
        }

        /* ── Top Header ── */
        .top-header {
            background: var(--kt-green);
            color: white;
            padding: 12px 24px;
            border-bottom: 4px solid var(--kt-yellow);
        }

        .top-header h4 { margin: 0; font-weight: 800; letter-spacing: 1px; }

        .kt-badge {
            background: var(--kt-yellow);
            color: var(--kt-green-dark);
            font-weight: 900;
            border-radius: 4px;
            padding: 3px 12px;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        /* ── Nav bar ── */
        .nav-bar-custom {
            background: var(--kt-green-dark);
            padding: 6px 20px;
        }

        .nav-bar-custom a {
            color: #b5dfc5 !important;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .nav-bar-custom a:hover, .nav-bar-custom a.active {
            background: var(--kt-green);
            color: white !important;
        }

        /* ── Machine info strip ── */
        .info-strip {
            background: white;
            border-radius: 8px;
            padding: 10px 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            border-left: 5px solid var(--kt-green);
        }

        .info-strip .info-item { text-align: center; }
        .info-strip .info-label { font-size: 0.65rem; text-transform: uppercase; color: #6c757d; letter-spacing: 0.5px; }
        .info-strip .info-val { font-size: 1rem; font-weight: 700; }

        /* ── KPI Cards ── */
        .kpi-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.15s;
        }

        .kpi-card:hover { transform: translateY(-2px); }
        .kpi-card .kpi-val { font-size: 1.9rem; font-weight: 800; line-height: 1; }
        .kpi-card .kpi-lbl { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.8px; opacity: 0.88; }
        .kpi-card .kpi-sub { font-size: 0.75rem; opacity: 0.75; margin-top: 3px; }

        /* ── Chart cards ── */
        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .section-title {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--kt-green-dark);
            border-left: 4px solid var(--kt-green);
            padding-left: 8px;
            margin-bottom: 12px;
        }

        /* ── Factory Section Cards ── */
        .factory-card {
            border-radius: 12px;
            border: none;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.12);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }

        .factory-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
        }

        .factory-card .card-img-overlay-custom {
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 60%);
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 180px;
        }

        .factory-card .card-thumb {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .factory-card .thumb-placeholder {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
        }

        .factory-card .card-footer-custom {
            padding: 12px 14px;
            background: white;
        }

        .oee-mini-bar {
            height: 6px;
            border-radius: 3px;
            margin-top: 5px;
        }

        .status-pill {
            font-size: 0.68rem;
            font-weight: 700;
            border-radius: 20px;
            padding: 2px 10px;
        }

        /* ── Legend dots ── */
        .leg-dot {
            width: 11px; height: 11px;
            display: inline-block;
            border-radius: 2px;
            margin-right: 4px;
            vertical-align: middle;
        }

        /* ── Footer ── */
        .footer-bar {
            background: var(--kt-green);
            color: #b5dfc5;
            text-align: center;
            font-size: 0.75rem;
            padding: 10px;
            margin-top: 24px;
        }

        /* ── Table ── */
        .tbl-oee th {
            background: var(--kt-green);
            color: white;
            font-size: 0.72rem;
            padding: 6px 8px;
            border: 1px solid #145e2c;
            white-space: nowrap;
        }

        .tbl-oee td {
            font-size: 0.72rem;
            padding: 5px 8px;
            border: 1px solid #dee2e6;
            white-space: nowrap;
        }

        .tbl-oee tr:nth-child(even) td { background: #f8f9fa; }

        .hero-section {
            background: white;
            border-radius: 12px;
            padding: 28px 20px 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            margin-bottom: 20px;
        }

        .hero-section h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--kt-green-dark);
        }

        .hero-section p { color: #555; font-size: 0.95rem; }
    </style>
</head>

    <!-- Top Header -->
    <div class="top-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-industry fa-2x"></i>
            <div>
                <h4 class="mb-0">KT PROJECT — INDUSTRIAL DIGITIZATION</h4>
                <small class="opacity-75">Smart Factory OEE Monitoring &amp; Production Control System</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="kt-badge">KT FACTORY</span>
            <span class="text-warning fw-bold ms-2">
                <i class="fa fa-circle fa-xs text-success me-1"></i>LIVE
            </span>
        </div>
    </div>

    <!-- Nav -->
    <nav class="nav-bar-custom d-flex gap-1 flex-wrap">
        <a href="index.php"><i class="fa-solid fa-house me-1"></i>Home</a>
        <a href="index.php" class="active"><i class="fa-solid fa-gauge-high me-1"></i>OEE Dashboard</a>
        <a href="forging.php"><i class="fa-solid fa-hammer me-1"></i>Forging</a>
         <!-- none --> <a href="pressing_main.php"><i class="fa-solid fa-compress me-1"></i>Pressing</a>
        <a href="grinding_progressive.php"><i class="fa-solid fa-gear me-1"></i>Grinding Progressive</a>
         <!-- none --> <a href="heat_treat.php"><i class="fa-solid fa-fire me-1"></i>Heat Treatment</a>
        <a href="hr.php"><i class="fa-solid fa-screwdriver-wrench me-1"></i>Human Resources</a>
         <!-- none --> <a href="report.php"><i class="fa-solid fa-file-chart-column me-1"></i>Reports</a>
    </nav>

    <!-- Container -->
    <div class="container-fluid py-3 px-3">

        <!-- Hero -->
        <div class="hero-section">
            <h1><i class="fa-solid fa-industry me-2" style="color:var(--kt-green);"></i>KT &nbsp;·&nbsp; Project Industrial Digitization</h1>
            <p class="mb-0">Real-time OEE monitoring, production progress tracking, and factory section dashboards — all in one place.</p>
        </div>

    </div>

        <!-- ═══ KPI CARDS ═══ -->
        <div class="row g-2 mb-3">
            
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:var(--kt-green);">
                    <div class="card-body py-3">
                        <div class="kpi-lbl">OEE Overall</div>
                        <div class="kpi-val">84.2%</div>
                        <div class="kpi-sub"><i class="fa fa-arrow-up me-1"></i>+2.1% vs prev</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#fd7e14;">
                    <div class="card-body py-3">
                        <div class="kpi-lbl">Availability</div>
                        <div class="kpi-val">91.5%</div>
                        <div class="kpi-sub">Uptime / Planned</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#0d6efd;">
                    <div class="card-body py-3">
                        <div class="kpi-lbl">Performance</div>
                        <div class="kpi-val">92.0%</div>
                        <div class="kpi-sub">Actual vs Ideal</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#6f42c1;">
                    <div class="card-body py-3">
                        <div class="kpi-lbl">Quality Rate</div>
                        <div class="kpi-val">99.8%</div>
                        <div class="kpi-sub">Good / Total pcs</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card h-100" style="background:#fff3cd; border-left:4px solid #fd7e14;">
                    <div class="card-body py-3">
                        <div class="kpi-lbl text-warning-emphasis">Today Output</div>
                        <div class="kpi-val text-dark">7,627</div>
                        <div class="kpi-sub text-muted">Plan: 7,627 pcs</div>
                    </div>
                </div>
            </div>
            
            <div class="col-6 col-sm-4 col-md-3 col-xl">
                <div class="kpi-card card text-white h-100" style="background:#198754;">
                    <div class="card-body py-3">
                        <div class="kpi-lbl">Defect Rate</div>
                        <div class="kpi-val">0.2%</div>
                        <div class="kpi-sub"><i class="fa fa-arrow-down me-1"></i>-0.05% vs prev</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ CHARTS ROW ═══ -->
        <div class="row g-3 mb-3">

            <!-- Cumulative Plan vs Actual -->
            <div class="col-12 col-xl-5">
                <div class="chart-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="section-title mb-0">Cumulative Plan vs Actual — May 2026</div>
                        <div class="d-flex gap-2" style="font-size:0.7rem;">
                            <span><span class="leg-dot" style="background:#dc3545;"></span>Plan</span>
                            <span><span class="leg-dot" style="background:#0d6efd;"></span>Actual</span>
                        </div>
                    </div>
                    <div style="position:relative;height:200px;">
                        <canvas id="cumulChart" role="img" aria-label="Cumulative plan vs actual production chart May 2026">Loading…</canvas>
                    </div>
                </div>
            </div>

            <!-- Daily Bar -->
            <div class="col-12 col-xl-4">
                <div class="chart-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="section-title mb-0">Daily Output vs Plan</div>
                        <div class="d-flex gap-2" style="font-size:0.7rem;">
                            <span><span class="leg-dot" style="background:var(--kt-green);"></span>≥ Plan</span>
                            <span><span class="leg-dot" style="background:#fd7e14;"></span>&lt; Plan</span>
                        </div>
                    </div>
                    <div style="position:relative;height:200px;">
                        <canvas id="dailyBarChart" role="img" aria-label="Daily production bar chart May 2026">Loading…</canvas>
                    </div>
                </div>
            </div>

            <!-- OEE Donuts -->
            <div class="col-12 col-xl-3">
                <div class="chart-card h-100">
                    <div class="section-title">OEE Components</div>
                    <div class="d-flex justify-content-around mt-2 flex-wrap gap-2">
                        <div class="text-center">
                            <canvas id="g1" width="90" height="90" role="img" aria-label="OEE 84.2%"></canvas>
                            <div style="font-size:0.7rem;font-weight:700;color:var(--kt-green);">OEE</div>
                            <div style="font-size:1rem;font-weight:800;">84.2%</div>
                        </div>
                        <div class="text-center">
                            <canvas id="g2" width="90" height="90" role="img" aria-label="Availability 91.5%"></canvas>
                            <div style="font-size:0.7rem;font-weight:700;color:#fd7e14;">Avail.</div>
                            <div style="font-size:1rem;font-weight:800;">91.5%</div>
                        </div>
                        <div class="text-center">
                            <canvas id="g3" width="90" height="90" role="img" aria-label="Performance 92.0%"></canvas>
                            <div style="font-size:0.7rem;font-weight:700;color:#0d6efd;">Perf.</div>
                            <div style="font-size:1rem;font-weight:800;">92.0%</div>
                        </div>
                    </div>
                    <div class="mt-3 px-1">
                        <div class="d-flex justify-content-between mb-1" style="font-size:0.72rem;"><span>Quality</span><span class="fw-bold text-success">99.8%</span></div>
                        <div class="progress" style="height:7px;"><div class="progress-bar bg-success" style="width:99.8%"></div></div>
                        <div class="d-flex justify-content-between mt-2 mb-1" style="font-size:0.72rem;"><span>O.A. vs Target (85%)</span><span class="fw-bold text-success">✓ Met</span></div>
                        <div class="progress" style="height:7px;"><div class="progress-bar bg-success" style="width:91.5%"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ OEE TREND TABLE ═══ -->
        <div class="row g-3 mb-3">
            <div class="col-12">
                <div class="chart-card">
                    <div class="section-title">OEE Daily Record — May 2026 (All Lines)</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm tbl-oee mb-0">
                            <thead>
                                <tr>
                                    <th>Line / Process</th>
                                    <?php for ($d = 1; $d <= 31; $d++) echo "<th>$d</th>"; ?>
                                    <th>Avg%</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lines = [
                                    ['Forging (KT-F1)',      '#0d6efd', [0,0,0,83,85,87,84,86,85,88,86,85,87,84,86,86,85,88,86,85,87,84,85,85,84,86,85,85,86,84,86]],
                                    ['Pressing (KT-163)',    '#1a7a3a', [0,0,0,81,82,84,82,83,82,86,85,84,86,83,85,85,84,87,85,84,86,83,84,84,83,85,84,84,85,83,85]],
                                    ['Grinding (KT-G3)',     '#6f42c1', [0,0,0,79,80,82,80,81,80,84,82,81,83,80,82,82,81,84,82,81,83,80,81,81,80,82,81,81,82,80,82]],
                                    ['Heat Treatment',       '#fd7e14', [0,0,0,85,87,89,86,88,87,90,88,87,89,86,88,88,87,90,88,87,89,86,87,87,86,88,87,87,88,86,88]],
                                    ['Assembly / Final',     '#dc3545', [0,0,0,88,90,91,89,90,89,92,91,90,92,89,91,91,90,93,91,90,92,89,90,90,89,91,90,90,91,89,91]],
                                ];
                                foreach ($lines as [$name, $color, $vals]) {
                                    $filtered = array_filter($vals);
                                    $avg = count($filtered) > 0 ? round(array_sum($filtered) / count($filtered), 1) : 0;
                                    $status = $avg >= 85
                                        ? '<span class="badge" style="background:'.$color.';">On Target</span>'
                                        : '<span class="badge bg-warning text-dark">Below Target</span>';
                                    echo "<tr>";
                                    echo "<td class='fw-semibold' style='color:$color;'>$name</td>";
                                    foreach ($vals as $v) {
                                        if ($v === 0) { echo "<td class='text-center text-muted'>-</td>"; continue; }
                                        if ($v >= 87) $c = 'text-success fw-bold';
                                        elseif ($v >= 83) $c = 'text-primary';
                                        else $c = 'text-warning fw-semibold';
                                        echo "<td class='text-center $c'>$v</td>";
                                    }
                                    echo "<td class='text-center fw-bold'>$avg</td>";
                                    echo "<td class='text-center'>$status</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ FACTORY SECTION CARDS ═══ -->
        <div class="section-title mt-2">Factory Sections — Go to Process Dashboard</div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">
                    <?php
            $sections = [
                [
                    'name'    => 'Forging Process',
                    'link'    => 'forging.php',
                    'icon'    => 'fa-hammer',
                    'color'   => '#0d6efd',
                    'bg'      => '#cfe2ff',
                    'oee'     => 85.8,
                    'status'  => 'running',
                    'plan'    => 46620,
                    'actual'  => 45800,
                    'machine' => 'L1C630 · KT-F1',
                    'shift'   => 'A: 1,920 / B: 1,880',
                    'img'     => 'komustuL1C630.jpg',
                ],
                [
                    'name'    => 'Pressing Process',
                    'link'    => 'pressing_main.php',
                    'icon'    => 'fa-compress',
                    'color'   => '#1a7a3a',
                    'bg'      => '#d4edda',
                    'oee'     => 84.2,
                    'status'  => 'running',
                    'plan'    => 162960,
                    'actual'  => 160173,
                    'machine' => 'KT-163 · Press',
                    'shift'   => 'A: 3,814 / B: 3,813',
                    'img'     => '',
                ],
                [
                    'name'    => 'Grinding Progressive',
                    'link'    => 'grinding_progressive.php',
                    'icon'    => 'fa-gear',
                    'color'   => '#6f42c1',
                    'bg'      => '#e2d9f3',
                    'oee'     => 81.3,
                    'status'  => 'running',
                    'plan'    => 28000,
                    'actual'  => 27400,
                    'machine' => 'KT-G3 · Progressive',
                    'shift'   => 'A: 1,350 / B: 1,280',
                    'img'     => '',
                ],
                [
                    'name'    => 'Heat Treatment',
                    'link'    => 'heat_treat.php',
                    'icon'    => 'fa-fire',
                    'color'   => '#fd7e14',
                    'bg'      => '#ffe5d0',
                    'oee'     => 87.5,
                    'status'  => 'running',
                    'plan'    => 18000,
                    'actual'  => 17800,
                    'machine' => 'HT Furnace · Line 2',
                    'shift'   => 'A: 920 / B: 910',
                    'img'     => '',
                ],
                [
                    'name'    => 'Human Resources',
                    'link'    => 'assembly.php',
                    'icon'    => 'fa-screwdriver-wrench',
                    'color'   => '#dc3545',
                    'bg'      => '#f8d7da',
                    'oee'     => 90.1,
                    'status'  => 'maintenance',
                    'plan'    => 14000,
                    'actual'  => 13920,
                    'machine' => 'Asm. Line · KT-A1',
                    'shift'   => 'A: 720 / B: 700',
                    'img'     => '',
                ],
            ];

            foreach ($sections as $s) {
                $pct = $s['plan'] > 0 ? round($s['actual'] / $s['plan'] * 100, 1) : 0;
                $oeeColor = $s['oee'] >= 85 ? '#1a7a3a' : ($s['oee'] >= 80 ? '#fd7e14' : '#dc3545');
                $barBg    = $s['oee'] >= 85 ? 'bg-success' : ($s['oee'] >= 80 ? 'bg-warning' : 'bg-danger');
                $statusBadge = $s['status'] === 'running'
                    ? '<span class="status-pill" style="background:#d4edda;color:#1a7a3a;"><i class="fa fa-circle fa-xs me-1"></i>Running</span>'
                    : '<span class="status-pill" style="background:#fff3cd;color:#856404;"><i class="fa fa-wrench fa-xs me-1"></i>Maintenance</span>';
            ?>
            <div class="col">
                <div class="factory-card card">
                    <!-- Thumbnail -->
                    <?php if ($s['img']): ?>
                        <img src="<?= $s['img'] ?>" alt="<?= $s['name'] ?>" class="card-thumb">
                    <?php else: ?>
                        <div class="thumb-placeholder" style="background:<?= $s['color'] ?>;">
                            <i class="fa-solid <?= $s['icon'] ?>"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Body -->
                    <div class="card-footer-custom">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="fw-bold" style="font-size:0.85rem;color:<?= $s['color'] ?>;"><?= $s['name'] ?></div>
                            <?= $statusBadge ?>
                        </div>

                        <div style="font-size:0.68rem;color:#888;"><?= $s['machine'] ?></div>

                        <!-- OEE bar -->
                        <div class="d-flex justify-content-between align-items-center mt-2 mb-1" style="font-size:0.7rem;">
                            <span class="text-muted">OEE</span>
                            <span class="fw-bold" style="color:<?= $oeeColor ?>;"><?= $s['oee'] ?>%</span>
                        </div>
                        <div class="progress oee-mini-bar">
                            <div class="progress-bar <?= $barBg ?>" style="width:<?= $s['oee'] ?>%"></div>
                        </div>

                        <!-- Plan/Actual -->
                        <div class="d-flex justify-content-between mt-2" style="font-size:0.68rem;">
                            <span class="text-muted">Actual / Plan</span>
                            <span class="fw-semibold"><?= number_format($s['actual']) ?> / <?= number_format($s['plan']) ?> <span class="text-muted">(<?= $pct ?>%)</span></span>
                        </div>

                        <!-- Shift -->
                        <div style="font-size:0.67rem;color:#888;margin-top:3px;">Shift <?= $s['shift'] ?></div>

                        <!-- Button -->
                        <a href="<?= $s['link'] ?>" class="btn btn-sm w-100 mt-3 fw-semibold" style="background:<?= $s['color'] ?>;color:white;border:none;">
                            <i class="fa-solid <?= $s['icon'] ?> me-1"></i> Go to <?= $s['name'] ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

        <!-- Footer include -->
        <?php include('footer.php'); ?>

    </div>
    <!-- Container end -->

    <!-- Footer bar -->
    <div class="footer-bar">
        <i class="fa-solid fa-industry me-2"></i>KT Industrial Digitization System &nbsp;|&nbsp; OEE Monitoring Platform &nbsp;|&nbsp;
        <?php echo date('Y'); ?> &copy; KT Production Engineering Dept.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
    // ---- Cumulative Chart ----
    (function() {
        const planPerDay = 7427;
        const dailyAct = [0,0,0,6890,7150,7520,7180,7400,7320,7810,7500,7420,7630,7200,7700,7550,7480,7900,7620,7430,7800,7400,7627,7500,7380,7610,7490,7530,7560,7410,7580];
        let planAcc = [], actAcc = [], cp = 0, ca = 0;
        const days = Array.from({length:31}, (_,i) => i+1);
        for (let i = 0; i < 31; i++) {
            cp += (i >= 3 ? planPerDay : 0);
            ca += dailyAct[i];
            planAcc.push(cp);
            actAcc.push(ca);
        }
        new Chart(document.getElementById('cumulChart'), {
            type: 'line',
            data: {
                labels: days,
                datasets: [
                    { label: 'Plan', data: planAcc, borderColor: '#dc3545', borderWidth: 2, borderDash: [6,3], pointRadius: 0, fill: false, tension: 0.1 },
                    { label: 'Actual', data: actAcc, borderColor: '#0d6efd', borderWidth: 2.5, pointRadius: 2, pointBackgroundColor: '#0d6efd', fill: false, tension: 0.1 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { font: { size: 9 }, maxRotation: 0 }, grid: { display: false } },
                    y: { ticks: { font: { size: 9 }, callback: v => (v/1000).toFixed(0)+'K' }, grid: { color: '#f0f0f0' } }
                }
            }
        });
    })();

    // ---- Daily Bar Chart ----
    (function() {
        const plan = [0,0,0,7427,7427,7427,7427,7427,7427,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617,7617];
        const actual = [0,0,0,6890,7150,7520,7180,7400,7320,7810,7500,7420,7630,7200,7700,7550,7480,7900,7620,7430,7800,7400,7627,7500,7380,7610,7490,7530,7560,7410,7580];
        const colors = actual.map((a,i) => plan[i] > 0 ? (a >= plan[i] ? '#1a7a3a' : '#fd7e14') : 'transparent');
        new Chart(document.getElementById('dailyBarChart'), {
            type: 'bar',
            data: {
                labels: Array.from({length:31}, (_,i) => i+1),
                datasets: [
                    { label: 'Actual', data: actual, backgroundColor: colors, borderWidth: 0, borderRadius: 2 },
                    { label: 'Plan', data: plan, type: 'line', borderColor: '#6c757d', borderWidth: 1.5, borderDash: [4,3], pointRadius: 0, fill: false }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { font: { size: 9 }, maxRotation: 0 }, grid: { display: false } },
                    y: { min: 0, max: 9000, ticks: { font: { size: 9 }, callback: v => (v/1000).toFixed(1)+'K' }, grid: { color: '#f0f0f0' } }
                }
            }
        });
    })();

    // ---- Donut gauges ----
    function gauge(id, val, color) {
        new Chart(document.getElementById(id), {
            type: 'doughnut',
            data: { datasets: [{ data: [val, 100-val], backgroundColor: [color, '#e9ecef'], borderWidth: 0, circumference: 270, rotation: 225 }] },
            options: { responsive: false, cutout: '72%', plugins: { legend: { display: false }, tooltip: { enabled: false } } }
        });
    }
    gauge('g1', 84.2, '#1a7a3a');
    gauge('g2', 91.5, '#fd7e14');
    gauge('g3', 92.0, '#0d6efd');
    </script>

</body>
</html>