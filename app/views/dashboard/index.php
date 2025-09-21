<?php
// Dashboard: Upcoming tasks, overdue, summary
?>
<div class="dashboard">
    <h2>Office Task Dashboard</h2>
    <div class="dashboard-summary">
        <div>Upcoming Tasks (Next 7 Days): <span id="upcoming-count"><!-- count --></span></div>
        <div>Overdue Tasks: <span id="overdue-count"><!-- count --></span></div>
        <div>Completed This Week: <span id="completed-count"><!-- count --></span></div>
    </div>
    <div id="kanban-board">
        <?php include 'kanban.php'; ?>
    </div>
    <div id="gantt-chart">
        <?php include 'gantt.php'; ?>
    </div>
    <div id="analytics">
        <?php include 'analytics.php'; ?>
    </div>
</div>