<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

session_start();
require 'db_connection.php';

// Get the order ID from the URL
$orderID = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($orderID <= 0) {
    die('Invalid order ID');
}

// Fetch the order details including total amount and date_delivered
$orderQuery = "
   SELECT 
    o.*, 
    a.first_name, 
    a.last_name, 
    a.address, 
    a.zip_code, 
    a.region, 
    a.city_municipality, 
    a.province, 
    a.contact_number,
    SUM(oi.quantity * oi.price) AS total_amount,
    o.date_delivered
FROM orders o 
JOIN users_delivery_address a ON o.address_id = a.address_id 
JOIN order_items oi ON o.order_id = oi.order_id
WHERE o.order_id = ?
GROUP BY o.order_id
";
$orderStmt = mysqli_prepare($conn, $orderQuery);
mysqli_stmt_bind_param($orderStmt, "i", $orderID);
mysqli_stmt_execute($orderStmt);
$orderResult = mysqli_stmt_get_result($orderStmt);
$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    die('Order not found');
}

// Fetch the order items and related product details
$itemsQuery = "
  SELECT 
    oi.*, 
    p.name AS product_name, 
    p.product_details, 
    p.serial_id, 
    p.main_image,
    oi.size
FROM order_items oi 
JOIN product p ON oi.serial_id = p.serial_id 
WHERE oi.order_id = ?";
$itemsStmt = mysqli_prepare($conn, $itemsQuery);
mysqli_stmt_bind_param($itemsStmt, "i", $orderID);
mysqli_stmt_execute($itemsStmt);
$itemsResult = mysqli_stmt_get_result($itemsStmt);

// Initialize an empty array to store order item data
$orderItems = [];
while ($item = mysqli_fetch_assoc($itemsResult)) {
    $orderItems[] = $item;
}

// Create an instance of Dompdf
$dompdf = new Dompdf();

// Get current date
$currentDate = date('Y-m-d');

// Create HTML content for the PDF
$html = '<p align="right">Date: ' . $currentDate . '</p>';
$html .= '<h1 align="center">Dime Footwear</h1>';
$html .= '<p style="font-size:20px;" align="center">Order Slip</p>';
$html .= '<hr>';
$html .= '<h2>Order Details</h2>';
$html .= '<p><strong>Order ID:</strong> ' . $order['order_id'] . '</p>';
$html .= '<p><strong>Customer Name:</strong> ' . $order['first_name'] . ' ' . $order['last_name'] . '</p>';
$html .= '<p><strong>Address:</strong> ' . $order['address'] . '</p>';
$html .= '<p><strong>City:</strong> ' . $order['city_municipality'] . '</p>';
$html .= '<p><strong>Province:</strong> ' . $order['province'] . '</p>';
$html .= '<p><strong>Zip Code:</strong> ' . $order['zip_code'] . '</p>';
$html .= '<p><strong>Contact Number:</strong> ' . $order['contact_number'] . '</p>';
$html .= '<p><strong>Order Date:</strong> ' . $order['order_date'] . '</p>';
$html .= '<p><strong>Status:</strong> ' . $order['status'] . '</p>';
// Include date_delivered if available
if ($order['status'] === 'Returned') {
    $html .= '<p><strong>Date Returned:</strong> ' . $order['date_delivered'] . '</p>';
}
$html .= '<hr>';

$html .= '<h2>Ordered Item/s</h2>';
foreach ($orderItems as $item) {
    $html .= '<div class="order-item-box">';
    $html .= '<p><strong>Serial ID:</strong> ' . $item['serial_id'] . '</p>';
    $html .= '<p><strong>Product Name:</strong> ' . $item['product_name'] . '</p>';
    $html .= '<p><strong>Size:</strong> ' . $item['size'] . '</p>';
    $html .= '<p><strong>Quantity:</strong> ' . $item['quantity'] . '</p>';
    $html .= '<p><strong>Price:</strong> $' . $item['price'] . '</p>';
    $html .= '</div>';
}
$html .= '<hr>';
$html .= '<h2><strong>Total Amount:</strong> $' . $order['total_amount'] . '</h2>';
$html .= '<p align="center"><strong>"Where Every Shoe is a Perfect Fit at DimeFootwear"</p>';
// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// (Optional) Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('order_slip.pdf', ['Attachment' => 0]);
?>
