<h2>Monthly Collection & Expense Details: <?= htmlspecialchars($month) ?></h2>
<div class="row">
    <div class="col-md-6">
        <h4>Collections</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Flat</th>
                    <th>Receipt #</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sum_col = 0;
                if (!empty($collections)): ?>
                    <?php foreach ($collections as $col): $sum_col += $col['amount']; ?>
                        <tr>
                            <td><?= htmlspecialchars($col['collection_date']) ?></td>
                            <td>Tk. <?= number_format($col['amount'], 2) ?></td>
                            <td><?= htmlspecialchars($col['flat_number'] ?? '') ?></td>
                            <td><?= htmlspecialchars($col['receipt_no'] ?? '') ?></td>
                            <td><?= htmlspecialchars($col['remarks'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No collections found.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td>Total</td>
                    <td colspan="4">Tk. <?= number_format($sum_col, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-6">
        <h4>Expenses</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Payee</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sum_exp = 0;
                if (!empty($expenses)): ?>
                    <?php foreach ($expenses as $exp): $sum_exp += $exp['amount']; ?>
                        <tr>
                            <td><?= htmlspecialchars($exp['payment_date']) ?></td>
                            <td>Tk. <?= number_format($exp['amount'], 2) ?></td>
                            <td><?= htmlspecialchars($exp['expense_type'] ?? '') ?></td>
                            <td><?= htmlspecialchars($exp['payee'] ?? '') ?></td>
                            <td><?= htmlspecialchars($exp['description'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No expenses found.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td>Total</td>
                    <td colspan="4">Tk. <?= number_format($sum_exp, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<a href="<?= ROOT ?>reports/cashsummary" class="btn btn-secondary mt-3">Back to Cash Summary</a>
