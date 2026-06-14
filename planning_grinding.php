<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Planning — KT Factory</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <style>
        :root {
            --kt-green:      #1a7a3a;
            --kt-green-dark: #0f5025;
            --kt-green-lt:   #e8f5e9;
            --kt-yellow:     #ffdd00;
            --kt-orange:     #fd7e14;
            --kt-blue:       #0d6efd;
            --kt-red:        #dc3545;
            --kt-purple:     #6f42c1;
            --bg:            #f0f2f5;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #222;
        }

        /* ── Header ── */
        .top-header {
            background: var(--kt-green);
            color: white;
            padding: 11px 22px;
            border-bottom: 4px solid var(--kt-yellow);
        }
        .top-header h4 { margin: 0; font-weight: 800; letter-spacing: 1px; font-size: 1rem; }
        .kt-badge {
            background: var(--kt-yellow); color: var(--kt-green-dark);
            font-weight: 900; border-radius: 4px; padding: 3px 12px;
        }

        /* ── Nav ── */
        .nav-bar-custom { background: var(--kt-green-dark); padding: 5px 20px; }
        .nav-bar-custom a {
            color: #b5dfc5 !important; font-size: 0.8rem; font-weight: 600;
            padding: 4px 11px; border-radius: 4px; text-decoration: none;
        }
        .nav-bar-custom a:hover, .nav-bar-custom a.active {
            background: var(--kt-green); color: white !important;
        }

        /* ── Page title bar ── */
        .page-title-bar {
            background: white;
            border-radius: 10px;
            padding: 16px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
            border-left: 6px solid var(--kt-green);
            margin-bottom: 16px;
        }
        .page-title-bar h2 { font-size: 1.25rem; font-weight: 800; color: var(--kt-green-dark); margin: 0; }

        /* ── Section title ── */
        .sec-title {
            font-size: 0.66rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 1px; color: var(--kt-green-dark);
            border-left: 4px solid var(--kt-green);
            padding-left: 8px; margin-bottom: 12px;
        }

        /* ── Card ── */
        .panel {
            background: white; border-radius: 10px; padding: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,.07); margin-bottom: 16px;
        }

        /* ── KPI strip ── */
        .kpi-strip { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; }
        .kpi-box {
            flex: 1 1 120px; border-radius: 8px; padding: 12px 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,.09);
            min-width: 110px;
        }
        .kpi-box .lbl { font-size: 0.62rem; text-transform: uppercase; letter-spacing: .7px; opacity: .85; }
        .kpi-box .val { font-size: 1.6rem; font-weight: 800; line-height: 1.1; }
        .kpi-box .sub { font-size: 0.7rem; opacity: .75; margin-top: 2px; }

        /* ── Table styles ── */
        .tbl-plan thead th {
            background: var(--kt-green); color: white;
            font-size: 0.7rem; padding: 7px 8px;
            border: 1px solid #145e2c; white-space: nowrap;
            position: sticky; top: 0; z-index: 2;
        }
        .tbl-plan td {
            font-size: 0.72rem; padding: 5px 8px;
            border: 1px solid #dee2e6; white-space: nowrap;
        }
        .tbl-plan tbody tr:hover td { background: #f0f8f2 !important; }
        .tbl-plan tbody tr:nth-child(even) td { background: #fafafa; }

        .badge-process {
            font-size: 0.65rem; border-radius: 20px; padding: 2px 9px; font-weight: 700;
        }

        /* ── Priority badge ── */
        .pri-high   { background: #f8d7da; color: #842029; }
        .pri-normal { background: #d1ecf1; color: #0c5460; }
        .pri-low    { background: #e2e3e5; color: #383d41; }

        /* ── Status badge ── */
        .st-planned    { background: #cfe2ff; color: #084298; }
        .st-inprog     { background: #d4edda; color: #155724; }
        .st-done       { background: #c3e6cb; color: #155724; }
        .st-onhold     { background: #fff3cd; color: #856404; }

        /* ── Form controls ── */
        .form-control, .form-select {
            font-size: 0.8rem; border-radius: 6px;
            border: 1.5px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--kt-green); box-shadow: 0 0 0 3px rgba(26,122,58,.15);
        }
        label { font-size: 0.75rem; font-weight: 600; color: #444; margin-bottom: 3px; }

        .btn-kt {
            background: var(--kt-green); color: white; border: none;
            font-weight: 700; font-size: 0.8rem; border-radius: 6px;
            padding: 7px 18px;
        }
        .btn-kt:hover { background: var(--kt-green-dark); color: white; }

        .btn-kt-outline {
            background: white; color: var(--kt-green);
            border: 2px solid var(--kt-green);
            font-weight: 700; font-size: 0.8rem; border-radius: 6px;
            padding: 6px 16px;
        }
        .btn-kt-outline:hover { background: var(--kt-green-lt); }

        /* ── Gantt bar ── */
        .gantt-wrap { overflow-x: auto; }
        .gantt-table { border-collapse: collapse; min-width: 900px; width: 100%; }
        .gantt-table th, .gantt-table td { border: 1px solid #e0e0e0; padding: 0; }
        .gantt-table .row-label {
            padding: 6px 10px; font-size: 0.72rem; font-weight: 600;
            background: #f8f9fa; min-width: 160px; white-space: nowrap;
        }
        .gantt-table .day-head {
            text-align: center; font-size: 0.62rem; font-weight: 700;
            background: var(--kt-green); color: white; padding: 5px 2px;
            min-width: 26px;
        }
        .gantt-bar-cell { padding: 3px 1px; }
        .gantt-bar {
            border-radius: 3px; height: 18px; display: flex;
            align-items: center; justify-content: center;
            font-size: 0.58rem; color: white; font-weight: 700;
            white-space: nowrap; overflow: hidden;
        }
        .weekend { background: #f5f5f5; }

        /* ── Progress cell ── */
        .prog-wrap { width: 100%; background: #e9ecef; border-radius: 3px; height: 8px; }
        .prog-fill  { height: 8px; border-radius: 3px; }

        /* ── Tabs ── */
        .nav-tabs .nav-link { font-size: 0.78rem; font-weight: 600; color: #555; border-radius: 6px 6px 0 0; }
        .nav-tabs .nav-link.active { color: var(--kt-green); border-bottom-color: white; }
        .nav-tabs .nav-link:hover { color: var(--kt-green); }

        /* ── Footer ── */
        .footer-bar {
            background: var(--kt-green); color: #b5dfc5;
            text-align: center; font-size: 0.72rem;
            padding: 9px; margin-top: 20px;
        }

        /* ── Leg dot ── */
        .leg-dot { width: 11px; height: 11px; display: inline-block; border-radius: 2px; margin-right: 4px; vertical-align: middle; }

        /* ── Modal ── */
        .modal-header { background: var(--kt-green); color: white; }
        .modal-header .btn-close { filter: invert(1); }
        .modal-title { font-weight: 800; font-size: 0.9rem; }

        @media(max-width:576px) {
            .kpi-box .val { font-size: 1.2rem; }
        }
    </style>
</head>

<body>

<!-- ═══ TOP HEADER ═══ -->
<div class="top-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3">
        <i class="fa-solid fa-calendar-days fa-lg"></i>
        <div>
            <h4 class="mb-0">PRODUCTION PLANNING — KT FACTORY</h4>
            <small class="opacity-75">Monthly Plan · Schedule · Capacity · Work Orders</small>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="kt-badge">KT PLAN</span>
        <span class="text-warning fw-bold ms-1">
            <i class="fa fa-calendar me-1"></i><?php echo date('M Y'); ?>
        </span>
    </div>
</div>

<!-- ═══ NAV ═══ -->
<nav class="nav-bar-custom d-flex gap-1 flex-wrap">
    <a href="index.php"><i class="fa-solid fa-house me-1"></i>Home</a>
    <a href="grinding_progressive.php"><i class="fa-solid fa-gauge-high me-1"></i>OEE Dashboard</a>
    <a href="production_planning.php" class="active"><i class="fa-solid fa-calendar-days me-1"></i>Planning</a>
    <!--none--> <a href="#"><i class="fa-solid fa-hammer me-1"></i>Member</a>
</nav>

<!-- ═══ MAIN ═══ -->
<div class="container-fluid py-3 px-3">

    <?php include('nav.php'); ?>

    <!-- Page title + actions -->
    <div class="page-title-bar d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h2><i class="fa-solid fa-calendar-days me-2" style="color:var(--kt-green);"></i>Production Planning</h2>
            <div class="text-muted mt-1" style="font-size:0.75rem;">
                <i class="fa fa-circle text-success fa-xs me-1"></i>Plan Period:
                <strong><?php echo date('01 M Y'); ?></strong> –
                <strong><?php echo date('t M Y'); ?></strong>
                &nbsp;·&nbsp; Updated: <strong><?php echo date('d M Y H:i'); ?></strong>
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn-kt btn" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                <i class="fa fa-plus me-1"></i>New Work Order
            </button>
            <button class="btn-kt-outline btn" onclick="window.print()">
                <i class="fa fa-print me-1"></i>Print Plan
            </button>
            <button class="btn btn-outline-secondary btn-sm" style="font-size:0.78rem;border-radius:6px;">
                <i class="fa fa-file-excel me-1"></i>Export
            </button>
        </div>
    </div>

    <!-- ═══ KPI STRIP ═══ -->
    <div class="kpi-strip">
        <div class="kpi-box text-white" style="background:var(--kt-green);">
            <div class="lbl">Total Work Orders</div>
            <div class="val">24</div>
            <div class="sub">This month</div>
        </div>
        <div class="kpi-box text-white" style="background:var(--kt-blue);">
            <div class="lbl">In Progress</div>
            <div class="val">9</div>
            <div class="sub">Active lines</div>
        </div>
        <div class="kpi-box text-white" style="background:var(--kt-orange);">
            <div class="lbl">Planned (Not Started)</div>
            <div class="val">11</div>
            <div class="sub">Scheduled ahead</div>
        </div>
        <div class="kpi-box text-white" style="background:#198754;">
            <div class="lbl">Completed</div>
            <div class="val">4</div>
            <div class="sub">Orders done</div>
        </div>
        <div class="kpi-box" style="background:#fff3cd;border-left:4px solid var(--kt-orange);">
            <div class="lbl" style="color:#856404;">On Hold</div>
            <div class="val" style="color:#664d03;">0</div>
            <div class="sub" style="color:#997a00;">Pending review</div>
        </div>
        <div class="kpi-box" style="background:#f8d7da;border-left:4px solid var(--kt-red);">
            <div class="lbl" style="color:#842029;">Late Orders</div>
            <div class="val" style="color:#842029;">0</div>
            <div class="sub" style="color:#a94442;">vs. delivery date</div>
        </div>
        <div class="kpi-box" style="background:#e8f5e9;border-left:4px solid var(--kt-green);">
            <div class="lbl" style="color:var(--kt-green-dark);">Total Plan Qty</div>
            <div class="val" style="color:var(--kt-green);">593K</div>
            <div class="sub" style="color:#555;">pcs this month</div>
        </div>
        <div class="kpi-box" style="background:#e2d9f3;border-left:4px solid var(--kt-purple);">
            <div class="lbl" style="color:var(--kt-purple);">Capacity Used</div>
            <div class="val" style="color:var(--kt-purple);">87%</div>
            <div class="sub" style="color:#555;">of available time</div>
        </div>
    </div>

    <!-- ═══ TABS ═══ -->
    <ul class="nav nav-tabs mb-0" id="planTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-plan"><i class="fa fa-list me-1"></i>Work Orders</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-gantt"><i class="fa fa-bars-progress me-1"></i>Gantt Chart</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-capacity"><i class="fa fa-chart-bar me-1"></i>Capacity Plan</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-parts"><i class="fa fa-boxes-stacked me-1"></i>Part Code Plan</a></li>
    </ul>

    <div class="tab-content">

        <!-- ─── TAB 1: WORK ORDERS ─── -->
        <div class="tab-pane fade show active" id="tab-plan">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <!-- Filter bar -->
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-6 col-md-2">
                        <label>Process Line</label>
                        <select class="form-select" id="filterLine" onchange="filterTable()">
                            <option value="">All Lines</option>
                            <option>Forging</option>
                            <option>Pressing</option>
                            <option>Grinding</option>
                            <option>Heat Treatment</option>
                            <option>Assembly</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label>Status</label>
                        <select class="form-select" id="filterStatus" onchange="filterTable()">
                            <option value="">All Status</option>
                            <option>Planned</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                            <option>On Hold</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label>Priority</label>
                        <select class="form-select" id="filterPri" onchange="filterTable()">
                            <option value="">All</option>
                            <option>High</option>
                            <option>Normal</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label>Search Part / WO</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="e.g. EPC, WO-2605..." onkeyup="filterTable()">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary btn-sm" onclick="clearFilters()" style="font-size:0.78rem;border-radius:6px;padding:7px 14px;">
                            <i class="fa fa-rotate-left me-1"></i>Reset
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive" style="max-height:460px;overflow-y:auto;">
                    <table class="table table-bordered tbl-plan mb-0" id="woTable">
                        <thead>
                            <tr>
                                <th style="width:36px;"><input type="checkbox" id="checkAll" onchange="toggleAll(this)"></th>
                                <th>WO No.</th>
                                <th>Part Code</th>
                                <th>Part Name</th>
                                <th>Process</th>
                                <th>Machine</th>
                                <th class="text-end">Plan Qty</th>
                                <th class="text-end">Actual</th>
                                <th class="text-center">Progress</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Shift</th>
                                <th class="text-center">Priority</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="woBody">
                            <?php
                            $orders = [
                                ['WO-2605-001','EPC','EPC Neck Body','Pressing','KT-163',46620,45800,'2026-05-01','2026-05-31','A+B','High','In Progress'],
                                ['WO-2605-002','D03B','D03B Flange','Pressing','KT-163',28000,28000,'2026-05-01','2026-05-25','A','Normal','Completed'],
                                ['WO-2605-003','PJR','PJR Pajero Body','Pressing','KT-PJR',46620,45950,'2026-05-01','2026-05-31','A+B','High','In Progress'],
                                ['WO-2605-004','MOC-S','MOC-S Side Panel','Pressing','KT-163',18000,17800,'2026-05-03','2026-05-30','B','Normal','In Progress'],
                                ['WO-2605-005','S8XD','S8XD Housing','Pressing','KT-P2',14000,13920,'2026-05-05','2026-05-28','A','Normal','In Progress'],
                                ['WO-2605-006','SK45','SK45 Cover Plate','Pressing','KT-P2',9720,9703,'2026-05-01','2026-05-20','A','Normal','In Progress'],
                                ['WO-2605-007','EPC','EPC Forging Blank','Forging','KT-F1',50000,49200,'2026-05-01','2026-05-31','A+B','High','In Progress'],
                                ['WO-2605-008','D03B','D03B Forging Blank','Forging','KT-F2',30000,30000,'2026-05-01','2026-05-22','A','Normal','Completed'],
                                ['WO-2605-009','PJR','PJR Forging Raw','Forging','KT-F1',50000,49100,'2026-05-01','2026-05-31','B','High','In Progress'],
                                ['WO-2605-010','EPC','EPC Grinding Finish','Grinding','KT-G3',28000,27400,'2026-05-05','2026-05-31','A','Normal','In Progress'],
                                ['WO-2605-011','MOC-S','MOC-S Heat Treat','Heat Treatment','HT-Line2',18000,17800,'2026-05-06','2026-05-30','A','Normal','In Progress'],
                                ['WO-2605-012','S8XD','S8XD Final Assembly','Assembly','KT-A1',14000,13920,'2026-05-10','2026-05-31','A','Normal','In Progress'],
                                ['WO-2605-013','CNH','CNH Special Order','Pressing','KT-163',5000,0,'2026-06-01','2026-06-15','A','High','Planned'],
                                ['WO-2605-014','EPC','EPC Q2 Pre-Plan','Forging','KT-F1',52000,0,'2026-06-01','2026-06-30','A+B','Normal','Planned'],
                                ['WO-2605-015','PJR','PJR Q2 Pre-Plan','Pressing','KT-PJR',48000,0,'2026-06-01','2026-06-30','A+B','Normal','Planned'],
                            ];

                            $processColors = [
                                'Pressing'=>'#1a7a3a','Forging'=>'#0d6efd',
                                'Grinding'=>'#6f42c1','Heat Treatment'=>'#fd7e14','Assembly'=>'#dc3545'
                            ];
                            $priClass = ['High'=>'pri-high','Normal'=>'pri-normal','Low'=>'pri-low'];
                            $stClass  = ['Planned'=>'st-planned','In Progress'=>'st-inprog','Completed'=>'st-done','On Hold'=>'st-onhold'];

                            foreach ($orders as $o) {
                                [$wo,$pcode,$pname,$proc,$mach,$planQty,$actQty,$start,$end,$shift,$pri,$status] = $o;
                                $pct     = $planQty > 0 ? min(100, round($actQty/$planQty*100)) : 0;
                                $barCls  = $pct >= 100 ? 'bg-success' : ($pct >= 70 ? 'bg-primary' : ($pct >= 40 ? 'bg-warning' : 'bg-danger'));
                                $pcol    = $processColors[$proc] ?? '#555';
                                $priCls  = $priClass[$pri]  ?? '';
                                $stCls   = $stClass[$status] ?? '';
                                ?>
                                <tr data-line="<?=$proc?>" data-status="<?=$status?>" data-pri="<?=$pri?>" data-search="<?=strtolower("$wo $pcode $pname $proc $mach")?>">
                                    <td class="text-center"><input type="checkbox" class="row-check"></td>
                                    <td class="fw-bold text-primary"><?=$wo?></td>
                                    <td class="fw-bold"><?=$pcode?></td>
                                    <td><?=$pname?></td>
                                    <td>
                                        <span class="badge-process" style="background:<?=$pcol?>1a;color:<?=$pcol?>;border:1px solid <?=$pcol?>40;">
                                            <?=$proc?>
                                        </span>
                                    </td>
                                    <td><?=$mach?></td>
                                    <td class="text-end fw-semibold"><?=number_format($planQty)?></td>
                                    <td class="text-end fw-semibold <?=$actQty>=$planQty?'text-success':($actQty>0?'text-primary':'text-muted')?>"><?=$actQty>0?number_format($actQty):'-'?></td>
                                    <td style="min-width:80px;">
                                        <div class="prog-wrap"><div class="prog-fill <?=$barCls?>" style="width:<?=$pct?>%;"></div></div>
                                        <div style="font-size:0.63rem;text-align:right;color:#555;margin-top:1px;"><?=$pct?>%</div>
                                    </td>
                                    <td><?=$start?></td>
                                    <td><?=$end?></td>
                                    <td class="text-center"><span class="badge bg-secondary" style="font-size:0.65rem;"><?=$shift?></span></td>
                                    <td class="text-center"><span class="badge-process <?=$priCls?>"><?=$pri?></span></td>
                                    <td class="text-center"><span class="badge-process <?=$stCls?>"><?=$status?></span></td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary" style="font-size:0.65rem;padding:2px 7px;border-radius:4px;" title="Edit" onclick="editOrder('<?=$wo?>')"><i class="fa fa-pen"></i></button>
                                            <button class="btn btn-sm btn-outline-success" style="font-size:0.65rem;padding:2px 7px;border-radius:4px;" title="View"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-sm btn-outline-danger" style="font-size:0.65rem;padding:2px 7px;border-radius:4px;" title="Delete"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Table footer -->
                <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap gap-2">
                    <div style="font-size:0.72rem;color:#666;">
                        Showing <span id="rowCount">15</span> of 15 work orders
                        &nbsp;·&nbsp; Total Plan: <strong>459,960 pcs</strong>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-danger" style="font-size:0.72rem;border-radius:5px;" onclick="deleteSelected()"><i class="fa fa-trash me-1"></i>Delete Selected</button>
                        <button class="btn btn-sm" style="background:var(--kt-green);color:white;font-size:0.72rem;border-radius:5px;border:none;"><i class="fa fa-file-export me-1"></i>Export Selected</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── TAB 2: GANTT CHART ─── -->
        <div class="tab-pane fade" id="tab-gantt">
            <div class="panel" style="border-radius:0 10px 10px 10px;">
                <div class="sec-title">Gantt Chart — Production Schedule May 2026</div>

                <!-- Legend -->
                <div class="d-flex gap-3 mb-3 flex-wrap" style="font-size:0.72rem;">
                    <span><span class="leg-dot" style="background:#1a7a3a;"></span>Pressing</span>
                    <span><span class="leg-dot" style="background:#0d6efd;"></span>Forging</span>
                    <span><span class="leg-dot" style="background:#6f42c1;"></span>Grinding</span>
                    <span><span class="leg-dot" style="background:#fd7e14;"></span>Heat Treatment</span>
                    <span><span class="leg-dot" style="background:#dc3545;"></span>Assembly</span>
                    <span><span class="leg-dot" style="background:#dee2e6;border:1px solid #ccc;"></span>Weekend</span>
                </div>

                <div class="gantt-wrap">
                    <table class="gantt-table">
                        <thead>
                            <tr>
                                <th class="row-label" style="background:var(--kt-green);color:white;font-size:0.7rem;padding:7px 10px;">Work Order / Process</th>
                                <?php
                                $weekends = [2,3,9,10,16,17,23,24,30,31]; // May 2026 Sat/Sun
                                for ($d = 1; $d <= 31; $d++) {
                                    $cls = in_array($d, $weekends) ? ' style="background:#2d6a4f;opacity:.7;"' : '';
                                    echo "<th class='day-head'$cls>$d</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ganttRows = [
                                ['WO-2605-001 · EPC Pressing',    '#1a7a3a', 1,  31],
                                ['WO-2605-003 · PJR Pressing',    '#1a7a3a', 1,  31],
                                ['WO-2605-004 · MOC-S Pressing',  '#1a7a3a', 3,  30],
                                ['WO-2605-005 · S8XD Pressing',   '#1a7a3a', 5,  28],
                                ['WO-2605-006 · SK45 Pressing',   '#1a7a3a', 1,  20],
                                ['WO-2605-007 · EPC Forging',     '#0d6efd', 1,  31],
                                ['WO-2605-008 · D03B Forging',    '#0d6efd', 1,  22],
                                ['WO-2605-009 · PJR Forging',     '#0d6efd', 1,  31],
                                ['WO-2605-010 · EPC Grinding',    '#6f42c1', 5,  31],
                                ['WO-2605-011 · MOC-S Heat Treat','#fd7e14', 6,  30],
                                ['WO-2605-012 · S8XD Assembly',   '#dc3545', 10, 31],
                            ];

                            foreach ($ganttRows as [$label, $color, $s, $e]) {
                                echo "<tr>";
                                echo "<td class='row-label'>$label</td>";
                                for ($d = 1; $d <= 31; $d++) {
                                    $isWE = in_array($d, $weekends);
                                    if ($d == $s && $d <= $e) {
                                        $span = $e - $s + 1;
                                        echo "<td class='gantt-bar-cell' colspan='$span'>";
                                        echo "<div class='gantt-bar' style='background:$color;'>" . ($span > 4 ? $label : '') . "</div>";
                                        echo "</td>";
                                        $d = $e;
                                    } elseif ($d < $s || $d > $e) {
                                        $weBg = $isWE ? ' class="weekend"' : '';
                                        echo "<td$weBg></td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ─── TAB 3: CAPACITY CHART ─── -->
        <div class="tab-pane fade" id="tab-capacity">
            <div class="panel" style="border-radius:0 10px 10px 10px;">
                <div class="row g-3">
                    <div class="col-12 col-lg-7">
                        <div class="sec-title">Capacity Utilization by Process Line — May 2026</div>
                        <div style="position:relative;height:280px;">
                            <canvas id="capacityChart" role="img" aria-label="Capacity utilization bar chart by process line"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="sec-title">Daily Load vs Capacity</div>
                        <div style="position:relative;height:280px;">
                            <canvas id="loadChart" role="img" aria-label="Daily production load vs capacity chart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Capacity table -->
                <div class="sec-title mt-3">Line Capacity Detail</div>
                <div class="table-responsive">
                    <table class="table table-bordered tbl-plan mb-0">
                        <thead>
                            <tr>
                                <th>Process Line</th>
                                <th>Machine</th>
                                <th class="text-end">Available Time (hr/mo)</th>
                                <th class="text-end">Planned Time (hr/mo)</th>
                                <th class="text-end">Utilization %</th>
                                <th class="text-end">Plan Qty / mo</th>
                                <th class="text-end">Max Capacity (pcs)</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $caps = [
                                ['Forging',       'KT-F1 / KT-F2',  460, 400, 87, 100000, 115000],
                                ['Pressing',      'KT-163 / KT-PJR', 460, 420, 91, 162960, 180000],
                                ['Grinding',      'KT-G3',           230, 195, 85,  28000,  33000],
                                ['Heat Treatment','HT-Line2',        230, 190, 83,  18000,  22000],
                                ['Assembly',      'KT-A1',           230, 185, 80,  14000,  17500],
                            ];
                            foreach ($caps as [$name,$mach,$avail,$plan,$util,$planQty,$maxCap]) {
                                $barCls = $util >= 90 ? 'bg-danger' : ($util >= 80 ? 'bg-warning' : 'bg-success');
                                $badge  = $util >= 90
                                    ? '<span class="badge bg-danger">High Load</span>'
                                    : ($util >= 80
                                        ? '<span class="badge bg-warning text-dark">Moderate</span>'
                                        : '<span class="badge bg-success">Normal</span>');
                                echo "<tr>";
                                echo "<td class='fw-semibold'>$name</td>";
                                echo "<td class='text-muted'>$mach</td>";
                                echo "<td class='text-end'>$avail</td>";
                                echo "<td class='text-end'>$plan</td>";
                                echo "<td class='text-end'>";
                                echo "<div class='prog-wrap'><div class='prog-fill $barCls' style='width:{$util}%;'></div></div>";
                                echo "<div style='font-size:0.68rem;text-align:right;font-weight:700;'>$util%</div></td>";
                                echo "<td class='text-end fw-semibold'>".number_format($planQty)."</td>";
                                echo "<td class='text-end'>".number_format($maxCap)."</td>";
                                echo "<td class='text-center'>$badge</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ─── TAB 4: PART CODE PLAN ─── -->
        <div class="tab-pane fade" id="tab-parts">
            <div class="panel" style="border-radius:0 10px 10px 10px;">
                <div class="row g-3">
                    <div class="col-12 col-lg-5">
                        <div class="sec-title">Part Code Monthly Plan vs Actual</div>
                        <div style="position:relative;height:280px;">
                            <canvas id="partPlanChart" role="img" aria-label="Part code plan vs actual chart"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="sec-title">Part Code Detail — May 2026</div>
                        <div class="table-responsive">
                            <table class="table table-bordered tbl-plan mb-0">
                                <thead>
                                    <tr>
                                        <th>Part Code</th>
                                        <th>Customer</th>
                                        <th class="text-end">Order/Mo</th>
                                        <th class="text-end">Actual MTD</th>
                                        <th class="text-end">Balance</th>
                                        <th class="text-end">Delivery Date</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $parts = [
                                        ['EPC',   'Mitsubishi Motors', 46620, 45800, '2026-05-31'],
                                        ['D03B',  'Toyota Thailand',   28000, 28000, '2026-05-25'],
                                        ['PJR',   'Mitsubishi Motors', 46620, 45950, '2026-05-31'],
                                        ['MOC-S', 'Honda Thailand',    18000, 17800, '2026-05-30'],
                                        ['S8XD',  'Isuzu Thailand',    14000, 13920, '2026-05-28'],
                                        ['SK45',  'Honda Thailand',     9720,  9703, '2026-05-20'],
                                        ['CNH',   'Special Export',        0,     0, '2026-06-15'],
                                    ];
                                    foreach ($parts as [$code,$cust,$ord,$act,$ddate]) {
                                        if ($ord === 0) {
                                            echo "<tr><td class='fw-bold'>$code</td><td>$cust</td><td class='text-end text-muted' colspan='3'>Pre-Order Q2</td><td class='text-end text-muted'>$ddate</td><td>-</td><td class='text-center'><span class='badge bg-secondary'>Planned</span></td></tr>";
                                            continue;
                                        }
                                        $bal    = $act - $ord;
                                        $pct    = round($act / $ord * 100, 1);
                                        $balStr = $bal >= 0 ? '+'.number_format($bal) : number_format($bal);
                                        $balCls = $bal >= 0 ? 'text-success' : 'text-danger';
                                        $barCls = $pct >= 100 ? 'bg-success' : ($pct >= 90 ? 'bg-primary' : 'bg-warning');
                                        $badge  = $pct >= 100
                                            ? '<span class="badge bg-success">Complete</span>'
                                            : ($pct >= 90
                                                ? '<span class="badge bg-primary">On Track</span>'
                                                : '<span class="badge bg-warning text-dark">Below</span>');
                                        echo "<tr>";
                                        echo "<td class='fw-bold'>$code</td>";
                                        echo "<td>$cust</td>";
                                        echo "<td class='text-end'>".number_format($ord)."</td>";
                                        echo "<td class='text-end fw-semibold'>".number_format($act)."</td>";
                                        echo "<td class='text-end fw-semibold $balCls'>$balStr</td>";
                                        echo "<td class='text-end'>$ddate</td>";
                                        echo "<td style='min-width:90px;'><div class='prog-wrap'><div class='prog-fill $barCls' style='width:{$pct}%;'></div></div><div style='font-size:0.63rem;text-align:right;'>$pct%</div></td>";
                                        echo "<td class='text-center'>$badge</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-dark">
                                        <td colspan="2" class="fw-bold">TOTAL</td>
                                        <td class="text-end fw-bold">162,960</td>
                                        <td class="text-end fw-bold">161,173</td>
                                        <td class="text-end fw-bold text-warning">-1,787</td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end tab-content -->

    <?php include('footer.php'); ?>

</div><!-- container-fluid -->

<!-- Footer bar -->
<div class="footer-bar">
    <i class="fa-solid fa-industry me-2"></i>KT Industrial Digitization System &nbsp;|&nbsp; Production Planning Module &nbsp;|&nbsp;
    <?php echo date('Y'); ?> &copy; KT Production Engineering Dept.
</div>

<!-- ═══ ADD WORK ORDER MODAL ═══ -->
<div class="modal fade" id="addOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus me-2"></i>New Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>WO Number</label>
                        <input type="text" class="form-control" placeholder="Auto: WO-<?php echo date('Ym'); ?>-XXX" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Part Code *</label>
                        <select class="form-select">
                            <option value="">-- Select --</option>
                            <option>EPC</option><option>D03B</option><option>PJR</option>
                            <option>MOC-S</option><option>S8XD</option><option>SK45</option><option>CNH</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Part Name *</label>
                        <input type="text" class="form-control" placeholder="Part description">
                    </div>
                    <div class="col-md-4">
                        <label>Process Line *</label>
                        <select class="form-select">
                            <option>Pressing</option><option>Forging</option><option>Grinding</option>
                            <option>Heat Treatment</option><option>Assembly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Machine *</label>
                        <select class="form-select">
                            <option>KT-163</option><option>KT-PJR</option><option>KT-P2</option>
                            <option>KT-F1</option><option>KT-F2</option><option>KT-G3</option>
                            <option>HT-Line2</option><option>KT-A1</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Shift</label>
                        <select class="form-select">
                            <option>A</option><option>B</option><option>A+B</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Plan Quantity (pcs) *</label>
                        <input type="number" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-4">
                        <label>Start Date *</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-01'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label>End Date *</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Priority</label>
                        <select class="form-select">
                            <option>Normal</option><option>High</option><option>Low</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Customer</label>
                        <input type="text" class="form-control" placeholder="Customer name">
                    </div>
                    <div class="col-md-4">
                        <label>Delivery Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="2" placeholder="Notes, special instructions..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button class="btn-kt btn" onclick="saveOrder()"><i class="fa fa-save me-1"></i>Save Work Order</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
// ── Filter table ──
function filterTable() {
    const line   = document.getElementById('filterLine').value.toLowerCase();
    const status = document.getElementById('filterStatus').value.toLowerCase();
    const pri    = document.getElementById('filterPri').value.toLowerCase();
    const search = document.getElementById('searchInput').value.toLowerCase();
    const rows   = document.querySelectorAll('#woBody tr');
    let shown = 0;
    rows.forEach(r => {
        const rl = r.dataset.line?.toLowerCase()   || '';
        const rs = r.dataset.status?.toLowerCase() || '';
        const rp = r.dataset.pri?.toLowerCase()    || '';
        const rt = r.dataset.search?.toLowerCase() || '';
        const ok = (!line   || rl.includes(line))
                && (!status || rs.includes(status))
                && (!pri    || rp.includes(pri))
                && (!search || rt.includes(search));
        r.style.display = ok ? '' : 'none';
        if (ok) shown++;
    });
    document.getElementById('rowCount').textContent = shown;
}

function clearFilters() {
    ['filterLine','filterStatus','filterPri'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('searchInput').value = '';
    filterTable();
}

function toggleAll(cb) {
    document.querySelectorAll('.row-check').forEach(c => c.checked = cb.checked);
}

function deleteSelected() {
    const rows = document.querySelectorAll('.row-check:checked');
    if (!rows.length) { alert('No rows selected.'); return; }
    if (confirm(`Delete ${rows.length} selected work order(s)?`)) {
        rows.forEach(c => c.closest('tr').remove());
        filterTable();
    }
}

function editOrder(wo) {
    alert('Edit: ' + wo + '\n(Connect to your PHP backend to load form data)');
}

function saveOrder() {
    alert('Work order saved!\n(Connect to your PHP/MySQL backend to persist data)');
    bootstrap.Modal.getInstance(document.getElementById('addOrderModal')).hide();
}

// ── Capacity Bar Chart ──
new Chart(document.getElementById('capacityChart'), {
    type: 'bar',
    data: {
        labels: ['Forging','Pressing','Grinding','Heat Treat','Assembly'],
        datasets: [
            { label: 'Utilization %', data: [87, 91, 85, 83, 80],
              backgroundColor: ['#0d6efd','#1a7a3a','#6f42c1','#fd7e14','#dc3545'],
              borderRadius: 5, borderWidth: 0 }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 10 } } },
            y: { min: 0, max: 100, ticks: { font: { size: 10 }, callback: v => v + '%' },
                 grid: { color: '#f0f0f0' } }
        }
    }
});

// ── Load vs Capacity Line Chart ──
(function() {
    const days = Array.from({length:31}, (_,i) => i+1);
    const load = [0,0,0,88,85,89,87,84,86,91,88,87,90,85,88,89,87,92,89,86,90,85,87,88,84,87,86,87,88,85,87];
    const cap  = Array(31).fill(95);
    new Chart(document.getElementById('loadChart'), {
        type: 'line',
        data: {
            labels: days,
            datasets: [
                { label: 'Daily Load %', data: load, borderColor: '#1a7a3a', backgroundColor: 'rgba(26,122,58,.1)', borderWidth: 2, pointRadius: 2, fill: true, tension: 0.3 },
                { label: 'Capacity Limit', data: cap, borderColor: '#dc3545', borderWidth: 1.5, borderDash: [6,3], pointRadius: 0, fill: false }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { labels: { font: { size: 10 } } } },
            scales: {
                x: { ticks: { font: { size: 9 }, maxRotation: 0 }, grid: { display: false } },
                y: { min: 0, max: 100, ticks: { font: { size: 9 }, callback: v => v + '%' }, grid: { color: '#f0f0f0' } }
            }
        }
    });
})();

// ── Part Code Plan Chart ──
new Chart(document.getElementById('partPlanChart'), {
    type: 'bar',
    data: {
        labels: ['EPC','D03B','PJR','MOC-S','S8XD','SK45'],
        datasets: [
            { label: 'Plan', data: [46620,28000,46620,18000,14000,9720],
              backgroundColor: '#adb5bd', borderRadius: 3 },
            { label: 'Actual', data: [45800,28000,45950,17800,13920,9703],
              backgroundColor: '#1a7a3a', borderRadius: 3 }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { labels: { font: { size: 10 } } } },
        scales: {
            x: { ticks: { font: { size: 10 } }, grid: { display: false } },
            y: { ticks: { font: { size: 9 }, callback: v => (v/1000).toFixed(0)+'K' }, grid: { color: '#f0f0f0' } }
        }
    }
});
</script>

</body>
</html>