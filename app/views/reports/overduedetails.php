<?php
require_once __DIR__ . '/../../core/csrf.php';
?>

<script src="<?= ROOT ?>public/html2pdf.bundle.min.js"></script>
<div class="container mt-4">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div id="overdue-details">
        <h2>Overdue Details for <span id="tenant-name"></span></h2>
        <div class="mb-3">
            <strong>Flat Number:</strong> <span id="unit-number"></span><br>
            <strong>Contact:</strong> <span id="contact-info"></span><br>
            <strong>Total Overdue: <span id="total-overdue" style="color: red;"></span></strong>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary">Service Charge Due</h5>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Due Month</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="Charge">
                        <tr>
                            <td colspan="4" class="loading">Loading charge data...</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="1">Total</td>
                            <td colspan="3" id="charge-total">Tk0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6">
                <h5 class="text-success">Collections</h5>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Receipt #</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="collection">
                        <tr>
                            <td colspan="3" class="loading">Loading collection data...</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td colspan="2" id="collection-total">Tk0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="btn-group mt-3">
        <button class="btn btn-secondary" onclick="goBack()">Back to Overdue Report</button>
        <button class="btn btn-outline-primary" onclick="exportTablesToCSV()">Export to CSV</button>
        <button class="btn btn-outline-danger" onclick="exportOverdueDetailsToPDF()">Export to PDF</button>
    </div>
</div>

<script>
    // Function to fetch data from MySQL database via PHP backend
    function fetchOverdueDetails(tenantId, callback) {
        // Show loading state
        document.getElementById('Charge').innerHTML = '<tr><td colspan="4" class="loading">Loading charge data...</td></tr>';
        document.getElementById('collection').innerHTML = '<tr><td colspan="3" class="loading">Loading collection data...</td></tr>';

        // Create AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= ROOT ?>app/controllers/get_overdue_details.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.status === 200) {
                try {
                    const response = JSON.parse(this.responseText);

                    if (response.success) {
                        // Update tenant information
                        document.getElementById('tenant-name').textContent = response.tenant.full_name || response.tenant.name || '';
                        document.getElementById('unit-number').textContent = response.tenant.flat_number || '';
                        document.getElementById('contact-info').textContent = response.tenant.contact || response.tenant.contact_number || '';

                        // Update charges table
                        const chargeTable = document.getElementById('Charge');
                        let chargeTotal = 0;

                        if (response.charges && response.charges.length > 0) {
                            let chargeHtml = '';
                            response.charges.forEach(charge => {
                                chargeHtml += `
                                        <tr>
                                            <td>${escapeHtml(charge.charge_month)}</td>
                                            <td>Tk${numberFormat(charge.charge_amount)}</td>
                                            <td>${charge.paid == 1 ? '<span class="text-success">Paid</span>' : '<span class="text-danger">Unpaid</span>'}</td>
                                            <td>${escapeHtml(charge.service_name)}</td>
                                            <td>${escapeHtml(charge.description)}</td>
                                        </tr>
                                    `;
                                chargeTotal += parseFloat(charge.charge_amount);
                            });
                            chargeTable.innerHTML = chargeHtml;
                        } else {
                            chargeTable.innerHTML = '<tr><td colspan="4" class="text-center">No outstanding charges.</td></tr>';
                        }

                        document.getElementById('charge-total').textContent = `Tk${numberFormat(chargeTotal)}`;

                        // Update collections table
                        const collectionTable = document.getElementById('collection');
                        let collectionTotal = 0;

                        if (response.collections && response.collections.length > 0) {
                            let collectionHtml = '';
                            response.collections.forEach(collection => {
                                collectionHtml += `
                                        <tr>
                                            <td>${escapeHtml(collection.receipt_no)}</td>
                                            <td>Tk${numberFormat(collection.amount)}</td>
                                            <td>${escapeHtml(collection.collection_date)}</td>
                                        </tr>
                                    `;
                                collectionTotal += parseFloat(collection.amount);
                            });
                            collectionTable.innerHTML = collectionHtml;
                        } else {
                            collectionTable.innerHTML = '<tr><td colspan="3" class="text-center">No collections found.</td></tr>';
                        }

                        document.getElementById('collection-total').textContent = `Tk${numberFormat(collectionTotal)}`;
                        document.getElementById('total-overdue').textContent = `Tk${numberFormat(chargeTotal - collectionTotal)}`;
                        if (typeof callback === 'function') callback();
                    } else {
                        alert('Error: ' + response.message);
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Error processing data from server.');
                }
            } else {
                alert('Error fetching data. Server returned status: ' + this.status);
            }
        };

        xhr.onerror = function () {
            alert('Request failed. Please check your connection.');
        };

        // Send the request with the tenant ID
        xhr.send('tenant_id=' + encodeURIComponent(tenantId));
    }

    // Helper function to escape HTML
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    // Helper function to format numbers
    function numberFormat(number) {
        return parseFloat(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    // Function to go back (placeholder)
    function goBack() {
        alert('Back button functionality would go here');
        // In a real implementation: window.location.href = '<?= ROOT ?>reports/overdue';
    }

    // Export functions (same as in your original code)
    function exportTablesToCSV() {
        function tableToCSV(table, title) {
            let csv = title + "\n";
            const rows = table.querySelectorAll('tr');
            for (let row of rows) {
                let cols = row.querySelectorAll('th,td');
                let rowData = [];
                for (let col of cols) {
                    rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
                }
                csv += rowData.join(',') + "\n";
            }
            csv += "\n";
            return csv;
        }
        let csv = '';
        const tables = document.querySelectorAll('.table');
        const titles = ['Service Charge Due', 'Collections'];
        tables.forEach((table, idx) => {
            csv += tableToCSV(table, titles[idx]);
        });
        const blob = new Blob([csv], { type: 'text/csv' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'overdue_details.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Wait for data to load in the tables before generating PDF
    function waitForDataToLoad(callback, timeout = 5000) {
        const start = Date.now();
        function check() {
            const chargeTable = document.getElementById('Charge');
            const collectionTable = document.getElementById('collection');
            // Check if loading indicators are gone and at least one data row exists
            const chargeLoaded = chargeTable && !chargeTable.querySelector('.loading');
            const collectionLoaded = collectionTable && !collectionTable.querySelector('.loading');
            if (chargeLoaded && collectionLoaded) {
                callback();
            } else if (Date.now() - start < timeout) {
                setTimeout(check, 50);
            } else {
                // Timeout fallback: proceed anyway
                callback();
            }
        }
        check();
    }

    function exportOverdueDetailsToPDF() {
        const urlParams = new URLSearchParams(window.location.search);
        let tenantId = urlParams.get('tenant_id');
        if (!tenantId) {
            // If not in query string, try to extract from URL path after 'overduedetails/'
            const pathMatch = window.location.pathname.match(/overduedetails\/(\d+)/);
            if (pathMatch && pathMatch[1]) {
                tenantId = pathMatch[1];
            }
        }
        tenantId = tenantId || '1'; // fallback default
        fetchOverdueDetails(tenantId, function () {
            waitForDataToLoad(function () {
                const element = document.getElementById('overdue-details');
                // Remove margin/padding from container and h2
                const originalClass = element.className;
                const originalStyle = element.getAttribute('style') || '';
                element.className = originalClass.replace(/\bcontainer\b/g, '').trim();
                const h2 = element.querySelector('h2');
                // Get tenant full_name from the page (first h2)
                let fullName = '';
                if (h2) {
                    fullName = h2.textContent.replace(/^Overdue Details for\s*/i, '').trim();
                }
                let filename = 'overdue_details.pdf';
                if (fullName) {
                    filename = fullName.replace(/\s+/g, '_') + '_overdue_details.pdf';
                }
                const opt = {
                    margin: [0.1, 0.5, 0.5, 0.5], // top, right, bottom, left
                    filename: filename,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
                };
                html2pdf().set(opt).from(element).save().then(() => {
                    // Restore original class and style
                    element.className = originalClass;
                    // element.setAttribute('style', originalStyle);
                    // if (h2) h2.setAttribute('style', h2OriginalStyle);
                });
            });
        });
    }

    // Call the function with a sample tenant ID when the page loads
    // In a real implementation, you would get the tenant ID from the URL or a parameter
    document.addEventListener('DOMContentLoaded', function () {
        // Try to get tenant_id from query string first
        const urlParams = new URLSearchParams(window.location.search);
        let tenantId = urlParams.get('tenant_id');
        if (!tenantId) {
            // If not in query string, try to extract from URL path after 'overduedetails/'
            const pathMatch = window.location.pathname.match(/overduedetails\/(\d+)/);
            if (pathMatch && pathMatch[1]) {
                tenantId = pathMatch[1];
            }
        }
        tenantId = tenantId || '1'; // fallback default
        fetchOverdueDetails(tenantId);
    });
</script>
<!-- </body>

</html> -->