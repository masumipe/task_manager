<?php
// Simple API endpoint to return the overdue table HTML for PDF export
// You can adjust the data source as needed (e.g., fetch from DB)
header('Content-Type: text/html; charset=UTF-8');

// Example static table (replace with dynamic data as needed)
echo '<table style="width: 100%; border-collapse: collapse;">
<thead><tr><th>Due Month</th><th>Amount</th><th>Status</th><th>Type</th></tr></thead>
<tbody>
<tr><td>2025-07-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-06-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-05-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-04-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-03-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-03-01</td><td>Tk1,000.00</td><td><span class="text-danger">Unpaid</span></td><td>Additional</td></tr>
<tr><td>2025-02-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2025-01-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-12-01</td><td>Tk5,000.00</td><td><span class="text-danger">Unpaid</span></td><td>Additional</td></tr>
<tr><td>2024-12-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-11-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-10-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-09-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-08-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-07-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-06-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-05-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-04-01</td><td>Tk25,000.00</td><td><span class="text-danger">Unpaid</span></td><td>Additional</td></tr>
<tr><td>2024-04-01</td><td>Tk4,700.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-03-01</td><td>Tk5,700.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-02-01</td><td>Tk4,700.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2024-01-01</td><td>Tk4,700.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2023-12-01</td><td>Tk4,700.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2023-11-01</td><td>Tk5,500.00</td><td><span class="text-success">Paid</span></td><td>Monthly</td></tr>
<tr><td>2023-01-01</td><td>Tk25,000.00</td><td><span class="text-success">Paid</span></td><td>Additional</td></tr>
</tbody>
<tfoot><tr class="fw-bold"><td>Total</td><td colspan="3">Tk168,500.00</td></tr></tfoot>
</table>';
