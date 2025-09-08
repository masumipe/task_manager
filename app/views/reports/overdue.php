<?php
// reports/overdue.php
?>
<div class="container mt-4">
    <h2>Overdue Accounts Report</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tenant</th>
                <th>Unit</th>
                <th>Owner</th>
                <th>Overdue Amount</th>
                <th>Last Payment</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_overdue = 0;
            if (!empty($overdues)): ?>
                <?php foreach ($overdues as $overdue):
                    $total_overdue += $overdue['overdue_amount']; ?>
                    <tr>
                        <td>
                            <a href="<?= ROOT ?>reports/overduedetails/<?= $overdue['tenant_id'] ?>"
                                class="btn btn-link p-0 m-0 align-baseline"><?= htmlspecialchars($overdue['tenant_name']) ?></a>
                        </td>
                        <td><?= htmlspecialchars($overdue['unit']) ?></td>
                        <td><?= htmlspecialchars($overdue['owner_name']) ?></td>
                        <td class="text-danger fw-bold">Tk.<?= number_format($overdue['overdue_amount'], 2) ?></td>
                        <td><?= htmlspecialchars($overdue['last_payment']) ?></td>
                        <td>
                            <a href="<?= ROOT ?>reports/overduedetails/<?= $overdue['tenant_id'] ?>"
                                class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-warning fw-bold">
                    <td colspan="3" class="text-end">Total Overdue</td>
                    <td class="text-danger">Tk.<?= number_format($total_overdue, 2) ?></td>
                    <td colspan="2"></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No overdue accounts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>