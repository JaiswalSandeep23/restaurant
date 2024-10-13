<?php include './conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #F2F0EA;
        }
        .bill-container {
            width: 400px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
            text-align: center;
            border-radius: 20px;

        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
        }
        th {
            text-align: left;
        }
        td.price {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
        }
        /* Print Button */
        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-weight: 800;
        
            cursor: pointer;
            border-radius: 10px;
            border: 2px solid #000;
        }
        .print-btn:hover {
            background-color: #45a049;
        }
        /* Print style */
        @media print {
            .print-btn {
                display: none;
            }
        }
        
    </style>
</head>
<body>
    <div class="bill-container">
       <div class="layer">
       <h1 style="text-transform: uppercase;">Hotel Alpha & Guest House</h1>
        <h2 style="text-transform: uppercase;">Nana pondha vapi road, opp. masjid, ta, kaparada, dist. valsad.</h2>
        <h3 style="text-transform: uppercase;">mo: 9925444476</h3>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
            </tr>
            <?php
            include './conn.php';

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $iteam = $_POST['item'];
                $qty = $_POST['quantity'];
                $price = $_POST['price'];
                $total = $_POST['totalAmount'];
                $menu = "";
                // Get current date and time using PHP date function
                $currentDate = date('Y-m-d');  // Format for date (e.g., 2024-10-12)
                $currentTime = date('H:i:s');  // Format for time (e.g., 14:30:59)
                for ($i = 0; $i < count($iteam); $i++) {
                    // Append each item, quantity, and price to the menu string
                    $menu .= "$iteam[$i] ( X$qty[$i] ) - $price[$i], ";
                    
                    ?>
                    <tr>
                        <td><?php echo "$iteam[$i] ( X$qty[$i] )"; ?></td>
                        <td class="price"><?php echo $price[$i]; ?></td>
                    </tr>
                    <?php
                }

                // Trim the last comma and space from the $menu string
                $menu = rtrim($menu, ', ');
                $query = "INSERT INTO `bill`( `Iteams`, `Total`, `Date`, `Time`) VALUES ('$menu','$total','$currentDate','$currentTime')";

            //    $res = mysqli_query($conn,$query);

               

            }
            ?>
            <tr class="total-row">
                <td>Total</td>
                <td class="price"><?php echo $total; ?></td>
            </tr>
        </table>
           <div style="width: 100%; display: flex;
    justify-content: space-between;
    margin-top: 66px;">
<p></p>
<h2 style="border-top:2px solid #000; width: 191px;">Authorized Sign</h2>
           </div>
        <!-- Print Button -->
        <button class="print-btn" onclick="window.print()">Print</button>
       </div>
    </div>
</body>
</html>
