<?php
require_once __DIR__ . '/../core/Auth.php';
class DashboardController extends Controller
{
    public function index()
    {
        Auth::check();
        $dashboardModel = $this->model('Dashboard');
        $metrics = $dashboardModel->getMetrics();
        $topOverdues = $dashboardModel->getTopOverdues();
        $trend_collection = $dashboardModel->getMonthlyCollectionTrend();
        $trend_expenses = $dashboardModel->getMonthlyExpensesTrend();
        require_once __DIR__ . '/../templates/header.php';
        require __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../templates/footer.php';
    }
}
