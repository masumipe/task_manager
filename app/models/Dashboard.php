<?php
class Dashboard
{
    private $db;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    // public function getMetrics()
    // {
    //     $sql = "SELECT (SELECT IFNULL(SUM(amount),0) FROM collections) - (SELECT IFNULL(SUM(amount),0) FROM expenses) AS cash_on_hand";
    //     $stmt = $this->db->query($sql);
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return [
    //         'cash_on_hand' => $row['cash_on_hand']
    //     ];
    // }
    

}
