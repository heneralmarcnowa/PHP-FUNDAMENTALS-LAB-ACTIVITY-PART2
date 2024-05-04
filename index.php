<?php
$prices = array(
    "Fishball" => 30,
    "Kikiam" => 40,
    "Corndog" => 50
);

$error = null;
$output = null;
$formSubmitted = isset($_POST['submit']);
$quantity = '';
$cash = '';

if ($formSubmitted) {
    $order = isset($_POST['order']) ? $_POST['order'] : "";
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
    $cash = isset($_POST['cash']) ? $_POST['cash'] : 0;

    if (isset($order) && !array_key_exists($order, $prices)) {
        $error = "Invalid order selection.";
    } elseif (!is_numeric($quantity) || $quantity <= 0) {
        $error = "Please enter a valid quantity (positive integer).";
    } elseif (!is_numeric($cash) || $cash < 0) {
        $error = "Please enter a valid cash amount (non-negative).";
    } else {
        $totalCost = $prices[$order] * $quantity;
        $change = $cash - $totalCost;
        $output = "<h2>The total cost is $totalCost</h2>";
        $output .= "\n"; 
        $output .= "<h2>Your change is $change</h2>";
        $output .= "\n"; 
        $output .= "<p>Thanks for the order!</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
<?php if (!$formSubmitted) { ?>
    <h2>Welcome to the canteen! Here are the prices</h2>
    <ul>
        <li>Fishball - <?php echo $prices["Fishball"]; ?> PHP</li>
        <li>Kikiam - <?php echo $prices["Kikiam"]; ?> PHP</li>
        <li>Corndog - <?php echo $prices["Corndog"]; ?> PHP</li>
    </ul>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div>
            <label for="order">Choose your order:</label><br>
            <select name="order" id="order">
                <option value="Fishball">Fishball</option>
                <option value="Kikiam">Kikiam</option>
                <option value="Corndog">Corndog</option>
            </select>
        </div>
        <br>
        <div>
            <label for="quantity">Quantity:</label><br>
            <input type="text" name="quantity" id="quantity" min="1" value="<?php echo $quantity; ?>" pattern="[0-9]+">
        </div>
        <br>
        <div>
            <label for="cash">Cash:</label><br>
            <input type="text" name="cash" id="cash" min="0" value="<?php echo $cash; ?>" pattern="[0-9]+">
        </div>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
<?php } elseif (isset($error)) { ?>
    <p style="color: red;">Error: <?php echo $error; ?></p>
<?php } elseif (isset($output)) { ?>
    <?php echo $output; ?>
<?php } ?>
</body>
</html>
