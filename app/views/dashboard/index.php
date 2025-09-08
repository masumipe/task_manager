<h2>Dashboard</h2>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">Cash on Hand</div>
            <div class="card-body">
                <h4 class="card-title text-success">Tk. <?= number_format($metrics['cash_on_hand'], 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-info mb-3">
            <div class="card-header bg-info text-white">Top 5 Overdue Tenants</div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($topOverdues as $row): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($row['full_name']) ?>
                            <span class="badge bg-danger">Tk. <?= number_format($row['balance'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success mb-3">
            <div class="card-header bg-success text-white">Monthly Collection Trend</div>
            <div class="card-body">
                <canvas id="trendChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trendChart').getContext('2d');
    const trendData = {
        labels: <?= json_encode(array_column($trend_collection, 'month')) ?>,
        datasets: [
            {
                label: 'Collections',
                data: <?= json_encode(array_column($trend_collection, 'total')) ?>,
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                borderColor: '#3498db',
                borderWidth: 2,
                tension: 0.3
            },
            {
                label: 'Expenses',
                data: <?= isset($trend_expenses) ? json_encode(array_column($trend_expenses, 'total')) : '[]' ?>,
                backgroundColor: 'rgba(231, 76, 60, 0.2)',
                borderColor: '#e74c3c',
                borderWidth: 2,
                tension: 0.3
            }
        ]
    };
    new Chart(ctx, {
        type: 'line',
        data: trendData,
        options: { scales: { y: { beginAtZero: true } } }
    });
</script>