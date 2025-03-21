<?php
include '../db/db.php';
session_start();

if ($_SESSION['role'] !== 'Admin') {
    header('Location: ../view/login.php');
    exit();
}

include '../controls/admin/hugawa.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../css/administry.css">
    <link rel="stylesheet" href="../css/std.scss">
    <link rel="stylesheet" href="../css/mainpage.scss">
    <link rel="stylesheet" href="../css/std_control.scss">

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head> 
<body style="overflow: hidden;">
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="DARA Logo" class="ahh">
            </div>
        </header>

        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2><?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>
                </div>

                <nav class="nav-links">
                    <a href="" style="color: #04128e; font-weight: normal;"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="user-control">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-users"
                            >
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Manage Users
                    </a>
                    
                    <?php
                    // Connect to the database
                    $conn = new mysqli("localhost", "root", "", "dara");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to count unread notifications (where is_checked = 0)
                    $sql = "SELECT COUNT(*) AS unread_count FROM notification_logs WHERE is_checked = 0";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $unreadCount = $row['unread_count'];
                    } else {
                        $unreadCount = 0;
                    }

                    $conn->close();
                    ?>

                    <a href="messages">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-mail"
                            >
                            <path
                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                            />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>

                        Inbox
                        <?php if ($unreadCount > 0): ?>
                            <strong style="color: #8e0404;">&nbsp&nbsp&nbsp<?= $unreadCount ?></strong>
                        <?php endif; ?>
                    </a>


                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                    </div>

                    <a href="../" class="unq">Search Studies</a>
                    <a href="edit" class="unq">Edit Account</a>
                    <a href="recovery" class="unq">Recovery</a>
                    
                    <div class="asd2" style=" width: 100%; 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                    </div>

                    <a href="../view/logout.php" class="logout-btn">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-log-in"
                            >
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>

                        Logout
                    </a>
                </nav>
            </div>

            <style>
                .tp, .md, .bt, .ft {
                    /* border: black 1px solid; */
                    display: flex;
                }
            </style>

            <div class="right" style="overflow-x: hidden; height: calc(100% - 100px); display: flex; flex-direction: column; flex-wrap: nowrap; justify-content: flex-start; align-items: normal;">
                <div class="tp">
                    <main class="app-main" style="padding: 0;">
                        <!--end::App Content Header-->
                        <!--begin::App Content-->
                        <div class="app-content">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            <!--begin::Row-->
                            <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-3 col-6">
                                <!--begin::Small Box Widget 1-->
                                <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3> <?php echo $totalusers; ?></h3>
                                    <p>Total Users</p>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"/>
                                    <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" />
                                </svg>
                                <a href="user-control" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                                </div>
                                <!--end::Small Box Widget 1-->
                            </div>

                            <div class="col-lg-3 col-6">
                                <!--begin::Small Box Widget 4-->
                                <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3> <?php echo $totalmsgs; ?></h3>
                                    <p>Unread Notifications</p>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <g id="style=fill">
                                    <g id="notification-bell-new">
                                    <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M14.802 19.8312C15.4184 19.7694 15.8349 20.4237 15.5437 20.9534C15.3385 21.3267 15.0493 21.6524 14.7029 21.9193C14.3496 22.1913 13.9397 22.4001 13.5 22.5403C13.0601 22.6807 12.593 22.7517 12.1242 22.7517C11.6554 22.7517 11.1883 22.6807 10.7484 22.5403C10.3087 22.4001 9.89883 22.1913 9.54556 21.9193C9.1991 21.6524 8.90988 21.3267 8.70472 20.9534C8.41354 20.4237 8.83002 19.7694 9.44644 19.8312C9.63869 19.8505 11.1433 19.9976 12.1242 19.9976C13.1051 19.9976 14.6097 19.8505 14.802 19.8312Z"/>
                                    <path id="Subtract" fill-rule="evenodd" clip-rule="evenodd" d="M15.7423 1.98737C13.4465 0.967602 10.7932 1.00445 8.52901 2.08755C6.27704 3.16478 4.85335 5.3744 4.85335 7.79233L4.85335 9.06596C4.85335 10.1981 4.55987 11.3124 3.99943 12.3082L3.77239 12.7115C2.37502 15.1943 3.90274 18.2653 6.79044 18.7783C10.3154 19.4046 13.93 19.4046 17.455 18.7783L17.6156 18.7498C20.465 18.2435 22.0525 15.29 20.8335 12.7632L20.5681 12.213C20.1236 11.2918 19.8934 10.2885 19.8934 9.27297V8.9514C19.4108 9.23527 18.8484 9.39807 18.248 9.39807C16.4531 9.39807 14.998 7.943 14.998 6.14807C14.998 4.6268 16.0433 3.34965 17.4547 2.99558C17.003 2.63274 16.4979 2.323 15.9475 2.07851L15.7423 1.98737Z"/>
                                    <circle id="vector" cx="18.248" cy="6.14844" r="2.5"/>
                                    </g>
                                    </g>
                                </svg>
                                <a href="messages" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                                </div>
                                <!--end::Small Box Widget 4-->
                            </div>
                            <!--end::Col-->
                        </div>
                    </main>
                </div>
                <div class="md">
                    <!-- line graph -->
                    <div style="width:  100%; margin-right: 20px;" class="card mb-4">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                        <h3 class="card-title">Study Overview</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="fw-bold fs-5"><?php echo $hugawaba['total']; ?></span> <span>Studies Published Over Time</span>
                        </p>
                        <p class="ms-auto d-flex flex-column text-end">
                            <span class="text-success"> <i class="bi bi-arrow-up"></i> <?php echo number_format($percent_change, 2) . '%'; ?>  </span>
                            <span class="text-secondary">Since last month</span>
                        </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="position-relative mb-4"><div id="visitors-chart"></div></div>
                        <div class="d-flex flex-row justify-content-end">
                        <span class="me-2">
                            <i class="bi bi-square-fill text-primary"></i> Studies Published
                        </span>
                        <span> <i class="bi bi-square-fill text-secondary"></i> Studies Unpublished </span>
                        </div>
                    </div>
                    </div>
                    <!-- piechart -->
                    <div class="chart-container">
                        <h2>Role Distribution Overview</h2>
                        <canvas id="studyStatusChart"></canvas>
                        <div id="legend" style="margin-top: 10px; display: flex;"></div>
                    </div>
                </div>
                <div class="bt">
                    <div class="recent-activity">
                        <h2>Recent Users Online</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Online</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    date_default_timezone_set('Asia/Manila'); // Set the PHP timezone to match your local timezone

                                    foreach ($recent_users_online_data as $user): ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $lastLogin = new DateTime($user['last_login']);
                                                $now = new DateTime();
                                                $interval = $now->diff($lastLogin);

                                                // Display time ago format
                                                if ($interval->d > 0) {
                                                    echo $interval->d . ' day(s) ago';
                                                } elseif ($interval->h > 0) {
                                                    echo $interval->h . ' hour(s) ago';
                                                } elseif ($interval->i > 0) {
                                                    echo $interval->i . ' minute(s) ago';
                                                } else {
                                                    echo 'Just now';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ft">
                    <footer class="main-footer" style="color: #869099;;">
                        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                        All rights reserved.
                        <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.2.0
                        </div>
                    </footer>
                </div>

                <!-- mga cards -->
                <div style="display: none;">
                

                

                <!-- online -->
                
                
                <!-- last line of defense -->
                
                </div>
            </div>
        </div>
    </div>

        <footer>
        </footer>
    </main>

    <script>
        // ✅ 1. PIE CHART - Role Distribution
        const userRolesData = <?php echo json_encode($user_roles_data); ?>;
        const studyStatusCtx = document.getElementById('studyStatusChart').getContext('2d');

        const studyStatusChart = new Chart(studyStatusCtx, {
            type: 'pie',
            data: {
                labels: userRolesData.map(item => item.role),
                datasets: [{
                    label: 'User Count',
                    data: userRolesData.map(item => item.count),
                    backgroundColor: ['rgb(13, 110, 253)', '#dc3545', '#FFCE56', '#8AFF64', '#FF9F40']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => context.chart.data.labels[context.dataIndex],
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                }
            }
        });

        const legendContainer = document.getElementById('legend');
        legendContainer.innerHTML = userRolesData.map((item, index) => `
            <div style="display: flex; align-items: center; margin-right: 15px;">
                <div style="
                    width: 20px;
                    height: 20px;
                    background-color: ${studyStatusChart.data.datasets[0].backgroundColor[index]};
                    margin-right: 10px;
                    border-radius: 4px;">
                </div>
                <span style="font-size: 14px;">${item.role}</span>
            </div>
        `).join('');

        // ✅ 2. LINE GRAPH - Number of Studies Published Per Month
        const studiesPerMonth = <?php echo json_encode($data); ?>;
        const documentOverviewCtx = document.getElementById('documentOverviewChart').getContext('2d');

        // Generate last 8 months dynamically
        const now = new Date();
        const monthLabels = [];
        const studiesData = Array(8).fill(0);

        for (let i = 7; i >= 0; i--) {
            const date = new Date();
            date.setMonth(now.getMonth() - i);
            monthLabels.push(date.toLocaleString('default', { month: 'long' }));
        }

        // Fill in the data based on the last 8 months
        studiesPerMonth.forEach(item => {
            const date = new Date();
            date.setMonth(item.month - 1);
            const monthName = date.toLocaleString('default', { month: 'long' });
            const index = monthLabels.indexOf(monthName);
            if (index !== -1) {
                studiesData[index] = item.total;
            }
        });

        const documentOverviewChart = new Chart(documentOverviewCtx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Number of Studies Published',
                    data: studiesData,
                    backgroundColor: 'rgba(4, 18, 142, 0.2)',
                    borderColor: '#04128e',
                    borderWidth: 2,
                    pointBackgroundColor: '#04128e',
                    pointRadius: 4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Studies',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Ensure whole numbers only
                        }
                    }
                }
            }
        });

    </script>
</body>
</html>

<script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>

    <?php 
        $months = [];
        $published = array_fill(0, 7, 0);
        $unpublished = array_fill(0, 7, 0);
        
        for ($i = 6; $i >= 0; $i--) {
            $date = new DateTime();
            $date->modify("-$i months");
            $months[] = $date->format('F'); // Month names like 'January', 'February'
        }
        
        // Map data to correct month position
        foreach ($published_data as $item) {
            $monthIndex = array_search(DateTime::createFromFormat('!m', $item['month'])->format('F'), $months);
            if ($monthIndex !== false) {
                $published[$monthIndex] = (int)$item['total'];
            }
        }
        
        foreach ($unpublished_data as $item) {
            $monthIndex = array_search(DateTime::createFromFormat('!m', $item['month'])->format('F'), $months);
            if ($monthIndex !== false) {
                $unpublished[$monthIndex] = (int)$item['total'];
            }
        }
    ?>

    <script>
      const visitors_chart_options = {
        series: [
            {
                name: 'Studies Published',
                data: <?php echo json_encode($published); ?>
            },
            {
                name: 'Studies Unpublished',
                data: <?php echo json_encode($unpublished); ?>
            }
        ],
        chart: {
            height: 200,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        colors: ['#0d6efd', '#adb5bd'],
        stroke: {
            curve: 'smooth'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            }
        },
        legend: {
            show: false
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: <?php echo json_encode($months); ?>
        }
    };

    const visitors_chart = new ApexCharts(
    document.querySelector('#visitors-chart'),
    visitors_chart_options,
    );
    visitors_chart.render();
</script>