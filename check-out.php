<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style type="text/css">body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

h2 {
    color: #333;
}

.warning {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.warning a {
    color: #721c24;
    text-decoration: underline;
}

.product {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.product img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.product-info {
    flex: 1;
}

.price {
    color: #333;
    font-weight: bold;
}

.total, .payment-methods {
    margin-top: 20px;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}
</style>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll(".item-checkbox");
    const totalAmount = document.getElementById("total-amount");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", updateTotal);
    });

    function updateTotal() {
        let total = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute("data-price"));
            }
        });
        totalAmount.textContent = total.toFixed(2);
    }

    document.getElementById("purchase-form").addEventListener("submit", function(event) {
        event.preventDefault();
        alert("Form submitted!");
    });
});

</script>
<body>
    <div class="container">
        <h1>Purchase Order</h1>
        <p>What would you like to purchase?</p>
        <form id="purchase-form">
            <div class="billing-address">
                <h2>Billing Address</h2>
                <p>Choose your Address:</p>
                <!-- Add your address selection fields here -->
            </div>
            <div class="products">
                <h2>My Products</h2>
                <div class="warning">
                    <p>⚠️ You haven't finished configuring this payment integration.</p>
                    <p>Go to <a href="#">Payment Settings</a> to configure your payment details and products.</p>
                </div>
                <div class="product">
                    <input type="checkbox" class="item-checkbox" data-price="5.00" id="cap">
                    <label for="cap">
                        <img src="img/cap.png" alt="Cap">
                        <div class="product-info">
                            <h3>Cap</h3>
                            <p>This product is made from at least 50% recycled polyester fiber.</p>
                        </div>
                        <span class="price">$5.00</span>
                    </label>
                </div>
                <div class="product">
                    <input type="checkbox" class="item-checkbox" data-price="9.00" id="hoodie">
                    <label for="hoodie">
                        <img src="img/hoodie.png" alt="Hoodie">
                        <div class="product-info">
                            <h3>Hoodie</h3>
                            <p>Durably stitched surfaces, clean finishes and the perfect amount of shine to make you dazzle.</p>
                        </div>
                        <span class="price">$9.00</span>
                    </label>
                </div>
            </div>
            <div class="total">
                <p>Total: $<span id="total-amount">0.00</span></p>
            </div>
            <div class="payment-methods">
                <h2>Payment Methods</h2>
                <input type="radio" name="payment-method" value="card" id="card">
                <label for="card">Debit or Credit Card</label>
                <br>
                <input type="radio" name="payment-method" value="paypal" id="paypal">
                <label for="paypal">PayPal</label>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
