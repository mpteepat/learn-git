<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Management — KT Factory</title>

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
            --kt-teal:       #0dcaf0;
            --bg:            #f0f2f5;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px; color: #222;
        }

        /* ── Header ── */
        .top-header { background: var(--kt-green); color: white; padding: 11px 22px; border-bottom: 4px solid var(--kt-yellow); }
        .top-header h4 { margin: 0; font-weight: 800; letter-spacing: 1px; font-size: 1rem; }
        .kt-badge { background: var(--kt-yellow); color: var(--kt-green-dark); font-weight: 900; border-radius: 4px; padding: 3px 12px; }

        /* ── Nav ── */
        .nav-bar-custom { background: var(--kt-green-dark); padding: 5px 20px; }
        .nav-bar-custom a { color: #b5dfc5 !important; font-size: 0.8rem; font-weight: 600; padding: 4px 11px; border-radius: 4px; text-decoration: none; }
        .nav-bar-custom a:hover, .nav-bar-custom a.active { background: var(--kt-green); color: white !important; }

        /* ── Page title ── */
        .page-title-bar { background: white; border-radius: 10px; padding: 16px 20px; box-shadow: 0 2px 8px rgba(0,0,0,.07); border-left: 6px solid var(--kt-green); margin-bottom: 16px; }
        .page-title-bar h2 { font-size: 1.25rem; font-weight: 800; color: var(--kt-green-dark); margin: 0; }

        /* ── Section title ── */
        .sec-title { font-size: 0.66rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--kt-green-dark); border-left: 4px solid var(--kt-green); padding-left: 8px; margin-bottom: 12px; }

        /* ── Panel ── */
        .panel { background: white; border-radius: 10px; padding: 16px; box-shadow: 0 2px 8px rgba(0,0,0,.07); margin-bottom: 16px; }

        /* ── KPI ── */
        .kpi-strip { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; }
        .kpi-box { flex: 1 1 120px; border-radius: 8px; padding: 12px 14px; box-shadow: 0 2px 6px rgba(0,0,0,.09); min-width: 110px; }
        .kpi-box .lbl { font-size: 0.62rem; text-transform: uppercase; letter-spacing: .7px; opacity: .85; }
        .kpi-box .val { font-size: 1.6rem; font-weight: 800; line-height: 1.1; }
        .kpi-box .sub { font-size: 0.7rem; opacity: .75; margin-top: 2px; }

        /* ── Table ── */
        .tbl-hr thead th { background: var(--kt-green); color: white; font-size: 0.7rem; padding: 7px 8px; border: 1px solid #145e2c; white-space: nowrap; position: sticky; top: 0; z-index: 2; }
        .tbl-hr td { font-size: 0.72rem; padding: 5px 8px; border: 1px solid #dee2e6; white-space: nowrap; vertical-align: middle; }
        .tbl-hr tbody tr:hover td { background: #f0f8f2 !important; }
        .tbl-hr tbody tr:nth-child(even) td { background: #fafafa; }

        /* ── Avatar ── */
        .avatar { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; color: white; flex-shrink: 0; }

        /* ── Status / dept badges ── */
        .badge-pill { font-size: 0.62rem; border-radius: 20px; padding: 2px 9px; font-weight: 700; }
        .st-active   { background: #d4edda; color: #155724; }
        .st-leave    { background: #fff3cd; color: #856404; }
        .st-absent   { background: #f8d7da; color: #842029; }
        .st-resigned { background: #e2e3e5; color: #383d41; }

        /* ── Shift schedule grid ── */
        .shift-grid { display: grid; grid-template-columns: 160px repeat(31, minmax(22px, 1fr)); border: 1px solid #dee2e6; border-radius: 6px; overflow: hidden; }
        .sg-head { background: var(--kt-green); color: white; font-size: 0.6rem; font-weight: 700; padding: 5px 3px; text-align: center; border-right: 1px solid #145e2c; }
        .sg-name { background: #f8f9fa; font-size: 0.68rem; font-weight: 600; padding: 5px 8px; border-right: 1px solid #dee2e6; border-top: 1px solid #dee2e6; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sg-cell { font-size: 0.6rem; font-weight: 700; text-align: center; padding: 3px 1px; border-right: 1px solid #e9ecef; border-top: 1px solid #e9ecef; }
        .sg-a    { background: #d4edda; color: #155724; }
        .sg-b    { background: #cfe2ff; color: #084298; }
        .sg-off  { background: #f8d7da; color: #842029; }
        .sg-vac  { background: #fff3cd; color: #856404; }
        .sg-hol  { background: #e9ecef; color: #6c757d; }

        /* ── Form ── */
        .form-control, .form-select { font-size: 0.8rem; border-radius: 6px; border: 1.5px solid #ced4da; }
        .form-control:focus, .form-select:focus { border-color: var(--kt-green); box-shadow: 0 0 0 3px rgba(26,122,58,.15); }
        label { font-size: 0.75rem; font-weight: 600; color: #444; margin-bottom: 3px; }

        .btn-kt { background: var(--kt-green); color: white; border: none; font-weight: 700; font-size: 0.8rem; border-radius: 6px; padding: 7px 18px; }
        .btn-kt:hover { background: var(--kt-green-dark); color: white; }
        .btn-kt-outline { background: white; color: var(--kt-green); border: 2px solid var(--kt-green); font-weight: 700; font-size: 0.8rem; border-radius: 6px; padding: 6px 16px; }
        .btn-kt-outline:hover { background: var(--kt-green-lt); }

        /* ── Attendance calendar ── */
        .att-legend { display: flex; gap: 12px; flex-wrap: wrap; font-size: 0.7rem; margin-bottom: 10px; }
        .att-dot { width: 12px; height: 12px; border-radius: 3px; display: inline-block; margin-right: 4px; vertical-align: middle; }

        /* ── Tabs ── */
        .nav-tabs .nav-link { font-size: 0.78rem; font-weight: 600; color: #555; border-radius: 6px 6px 0 0; }
        .nav-tabs .nav-link.active { color: var(--kt-green); border-bottom-color: white; }
        .nav-tabs .nav-link:hover { color: var(--kt-green); }

        /* ── Modal ── */
        .modal-header { background: var(--kt-green); color: white; }
        .modal-header .btn-close { filter: invert(1); }
        .modal-title { font-weight: 800; font-size: 0.9rem; }

        /* ── Progress ── */
        .prog-wrap { width: 100%; background: #e9ecef; border-radius: 3px; height: 7px; }
        .prog-fill  { height: 7px; border-radius: 3px; }

        /* ── Leg dot ── */
        .leg-dot { width: 11px; height: 11px; display: inline-block; border-radius: 2px; margin-right: 4px; vertical-align: middle; }

        /* ── Footer ── */
        .footer-bar { background: var(--kt-green); color: #b5dfc5; text-align: center; font-size: 0.72rem; padding: 9px; margin-top: 20px; }

        @media(max-width:576px) { .kpi-box .val { font-size: 1.2rem; } }
    </style>
</head>

<body>

<!-- ═══ TOP HEADER ═══ -->
<div class="top-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3">
        <i class="fa-solid fa-users fa-lg"></i>
        <div>
            <h4 class="mb-0">HR MANAGEMENT — KT FACTORY</h4>
            <small class="opacity-75">Employee · Attendance · Shift · Payroll · Leave Management</small>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="kt-badge">KT HR</span>
        <span class="text-warning fw-bold ms-1">
            <i class="fa fa-calendar me-1"></i><?php echo date('M Y'); ?>
        </span>
    </div>
</div>

<!-- ═══ NAV ═══ -->
<nav class="nav-bar-custom d-flex gap-1 flex-wrap">
    <a href="index.php"><i class="fa-solid fa-house me-1"></i>Home</a>
    <a href="hr.php"><i class="fa-solid fa-gauge-high me-1"></i>OEE Dashboard</a>
    <a href="production_planning.php"><i class="fa-solid fa-calendar-days me-1"></i>Planning</a>
    <a href="hr_management.php" class="active"><i class="fa-solid fa-users me-1"></i>HR</a>
    <a href="forgmain.php"><i class="fa-solid fa-hammer me-1"></i>Forging</a>
    <a href="pressing_main.php"><i class="fa-solid fa-compress me-1"></i>Pressing</a>
    <a href="grinding_progressive.php"><i class="fa-solid fa-gear me-1"></i>Grinding</a>
    <a href="report.php"><i class="fa-solid fa-file-chart-column me-1"></i>Reports</a>
</nav>

<!-- ═══ MAIN ═══ -->
<div class="container-fluid py-3 px-3">

    <?php include('nav.php'); ?>

    <!-- Page title -->
    <div class="page-title-bar d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h2><i class="fa-solid fa-users me-2" style="color:var(--kt-green);"></i>HR Management</h2>
            <div class="text-muted mt-1" style="font-size:0.75rem;">
                <i class="fa fa-circle text-success fa-xs me-1"></i>
                Period: <strong><?php echo date('01 M Y'); ?></strong> – <strong><?php echo date('t M Y'); ?></strong>
                &nbsp;·&nbsp; Updated: <strong><?php echo date('d M Y H:i'); ?></strong>
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn-kt btn" data-bs-toggle="modal" data-bs-target="#addEmpModal">
                <i class="fa fa-user-plus me-1"></i>Add Employee
            </button>
            <button class="btn-kt-outline btn" data-bs-toggle="modal" data-bs-target="#leaveModal">
                <i class="fa fa-calendar-minus me-1"></i>Leave Request
            </button>
            <button class="btn btn-outline-secondary btn-sm" style="font-size:0.78rem;border-radius:6px;" onclick="window.print()">
                <i class="fa fa-print me-1"></i>Print
            </button>
        </div>
    </div>

    <!-- ═══ KPI STRIP ═══ -->
    <div class="kpi-strip">
        <div class="kpi-box text-white" style="background:var(--kt-green);">
            <div class="lbl">Total Employees</div>
            <div class="val">148</div>
            <div class="sub">All departments</div>
        </div>
        <div class="kpi-box text-white" style="background:#198754;">
            <div class="lbl">Present Today</div>
            <div class="val">132</div>
            <div class="sub">89.2% attendance</div>
        </div>
        <div class="kpi-box" style="background:#fff3cd;border-left:4px solid var(--kt-orange);">
            <div class="lbl" style="color:#856404;">On Leave</div>
            <div class="val" style="color:#664d03;">11</div>
            <div class="sub" style="color:#997a00;">Approved leave</div>
        </div>
        <div class="kpi-box" style="background:#f8d7da;border-left:4px solid var(--kt-red);">
            <div class="lbl" style="color:#842029;">Absent</div>
            <div class="val" style="color:#842029;">5</div>
            <div class="sub" style="color:#a94442;">No notice</div>
        </div>
        <div class="kpi-box text-white" style="background:var(--kt-blue);">
            <div class="lbl">Shift A Now</div>
            <div class="val">68</div>
            <div class="sub">Active on floor</div>
        </div>
        <div class="kpi-box text-white" style="background:var(--kt-purple);">
            <div class="lbl">Shift B Now</div>
            <div class="val">64</div>
            <div class="sub">Active on floor</div>
        </div>
        <div class="kpi-box" style="background:#e8f5e9;border-left:4px solid var(--kt-green);">
            <div class="lbl" style="color:var(--kt-green-dark);">Overtime Hours</div>
            <div class="val" style="color:var(--kt-green);">324</div>
            <div class="sub" style="color:#555;">hrs this month</div>
        </div>
        <div class="kpi-box" style="background:#e2d9f3;border-left:4px solid var(--kt-purple);">
            <div class="lbl" style="color:var(--kt-purple);">Leave Pending</div>
            <div class="val" style="color:var(--kt-purple);">7</div>
            <div class="sub" style="color:#555;">Awaiting approval</div>
        </div>
    </div>

    <!-- ═══ TABS ═══ -->
    <ul class="nav nav-tabs mb-0" id="hrTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-employees"><i class="fa fa-id-card me-1"></i>Employees</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-attendance"><i class="fa fa-clock me-1"></i>Attendance</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-shift"><i class="fa fa-calendar-week me-1"></i>Shift Schedule</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-leave"><i class="fa fa-calendar-minus me-1"></i>Leave</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-payroll"><i class="fa fa-money-bill-wave me-1"></i>Payroll</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-report"><i class="fa fa-chart-pie me-1"></i>HR Report</a></li>
    </ul>

    <div class="tab-content">

        <!-- ─── TAB 1: EMPLOYEES ─── -->
        <div class="tab-pane fade show active" id="tab-employees">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <!-- Filter -->
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-6 col-md-2">
                        <label>Department</label>
                        <select class="form-select" id="filterDept" onchange="filterEmp()">
                            <option value="">All</option>
                            <option>Forging</option><option>Pressing</option><option>Grinding</option>
                            <option>Heat Treatment</option><option>Assembly</option><option>QC</option>
                            <option>Maintenance</option><option>HR</option><option>Management</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label>Status</label>
                        <select class="form-select" id="filterEmpStatus" onchange="filterEmp()">
                            <option value="">All</option>
                            <option>Active</option><option>On Leave</option><option>Absent</option><option>Resigned</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label>Shift</label>
                        <select class="form-select" id="filterShift" onchange="filterEmp()">
                            <option value="">All</option><option>A</option><option>B</option><option>Office</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label>Search Name / ID</label>
                        <input type="text" class="form-control" id="empSearch" placeholder="e.g. Somchai, EMP-001..." onkeyup="filterEmp()">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary btn-sm" style="font-size:0.78rem;border-radius:6px;padding:7px 14px;" onclick="clearEmpFilter()">
                            <i class="fa fa-rotate-left me-1"></i>Reset
                        </button>
                    </div>
                </div>

                <div class="table-responsive" style="max-height:460px;overflow-y:auto;">
                    <table class="table table-bordered tbl-hr mb-0" id="empTable">
                        <thead>
                            <tr>
                                <th style="width:36px;"><input type="checkbox" id="empCheckAll" onchange="toggleEmpAll(this)"></th>
                                <th>Emp. ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Shift</th>
                                <th>Start Date</th>
                                <th class="text-end">Salary (THB)</th>
                                <th class="text-center">Leave Balance</th>
                                <th class="text-end">OT hrs/mo</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="empBody">
                        <?php
                        $deptColors = [
                            'Forging'=>'#0d6efd','Pressing'=>'#1a7a3a','Grinding'=>'#6f42c1',
                            'Heat Treatment'=>'#fd7e14','Assembly'=>'#dc3545',
                            'QC'=>'#0dcaf0','Maintenance'=>'#6c757d','HR'=>'#d63384','Management'=>'#212529'
                        ];
                        $avatarColors = ['#1a7a3a','#0d6efd','#6f42c1','#fd7e14','#dc3545','#0dcaf0','#198754','#d63384','#6c757d'];

                        $employees = [
                            ['EMP-001','Somchai Jaidee',     'Production Leader','Pressing',       'A','2018-03-01',22000, 8,'Active'],
                            ['EMP-002','Nattapon Sriwong',   'Machine Operator', 'Forging',        'A','2019-06-15',16500,12,'Active'],
                            ['EMP-003','Wanida Chaiwong',    'QC Inspector',     'QC',             'B','2020-01-10',18000, 6,'Active'],
                            ['EMP-004','Prasert Nakpan',     'Maintenance Tech', 'Maintenance',    'A','2017-09-20',20000, 4,'Active'],
                            ['EMP-005','Sunisa Promtep',     'HR Officer',       'HR',          'Office','2021-04-05',19500, 0,'Active'],
                            ['EMP-006','Kittipong Araya',    'Machine Operator', 'Pressing',       'B','2022-07-01',15500,18,'Active'],
                            ['EMP-007','Malee Somboon',      'Production Leader','Grinding',       'A','2016-11-15',23000, 9,'Active'],
                            ['EMP-008','Theerawat Boonma',   'Machine Operator', 'Heat Treatment', 'B','2020-08-20',16000,14,'On Leave'],
                            ['EMP-009','Patcharee Nuanjun',  'QC Supervisor',    'QC',          'Office','2015-02-28',26000, 2,'Active'],
                            ['EMP-010','Chaiyasit Wongdee',  'Machine Operator', 'Assembly',       'A','2023-03-12',15000,10,'Active'],
                            ['EMP-011','Ratchanee Sangkhom', 'Production Leader','Forging',        'B','2019-05-07',22500,11,'Active'],
                            ['EMP-012','Piyawat Tonglam',    'Machine Operator', 'Pressing',       'A','2021-10-01',15500,16,'Absent'],
                            ['EMP-013','Sumalee Chairat',    'HR Manager',       'HR',          'Office','2013-06-01',38000, 0,'Active'],
                            ['EMP-014','Natthawut Kumjing',  'Maintenance Tech', 'Maintenance',    'B','2018-12-10',20000, 7,'Active'],
                            ['EMP-015','Jintana Petcharat',  'QC Inspector',     'QC',             'A','2022-02-14',17500, 5,'On Leave'],
                            ['EMP-016','Sombat Klinkaew',    'Plant Manager',    'Management', 'Office','2011-01-15',65000, 0,'Active'],
                            ['EMP-017','Apinya Khamtong',    'Machine Operator', 'Grinding',       'B','2023-08-01',15000,13,'Active'],
                            ['EMP-018','Thanakorn Rattana',  'Machine Operator', 'Assembly',       'B','2022-11-20',15000, 9,'Active'],
                        ];

                        $stClass = ['Active'=>'st-active','On Leave'=>'st-leave','Absent'=>'st-absent','Resigned'=>'st-resigned'];

                        foreach ($employees as $i => $e) {
                            [$id,$name,$pos,$dept,$shift,$start,$sal,$otHr,$status] = $e;
                            $initials = implode('', array_map(fn($w) => strtoupper($w[0]), array_slice(explode(' ',$name),0,2)));
                            $avColor  = $avatarColors[$i % count($avatarColors)];
                            $dColor   = $deptColors[$dept] ?? '#555';
                            $stCls    = $stClass[$status] ?? '';
                            $leavebal = rand(5,15);
                            ?>
                            <tr data-dept="<?=$dept?>" data-status="<?=$status?>" data-shift="<?=$shift?>"
                                data-search="<?=strtolower("$id $name $pos $dept")?>">
                                <td class="text-center"><input type="checkbox" class="emp-check"></td>
                                <td class="fw-bold text-primary"><?=$id?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar" style="background:<?=$avColor?>;"><?=$initials?></div>
                                        <div>
                                            <div class="fw-semibold" style="font-size:0.78rem;"><?=$name?></div>
                                            <div class="text-muted" style="font-size:0.65rem;"><?=$pos?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$pos?></td>
                                <td><span class="badge-pill" style="background:<?=$dColor?>1a;color:<?=$dColor?>;border:1px solid <?=$dColor?>40;"><?=$dept?></span></td>
                                <td class="text-center">
                                    <span class="badge <?=$shift==='A'?'bg-success':($shift==='B'?'bg-primary':'bg-secondary')?>" style="font-size:0.65rem;"><?=$shift?></span>
                                </td>
                                <td><?=$start?></td>
                                <td class="text-end fw-semibold"><?=number_format($sal)?></td>
                                <td class="text-center">
                                    <span class="fw-bold <?=$leavebal<=3?'text-danger':($leavebal<=7?'text-warning':'text-success')?>"><?=$leavebal?></span>
                                    <span class="text-muted"> days</span>
                                </td>
                                <td class="text-end"><?=$otHr?> hr</td>
                                <td class="text-center"><span class="badge-pill <?=$stCls?>"><?=$status?></span></td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button class="btn btn-sm btn-outline-primary" style="font-size:0.62rem;padding:2px 6px;border-radius:4px;" title="Edit"><i class="fa fa-pen"></i></button>
                                        <button class="btn btn-sm btn-outline-success" style="font-size:0.62rem;padding:2px 6px;border-radius:4px;" title="Profile"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-warning" style="font-size:0.62rem;padding:2px 6px;border-radius:4px;" title="Leave"><i class="fa fa-calendar-minus"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap gap-2">
                    <div style="font-size:0.72rem;color:#666;">Showing <span id="empCount">18</span> of 148 employees &nbsp;·&nbsp; Page 1 of 9</div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm" style="background:var(--kt-green);color:white;font-size:0.72rem;border-radius:5px;border:none;"><i class="fa fa-file-export me-1"></i>Export</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── TAB 2: ATTENDANCE ─── -->
        <div class="tab-pane fade" id="tab-attendance">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="sec-title mb-0">Daily Attendance — <?php echo date('F Y'); ?></div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width:auto;font-size:0.78rem;">
                            <option>All Departments</option>
                            <option>Forging</option><option>Pressing</option><option>QC</option>
                        </select>
                        <button class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;border-radius:6px;"><i class="fa fa-download me-1"></i>Export</button>
                    </div>
                </div>

                <!-- Legend -->
                <div class="att-legend mb-2">
                    <span><span class="att-dot" style="background:#d4edda;"></span>Present</span>
                    <span><span class="att-dot" style="background:#fff3cd;"></span>Leave</span>
                    <span><span class="att-dot" style="background:#f8d7da;"></span>Absent</span>
                    <span><span class="att-dot" style="background:#e9ecef;"></span>Holiday</span>
                    <span><span class="att-dot" style="background:#cfe2ff;"></span>OT</span>
                </div>

                <div class="table-responsive" style="max-height:450px;overflow:auto;">
                    <table class="table table-bordered tbl-hr mb-0">
                        <thead>
                            <tr>
                                <th style="min-width:140px;">Employee</th>
                                <?php
                                $weekends = [2,3,9,10,16,17,23,24,30,31];
                                for ($d=1; $d<=31; $d++) {
                                    $we = in_array($d,$weekends) ? ' style="background:#2d6a4f;opacity:.7;"' : '';
                                    echo "<th class='text-center' style='min-width:24px;padding:4px 2px;'$we>$d</th>";
                                }
                                echo "<th class='text-end'>Present</th><th class='text-end'>Absent</th><th class='text-end'>OT hr</th>";
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $attNames = [
                            'Somchai J.','Nattapon S.','Wanida C.','Prasert N.','Kittipong A.',
                            'Malee S.','Theerawat B.','Chaiyasit W.','Ratchanee S.','Piyawat T.'
                        ];
                        foreach ($attNames as $n) {
                            $p = 0; $ab = 0; $ot = 0;
                            echo "<tr><td class='fw-semibold' style='min-width:140px;'>$n</td>";
                            for ($d=1;$d<=31;$d++) {
                                if (in_array($d,$weekends)) { echo "<td class='text-center' style='background:#f0f0f0;font-size:0.6rem;color:#aaa;'>-</td>"; continue; }
                                $r = rand(1,10);
                                if ($r <= 7)      { $cls='bg-success'; $lbl='P'; $p++; }
                                elseif ($r == 8)  { $cls='bg-warning text-dark'; $lbl='L'; }
                                elseif ($r == 9)  { $cls='bg-danger'; $lbl='A'; $ab++; }
                                else               { $cls='bg-primary'; $lbl='OT'; $ot += 2; $p++; }
                                echo "<td class='text-center $cls' style='font-size:0.55rem;padding:3px 1px;color:white;'>$lbl</td>";
                            }
                            echo "<td class='text-end fw-bold text-success'>$p</td>";
                            echo "<td class='text-end fw-bold text-danger'>$ab</td>";
                            echo "<td class='text-end'>$ot</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- Attendance summary chart -->
                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-6">
                        <div class="sec-title">Attendance Rate Trend — This Month</div>
                        <div style="position:relative;height:180px;">
                            <canvas id="attTrendChart" role="img" aria-label="Attendance rate trend chart for the month"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="sec-title">Absence by Department</div>
                        <div style="position:relative;height:180px;">
                            <canvas id="absDeptChart" role="img" aria-label="Absence count by department chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── TAB 3: SHIFT SCHEDULE ─── -->
        <div class="tab-pane fade" id="tab-shift">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                    <div class="sec-title mb-0">Shift Schedule — <?php echo date('F Y'); ?></div>
                    <div class="d-flex gap-2 flex-wrap">
                        <div class="att-legend mb-0">
                            <span><span class="att-dot" style="background:#d4edda;border:1px solid #155724;"></span>Shift A (Day)</span>
                            <span><span class="att-dot" style="background:#cfe2ff;border:1px solid #084298;"></span>Shift B (Night)</span>
                            <span><span class="att-dot" style="background:#f8d7da;border:1px solid #842029;"></span>Off</span>
                            <span><span class="att-dot" style="background:#fff3cd;border:1px solid #856404;"></span>Leave</span>
                            <span><span class="att-dot" style="background:#e9ecef;"></span>Holiday</span>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;border-radius:6px;"><i class="fa fa-edit me-1"></i>Edit Schedule</button>
                    </div>
                </div>

                <!-- Shift info strip -->
                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <div class="rounded px-3 py-2 d-flex gap-3" style="background:#e8f5e9;border:1px solid #a3d9b1;font-size:0.75rem;">
                            <div><span class="fw-bold text-success">Shift A (Day):</span> 06:00 – 18:00 · 12 hr</div>
                            <div>|</div>
                            <div><span class="fw-bold text-primary">Shift B (Night):</span> 18:00 – 06:00 · 12 hr</div>
                            <div>|</div>
                            <div><span class="fw-bold text-muted">Break:</span> 30 min × 2</div>
                        </div>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <div class="shift-grid">
                        <!-- Header row -->
                        <div class="sg-head" style="text-align:left;padding-left:10px;">Employee</div>
                        <?php
                        for ($d=1;$d<=31;$d++) {
                            $we = in_array($d,$weekends) ? ' style="background:#2d6a4f;"' : '';
                            echo "<div class='sg-head'$we>$d</div>";
                        }
                        ?>

                        <?php
                        $shiftEmps = [
                            'Somchai J. · Pressing','Nattapon S. · Forging','Kittipong A. · Pressing',
                            'Malee S. · Grinding','Ratchanee S. · Forging','Piyawat T. · Pressing',
                            'Theerawat B. · HT','Chaiyasit W. · Assembly','Apinya K. · Grinding','Thanakorn R. · Assembly'
                        ];
                        foreach ($shiftEmps as $emp) {
                            echo "<div class='sg-name'>$emp</div>";
                            for ($d=1;$d<=31;$d++) {
                                if (in_array($d,$weekends)) { echo "<div class='sg-cell sg-hol'>H</div>"; continue; }
                                $r = rand(1,12);
                                if ($r <= 5)      { echo "<div class='sg-cell sg-a'>A</div>"; }
                                elseif ($r <= 10) { echo "<div class='sg-cell sg-b'>B</div>"; }
                                elseif ($r == 11) { echo "<div class='sg-cell sg-vac'>V</div>"; }
                                else               { echo "<div class='sg-cell sg-off'>-</div>"; }
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- Shift summary -->
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-5">
                        <div class="sec-title">Headcount by Shift — Today</div>
                        <div style="position:relative;height:180px;">
                            <canvas id="shiftChart" role="img" aria-label="Headcount by shift and department today"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="sec-title">Shift Summary Table</div>
                        <table class="table table-bordered tbl-hr mb-0">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th class="text-end">Shift A</th>
                                    <th class="text-end">Shift B</th>
                                    <th class="text-end">Office</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Coverage</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $shiftSummary = [
                                ['Forging',        18, 16, 1, 35],
                                ['Pressing',       22, 20, 1, 43],
                                ['Grinding',        8,  7, 0, 15],
                                ['Heat Treatment',  5,  5, 0, 10],
                                ['Assembly',        7,  6, 0, 13],
                                ['QC',              5,  4, 2, 11],
                                ['Maintenance',     2,  2, 0,  4],
                                ['HR / Admin',      0,  0, 5,  5],
                                ['Management',      1,  0, 7,  8],
                            ];
                            foreach ($shiftSummary as [$dept,$sa,$sb,$off,$tot]) {
                                $pct = round(($sa+$sb+$off) / max($tot,1) * 100);
                                echo "<tr><td class='fw-semibold'>$dept</td>";
                                echo "<td class='text-end text-success fw-semibold'>$sa</td>";
                                echo "<td class='text-end text-primary fw-semibold'>$sb</td>";
                                echo "<td class='text-end text-muted'>$off</td>";
                                echo "<td class='text-end fw-bold'>$tot</td>";
                                echo "<td><div class='prog-wrap'><div class='prog-fill bg-success' style='width:$pct%;'></div></div></td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── TAB 4: LEAVE ─── -->
        <div class="tab-pane fade" id="tab-leave">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
                    <div class="sec-title mb-0">Leave Requests — <?php echo date('F Y'); ?></div>
                    <button class="btn-kt btn btn-sm" data-bs-toggle="modal" data-bs-target="#leaveModal">
                        <i class="fa fa-plus me-1"></i>New Request
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered tbl-hr mb-0">
                        <thead>
                            <tr>
                                <th>Emp. ID</th>
                                <th>Name</th>
                                <th>Leave Type</th>
                                <th>Start</th>
                                <th>End</th>
                                <th class="text-center">Days</th>
                                <th>Reason</th>
                                <th>Applied</th>
                                <th class="text-center">Approver</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $leaveTypes = ['Annual Leave','Sick Leave','Personal Leave','Maternity Leave','Emergency Leave'];
                        $leaveReqs = [
                            ['EMP-008','Theerawat B.','Sick Leave',    '2026-05-10','2026-05-12',3,'Fever / Doctor cert.','2026-05-09','Somchai J.','Approved'],
                            ['EMP-015','Jintana P.',  'Annual Leave',  '2026-05-20','2026-05-22',3,'Family trip',         '2026-05-15','Malee S.',  'Approved'],
                            ['EMP-003','Wanida C.',   'Personal Leave','2026-05-25','2026-05-25',1,'Bank appointment',    '2026-05-22','Malee S.',  'Pending'],
                            ['EMP-012','Piyawat T.',  'Emergency Leave','2026-05-28','2026-05-29',2,'Family emergency',   '2026-05-27','Somchai J.','Pending'],
                            ['EMP-006','Kittipong A.','Annual Leave',  '2026-06-03','2026-06-05',3,'Vacation',            '2026-05-25','Somchai J.','Pending'],
                            ['EMP-004','Prasert N.',  'Sick Leave',    '2026-05-08','2026-05-08',1,'Hospital visit',      '2026-05-07','Malee S.',  'Approved'],
                            ['EMP-017','Apinya K.',   'Annual Leave',  '2026-06-10','2026-06-12',3,'Travel',              '2026-05-28','Ratchanee S.','Pending'],
                        ];
                        $lvClass = ['Approved'=>'badge bg-success','Pending'=>'badge bg-warning text-dark','Rejected'=>'badge bg-danger'];
                        $ltColors = ['Sick Leave'=>'#dc3545','Annual Leave'=>'#1a7a3a','Personal Leave'=>'#0d6efd','Emergency Leave'=>'#fd7e14','Maternity Leave'=>'#6f42c1'];
                        foreach ($leaveReqs as $l) {
                            [$eid,$name,$ltype,$lstart,$lend,$days,$reason,$applied,$approver,$lstatus] = $l;
                            $ltc = $ltColors[$ltype] ?? '#555';
                            $lbadge = $lvClass[$lstatus] ?? 'badge bg-secondary';
                            echo "<tr>";
                            echo "<td class='fw-bold text-primary'>$eid</td>";
                            echo "<td class='fw-semibold'>$name</td>";
                            echo "<td><span class='badge-pill' style='background:{$ltc}1a;color:$ltc;border:1px solid {$ltc}40;'>$ltype</span></td>";
                            echo "<td>$lstart</td><td>$lend</td>";
                            echo "<td class='text-center fw-bold'>$days</td>";
                            echo "<td style='max-width:140px;overflow:hidden;text-overflow:ellipsis;'>$reason</td>";
                            echo "<td>$applied</td>";
                            echo "<td class='text-center text-muted' style='font-size:0.68rem;'>$approver</td>";
                            echo "<td class='text-center'><span class='$lbadge' style='font-size:0.65rem;'>$lstatus</span></td>";
                            echo "<td class='text-center'>";
                            if ($lstatus === 'Pending') {
                                echo "<div class='d-flex gap-1 justify-content-center'>";
                                echo "<button class='btn btn-sm btn-success' style='font-size:0.62rem;padding:2px 7px;border-radius:4px;'>Approve</button>";
                                echo "<button class='btn btn-sm btn-danger'  style='font-size:0.62rem;padding:2px 7px;border-radius:4px;'>Reject</button>";
                                echo "</div>";
                            } else {
                                echo "<span class='text-muted' style='font-size:0.68rem;'>—</span>";
                            }
                            echo "</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- Leave balance summary -->
                <div class="sec-title mt-3">Leave Balance Summary — All Types</div>
                <div class="row g-2">
                    <?php
                    $leaveBal = [
                        ['Annual Leave',    '#1a7a3a', 'Allocated: 12 days/yr',  '7.5 avg remaining'],
                        ['Sick Leave',      '#dc3545', 'Up to 30 days/yr',       'No deduction w/ cert.'],
                        ['Personal Leave',  '#0d6efd', 'Allocated: 3 days/yr',   '1.8 avg remaining'],
                        ['Emergency Leave', '#fd7e14', 'Up to 3 days/yr',        'Paid, case-by-case'],
                    ];
                    foreach ($leaveBal as [$lt,$col,$note1,$note2]) {
                        echo "<div class='col-6 col-md-3'>";
                        echo "<div class='rounded p-3' style='background:{$col}1a;border:1px solid {$col}40;'>";
                        echo "<div style='font-size:0.7rem;font-weight:800;color:$col;'>$lt</div>";
                        echo "<div style='font-size:0.68rem;color:#555;margin-top:3px;'>$note1</div>";
                        echo "<div style='font-size:0.65rem;color:#888;'>$note2</div>";
                        echo "</div></div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- ─── TAB 5: PAYROLL ─── -->
        <div class="tab-pane fade" id="tab-payroll">
            <div class="panel" style="border-radius:0 10px 10px 10px;">

                <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
                    <div class="sec-title mb-0">Payroll Summary — <?php echo date('F Y'); ?></div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width:auto;font-size:0.78rem;">
                            <?php
                            for ($m=1;$m<=12;$m++) echo "<option".($m==date('n')?' selected':'').">".date('F Y',mktime(0,0,0,$m,1))."</option>";
                            ?>
                        </select>
                        <button class="btn btn-sm" style="background:var(--kt-green);color:white;font-size:0.75rem;border-radius:6px;border:none;"><i class="fa fa-calculator me-1"></i>Calculate</button>
                        <button class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;border-radius:6px;"><i class="fa fa-file-pdf me-1"></i>Export PDF</button>
                    </div>
                </div>

                <!-- Payroll KPI -->
                <div class="row g-2 mb-3">
                    <?php
                    $payKpi = [
                        ['Total Gross Pay',    '฿ 3,824,000', '#1a7a3a','white'],
                        ['Total Deductions',   '฿ 498,120',   '#dc3545','white'],
                        ['Net Pay',            '฿ 3,325,880', '#0d6efd','white'],
                        ['OT Pay Total',       '฿ 162,400',   '#fd7e14','white'],
                        ['Social Security',    '฿ 106,000',   '#6f42c1','white'],
                        ['Income Tax (WHT)',   '฿ 392,120',   '#6c757d','white'],
                    ];
                    foreach ($payKpi as [$lbl,$val,$bg,$tc]) {
                        echo "<div class='col-6 col-md-4 col-xl-2'>";
                        echo "<div class='rounded p-3 text-$tc' style='background:$bg;'>";
                        echo "<div style='font-size:0.62rem;opacity:.85;text-transform:uppercase;letter-spacing:.5px;'>$lbl</div>";
                        echo "<div style='font-size:1.1rem;font-weight:800;'>$val</div>";
                        echo "</div></div>";
                    }
                    ?>
                </div>

                <div class="table-responsive" style="max-height:420px;overflow-y:auto;">
                    <table class="table table-bordered tbl-hr mb-0">
                        <thead>
                            <tr>
                                <th>Emp. ID</th>
                                <th>Name</th>
                                <th>Dept</th>
                                <th class="text-end">Base Salary</th>
                                <th class="text-end">OT Pay</th>
                                <th class="text-end">Allowance</th>
                                <th class="text-end">Gross</th>
                                <th class="text-end">Social Sec.</th>
                                <th class="text-end">WHT</th>
                                <th class="text-end">Deductions</th>
                                <th class="text-end fw-bold">Net Pay</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $payData = [
                            ['EMP-001','Somchai Jaidee',    'Pressing',       22000, 8,  1500],
                            ['EMP-002','Nattapon Sriwong',  'Forging',        16500, 12, 1000],
                            ['EMP-003','Wanida Chaiwong',   'QC',             18000, 6,  1200],
                            ['EMP-004','Prasert Nakpan',    'Maintenance',    20000, 4,  1500],
                            ['EMP-005','Sunisa Promtep',    'HR',             19500, 0,  1500],
                            ['EMP-006','Kittipong Araya',   'Pressing',       15500, 18, 1000],
                            ['EMP-007','Malee Somboon',     'Grinding',       23000, 9,  1500],
                            ['EMP-008','Theerawat Boonma',  'Heat Treatment', 16000, 14, 1000],
                            ['EMP-009','Patcharee Nuanjun', 'QC',             26000, 2,  2000],
                            ['EMP-010','Chaiyasit Wongdee', 'Assembly',       15000, 10, 1000],
                            ['EMP-013','Sumalee Chairat',   'HR',             38000, 0,  3000],
                            ['EMP-016','Sombat Klinkaew',   'Management',     65000, 0,  5000],
                        ];
                        $otRate = 100; // THB/hr
                        foreach ($payData as [$eid,$name,$dept,$base,$otHr,$allow]) {
                            $otPay  = $otHr * $otRate * 1.5;
                            $gross  = $base + $otPay + $allow;
                            $ss     = round($gross * 0.05);
                            $wht    = $gross > 30000 ? round($gross * 0.07) : round($gross * 0.03);
                            $deduct = $ss + $wht;
                            $net    = $gross - $deduct;
                            $paid   = rand(0,1) ? 'Paid' : 'Pending';
                            $pbadge = $paid === 'Paid' ? 'badge bg-success' : 'badge bg-warning text-dark';
                            echo "<tr>";
                            echo "<td class='fw-bold text-primary'>$eid</td>";
                            echo "<td class='fw-semibold'>$name</td>";
                            echo "<td>$dept</td>";
                            echo "<td class='text-end'>".number_format($base)."</td>";
                            echo "<td class='text-end text-success'>".number_format($otPay)."</td>";
                            echo "<td class='text-end text-info'>".number_format($allow)."</td>";
                            echo "<td class='text-end fw-semibold'>".number_format($gross)."</td>";
                            echo "<td class='text-end text-danger'>".number_format($ss)."</td>";
                            echo "<td class='text-end text-danger'>".number_format($wht)."</td>";
                            echo "<td class='text-end text-danger fw-semibold'>".number_format($deduct)."</td>";
                            echo "<td class='text-end fw-bold text-success'>฿".number_format($net)."</td>";
                            echo "<td class='text-center'><span class='$pbadge' style='font-size:0.63rem;'>$paid</span></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ─── TAB 6: HR REPORT ─── -->
        <div class="tab-pane fade" id="tab-report">
            <div class="panel" style="border-radius:0 10px 10px 10px;">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="sec-title">Headcount by Department</div>
                        <div style="position:relative;height:220px;">
                            <canvas id="hcDeptChart" role="img" aria-label="Headcount by department donut chart"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="sec-title">Attendance Rate by Department (%)</div>
                        <div style="position:relative;height:220px;">
                            <canvas id="attDeptChart" role="img" aria-label="Attendance rate by department bar chart"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="sec-title">Monthly OT Hours Trend</div>
                        <div style="position:relative;height:220px;">
                            <canvas id="otTrendChart" role="img" aria-label="Monthly overtime hours trend chart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- HR Metrics table -->
                <div class="sec-title mt-3">Department HR Metrics Summary</div>
                <div class="table-responsive">
                    <table class="table table-bordered tbl-hr mb-0">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th class="text-end">Headcount</th>
                                <th class="text-end">Present Today</th>
                                <th class="text-center">Attendance %</th>
                                <th class="text-end">Leave Days/Mo</th>
                                <th class="text-end">OT hrs/Mo</th>
                                <th class="text-end">Avg Salary</th>
                                <th class="text-end">Payroll/Mo</th>
                                <th class="text-center">Turnover</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $hrMetrics = [
                            ['Forging',        35, 32, 91.4, 8,  180, 18500, 647500,  '0%'],
                            ['Pressing',       43, 39, 90.7, 12, 324, 17000, 731000,  '0%'],
                            ['Grinding',       15, 14, 93.3, 3,  78,  18000, 270000,  '0%'],
                            ['Heat Treatment', 10,  9, 90.0, 2,  56,  17500, 175000,  '0%'],
                            ['Assembly',       13, 11, 84.6, 4,  62,  16000, 208000,  '0%'],
                            ['QC',             11, 10, 90.9, 3,  28,  20000, 220000,  '0%'],
                            ['Maintenance',     4,  4, 100,  1,  16,  21000,  84000,  '0%'],
                            ['HR / Admin',      5,  5, 100,  1,   0,  25000, 125000,  '0%'],
                            ['Management',      8,  8, 100,  1,   0,  52000, 416000,  '0%'],
                        ];
                        foreach ($hrMetrics as [$dept,$hc,$pres,$att,$lv,$ot,$avgSal,$payroll,$turn]) {
                            $attCls = $att >= 95 ? 'text-success fw-bold' : ($att >= 88 ? 'text-primary' : 'text-warning fw-semibold');
                            echo "<tr>";
                            echo "<td class='fw-semibold'>$dept</td>";
                            echo "<td class='text-end'>$hc</td>";
                            echo "<td class='text-end text-success fw-semibold'>$pres</td>";
                            echo "<td class='text-center $attCls'>$att%</td>";
                            echo "<td class='text-end'>$lv</td>";
                            echo "<td class='text-end'>$ot</td>";
                            echo "<td class='text-end'>฿".number_format($avgSal)."</td>";
                            echo "<td class='text-end fw-semibold'>฿".number_format($payroll)."</td>";
                            echo "<td class='text-center text-success fw-bold'>$turn</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <td class="fw-bold">TOTAL</td>
                                <td class="text-end fw-bold">144</td>
                                <td class="text-end fw-bold">132</td>
                                <td class="text-center fw-bold">91.7%</td>
                                <td class="text-end fw-bold">35</td>
                                <td class="text-end fw-bold">744</td>
                                <td class="text-end fw-bold">฿22,400</td>
                                <td class="text-end fw-bold">฿2,876,500</td>
                                <td class="text-center text-success fw-bold">0%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div><!-- end tab-content -->

    <?php include('footer.php'); ?>

</div><!-- container-fluid -->

<div class="footer-bar">
    <i class="fa-solid fa-users me-2"></i>KT Industrial Digitization System &nbsp;|&nbsp; HR Management Module &nbsp;|&nbsp;
    <?php echo date('Y'); ?> &copy; KT Human Resources Dept.
</div>

<!-- ═══ ADD EMPLOYEE MODAL ═══ -->
<div class="modal fade" id="addEmpModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-plus me-2"></i>Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4"><label>First Name *</label><input type="text" class="form-control" placeholder="First name"></div>
                    <div class="col-md-4"><label>Last Name *</label><input type="text" class="form-control" placeholder="Last name"></div>
                    <div class="col-md-4"><label>Employee ID</label><input type="text" class="form-control" placeholder="Auto-generated" readonly></div>
                    <div class="col-md-4">
                        <label>Department *</label>
                        <select class="form-select">
                            <option value="">-- Select --</option>
                            <option>Forging</option><option>Pressing</option><option>Grinding</option>
                            <option>Heat Treatment</option><option>Assembly</option>
                            <option>QC</option><option>Maintenance</option><option>HR</option><option>Management</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label>Position *</label><input type="text" class="form-control" placeholder="Job title"></div>
                    <div class="col-md-4">
                        <label>Shift</label>
                        <select class="form-select"><option>A</option><option>B</option><option>Office</option></select>
                    </div>
                    <div class="col-md-4"><label>Start Date *</label><input type="date" class="form-control"></div>
                    <div class="col-md-4"><label>Base Salary (THB) *</label><input type="number" class="form-control" placeholder="0"></div>
                    <div class="col-md-4">
                        <label>Employment Type</label>
                        <select class="form-select"><option>Permanent</option><option>Contract</option><option>Probation</option></select>
                    </div>
                    <div class="col-md-6"><label>Phone</label><input type="text" class="form-control" placeholder="0XX-XXX-XXXX"></div>
                    <div class="col-md-6"><label>National ID</label><input type="text" class="form-control" placeholder="X-XXXX-XXXXX-XX-X"></div>
                    <div class="col-12"><label>Address</label><textarea class="form-control" rows="2" placeholder="Home address..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button class="btn-kt btn"><i class="fa fa-save me-1"></i>Save Employee</button>
            </div>
        </div>
    </div>
</div>

<!-- ═══ LEAVE REQUEST MODAL ═══ -->
<div class="modal fade" id="leaveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-calendar-minus me-2"></i>Leave Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label>Employee *</label>
                        <select class="form-select">
                            <option>-- Select Employee --</option>
                            <?php
                            $empNames = ['EMP-001 · Somchai Jaidee','EMP-002 · Nattapon Sriwong','EMP-003 · Wanida Chaiwong',
                                         'EMP-004 · Prasert Nakpan','EMP-005 · Sunisa Promtep','EMP-006 · Kittipong Araya'];
                            foreach ($empNames as $en) echo "<option>$en</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label>Leave Type *</label>
                        <select class="form-select">
                            <option>Annual Leave</option><option>Sick Leave</option>
                            <option>Personal Leave</option><option>Emergency Leave</option><option>Maternity Leave</option>
                        </select>
                    </div>
                    <div class="col-6"><label>Start Date *</label><input type="date" class="form-control"></div>
                    <div class="col-6"><label>End Date *</label><input type="date" class="form-control"></div>
                    <div class="col-12"><label>Reason *</label><textarea class="form-control" rows="3" placeholder="Reason for leave..."></textarea></div>
                    <div class="col-12">
                        <label>Upload Document (if any)</label>
                        <input type="file" class="form-control" accept=".pdf,.jpg,.png">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button class="btn-kt btn"><i class="fa fa-paper-plane me-1"></i>Submit Request</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
// ── Filter employees ──
function filterEmp() {
    const dept   = document.getElementById('filterDept').value.toLowerCase();
    const status = document.getElementById('filterEmpStatus').value.toLowerCase();
    const shift  = document.getElementById('filterShift').value.toLowerCase();
    const search = document.getElementById('empSearch').value.toLowerCase();
    const rows   = document.querySelectorAll('#empBody tr');
    let shown = 0;
    rows.forEach(r => {
        const ok = (!dept   || r.dataset.dept?.toLowerCase().includes(dept))
                && (!status || r.dataset.status?.toLowerCase().includes(status))
                && (!shift  || r.dataset.shift?.toLowerCase() === shift)
                && (!search || r.dataset.search?.toLowerCase().includes(search));
        r.style.display = ok ? '' : 'none';
        if (ok) shown++;
    });
    document.getElementById('empCount').textContent = shown;
}

function clearEmpFilter() {
    ['filterDept','filterEmpStatus','filterShift'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('empSearch').value = '';
    filterEmp();
}

function toggleEmpAll(cb) {
    document.querySelectorAll('.emp-check').forEach(c => c.checked = cb.checked);
}

// ── Attendance trend ──
new Chart(document.getElementById('attTrendChart'), {
    type: 'line',
    data: {
        labels: Array.from({length:31},(_,i)=>i+1),
        datasets: [{
            label: 'Attendance %',
            data: [0,0,0,91,89,92,88,90,87,93,91,90,92,88,91,90,89,94,91,88,92,89,90,91,88,90,89,91,92,89,90],
            borderColor: '#1a7a3a', backgroundColor: 'rgba(26,122,58,.1)',
            borderWidth: 2, pointRadius: 2, fill: true, tension: 0.3
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { font:{size:9}, maxRotation:0 }, grid:{display:false} },
            y: { min:75, max:100, ticks: { font:{size:9}, callback: v=>v+'%' }, grid:{color:'#f0f0f0'} }
        }
    }
});

// ── Absence by dept ──
new Chart(document.getElementById('absDeptChart'), {
    type: 'bar',
    data: {
        labels: ['Forging','Pressing','Grinding','HT','Assembly','QC','Maint.'],
        datasets: [{
            label: 'Absences',
            data: [3,5,1,1,2,1,0],
            backgroundColor: ['#0d6efd','#1a7a3a','#6f42c1','#fd7e14','#dc3545','#0dcaf0','#6c757d'],
            borderRadius: 4, borderWidth: 0
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend:{display:false} },
        scales: {
            x: { ticks:{font:{size:9}}, grid:{display:false} },
            y: { ticks:{font:{size:9}}, grid:{color:'#f0f0f0'} }
        }
    }
});

// ── Shift headcount ──
new Chart(document.getElementById('shiftChart'), {
    type: 'bar',
    data: {
        labels: ['Forging','Pressing','Grinding','HT','Assembly','QC'],
        datasets: [
            { label:'Shift A', data:[18,22,8,5,7,5], backgroundColor:'#1a7a3a', borderRadius:3, borderWidth:0 },
            { label:'Shift B', data:[16,20,7,5,6,4], backgroundColor:'#0d6efd', borderRadius:3, borderWidth:0 }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend:{labels:{font:{size:10}}} },
        scales: {
            x: { ticks:{font:{size:9}}, grid:{display:false} },
            y: { ticks:{font:{size:9}}, grid:{color:'#f0f0f0'}, stacked:false }
        }
    }
});

// ── Headcount by dept donut ──
new Chart(document.getElementById('hcDeptChart'), {
    type: 'doughnut',
    data: {
        labels: ['Forging','Pressing','Grinding','HT','Assembly','QC','Maint.','HR','Mgmt'],
        datasets: [{
            data: [35,43,15,10,13,11,4,5,8],
            backgroundColor: ['#0d6efd','#1a7a3a','#6f42c1','#fd7e14','#dc3545','#0dcaf0','#6c757d','#d63384','#212529'],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false, cutout:'60%',
        plugins: { legend:{ position:'right', labels:{font:{size:9}, boxWidth:10} } }
    }
});

// ── Attendance rate by dept ──
new Chart(document.getElementById('attDeptChart'), {
    type: 'bar',
    data: {
        labels: ['Forging','Pressing','Grinding','HT','Assembly','QC','Maint.','HR','Mgmt'],
        datasets: [{
            label: 'Attendance %',
            data: [91.4,90.7,93.3,90.0,84.6,90.9,100,100,100],
            backgroundColor: ['#0d6efd','#1a7a3a','#6f42c1','#fd7e14','#dc3545','#0dcaf0','#6c757d','#d63384','#212529'],
            borderRadius: 4, borderWidth: 0
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true, maintainAspectRatio: false,
        plugins: { legend:{display:false} },
        scales: {
            x: { min:75, max:100, ticks:{font:{size:9}, callback:v=>v+'%'}, grid:{color:'#f0f0f0'} },
            y: { ticks:{font:{size:9}}, grid:{display:false} }
        }
    }
});

// ── OT Trend ──
new Chart(document.getElementById('otTrendChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: 'OT Hours',
            data: [280,310,295,340,324,0,0,0,0,0,0,0],
            borderColor: '#fd7e14', backgroundColor: 'rgba(253,126,20,.1)',
            borderWidth: 2.5, pointRadius: 4, fill: true, tension: 0.3,
            pointBackgroundColor: '#fd7e14'
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend:{display:false} },
        scales: {
            x: { ticks:{font:{size:9}}, grid:{display:false} },
            y: { ticks:{font:{size:9}}, grid:{color:'#f0f0f0'} }
        }
    }
});
</script>

</body>
</html>