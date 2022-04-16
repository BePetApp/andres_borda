<x-admin-layout>
    {{-- {{ dd($users) }} --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-base-100 p-3 rounded shadow-gray-800/50 shadow-md">
            <h2 class="text-green-500 font-semibold text-lg mb-4">Productos con mayor valor en ventas (ultimo mes):</h2>
            <canvas id="myChart" width="300" height="300"></canvas>
        </div>
        <div class="bg-base-100 p-3 rounded shadow-gray-800/50 shadow-md">
            <h2 class="text-green-500 font-semibold text-lg mb-4">Usuarios nuevos:</h2>
            <canvas id="newUsers" width="300" height="300"></canvas>
        </div>
    </div>

    
    @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script type="text/javascript">
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: <?php echo json_encode(array_keys($products)) ?> ,
                    datasets: [{
                        label: '# de ventas',
                        data: <?php echo json_encode(array_values($products)) ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 255, 255, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Users--------------------------------------------------
            const ctx2 = document.getElementById('newUsers').getContext('2d');
            const newUsers = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_keys($users)) ?> ,
                    datasets: [{
                        label: '# de nuevos usuarios',
                        data: <?php echo json_encode(array_values($users)) ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            // 'rgba(153, 102, 255, 0.5)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endslot
</x-admin-layout>