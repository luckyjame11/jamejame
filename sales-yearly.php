<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Create an instance of Dompdf
$dompdf = new Dompdf();
$currentDate = date('d F Y');
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "dimefootwear";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the selected inputs from the form
$year = isset($_POST['year']) ? intval($_POST['year']) : null;

// Validate input value
if (!$year) {
    die("Invalid input value.");
}

// HTML content to display the sales data
$html = '<p align="right">Date: ' . $currentDate . '</p>';
$html .= '<h1 align="center">Dime Footwear</h1>';
$html .= '<hr>';
$html .= '<h2>YEARLY INVOICE REPORT (' . $year . ')</h2>';

// SQL query to fetch delivered orders and calculate total income
$sql_delivered = "SELECT 
    MONTHNAME(orders.order_date) AS month, 
    product.name AS product_name,
    order_items.quantity,
    order_items.price,
    SUM(order_items.price * order_items.quantity) AS total_income
FROM 
    orders 
JOIN 
    order_items ON orders.order_id = order_items.order_id 
JOIN 
    product ON order_items.serial_id = product.serial_id 
WHERE 
    YEAR(orders.order_date) = $year
    AND orders.status = 'Delivered'
GROUP BY 
    MONTH(orders.order_date), product.serial_id";

$result_delivered = $conn->query($sql_delivered);

// Check if any delivered orders were returned
if ($result_delivered && $result_delivered->num_rows > 0) {
    // Output data of each delivered order
    $html .= '<h3>Delivered Orders</h3>';
    $html .= '<table border="1">
                <tr>
                    <th>Month</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Income</th>
                </tr>';

    while ($row = $result_delivered->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row["month"] . '</td>
                    <td>' . $row["product_name"] . '</td>
                    <td>' . $row["quantity"] . '</td>
                    <td>$' . $row["price"] . '</td>
                    <td>$' . $row["total_income"] . '</td>
                </tr>';
    }

    $html .= '</table>';
} else {
    $html .= '<p>No delivered orders found for the specified year.</p>';
}

// SQL query to fetch returned orders and calculate total deduction
$sql_returned = "SELECT 
    MONTHNAME(orders.order_date) AS month, 
    product.name AS product_name,
    order_items.quantity,
    order_items.price,
    SUM(order_items.price * order_items.quantity) AS total_deduction
FROM 
    orders 
JOIN 
    order_items ON orders.order_id = order_items.order_id 
JOIN 
    product ON order_items.serial_id = product.serial_id 
WHERE 
    YEAR(orders.order_date) = $year
    AND orders.status = 'Returned'
GROUP BY 
    MONTH(orders.order_date), product.serial_id";

$result_returned = $conn->query($sql_returned);

// Check if any returned orders were found
if ($result_returned && $result_returned->num_rows > 0) {
    // Output data of each returned order
    $html .= '<h3>Returned Orders</h3>';
    $html .= '<table border="1">
                <tr>
                    <th>Month</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Deduction</th>
                </tr>';

    while ($row = $result_returned->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row["month"] . '</td>
                    <td>' . $row["product_name"] . '</td>
                    <td>' . $row["quantity"] . '</td>
                    <td>$' . $row["price"] . '</td>
                    <td>$' . $row["total_deduction"] . '</td>
                </tr>';
    }

    $html .= '</table>';
} else {
    $html .= '<p>No returned orders found for the specified year.</p>';
}

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// (Optional) Set the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream("sales_report.pdf", array("Attachment" => false));

// Close the database connection
$conn->close();
?>
