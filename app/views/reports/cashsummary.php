<h2>Cash Summary (Month to Month)</h2>
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Month</th>
            <th>Total Collection</th>
            <th>Total Expense</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cash_summary)): ?>
            <?php foreach ($cash_summary as $row): ?>
                <tr>
                    <td><a
                            href="<?= ROOT ?>reports/monthlycf/<?= urlencode($row['month']) ?>"><?= htmlspecialchars($row['month']) ?></a>
                    </td>
                    <td>Tk. <?= number_format($row['total_collection'], 2) ?></td>
                    <td>Tk. <?= number_format($row['total_expense'], 2) ?></td>
                    <td>Tk. <?= number_format($row['balance'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>