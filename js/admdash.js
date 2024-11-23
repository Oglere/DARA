const studyStatusData = <?php echo json_encode($study_status_data); ?>;
        const userRolesData = <?php echo json_encode($user_roles_data); ?>;

        // Study Status Chart
        const studyStatusCtx = document.getElementById('studyStatusChart').getContext('2d');
        const studyStatusChart = new Chart(studyStatusCtx, {
            type: 'pie',
            data: {
                labels: studyStatusData.map(item => item.status),
                datasets: [{
                    data: studyStatusData.map(item => item.count),
                    backgroundColor: ['#8e0404', '#04128e', '#FFCE56', '#8AFF64', '#FF9F40'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // User Roles Chart
        const userRolesCtx = document.getElementById('userRolesChart').getContext('2d');
        const userRolesChart = new Chart(userRolesCtx, {
            type: 'bar',
            data: {
                labels: userRolesData.map(item => item.role),
                datasets: [{
                    label: 'User Count',
                    data: userRolesData.map(item => item.count),
                    backgroundColor: ['#04128e', '#8e0404', '#FFCE56', '#8AFF64', '#FF9F40'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });