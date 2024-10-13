<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #F2F0EA;
           
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            
        }
        table, th, td {
            border: 1px solid #000;
            
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        .new-bill-btn {
            background-color: #007bff;
        }
        .new-bill-btn:hover {
            background-color: #0056b3;
        }
        form{
            background-color: #A8D5E3;
            padding: 10px ;
            border-radius: 10px;
            box-shadow: 0 0 20px  11px silver;
        }
    </style>
</head>
<body>

<h2>Hotel Alpla & Guest House Bill</h2>

<form id="billForm" action="Bill_Page.php" method="post">
    <table id="itemsTable">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price per Unit</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="item[]" required></td>
                <td><input type="number" name="quantity[]" min="1" value="1" required></td>
                <td><input type="number" name="price[]" step="0.01" min="0" required></td>
                <td><input type="text" name="totalPrice[]" readonly></td>
                <td><button type="button" onclick="removeItem(this)">Remove</button></td>
            </tr>
        </tbody>
    </table>

    <button type="button" onclick="addItem()">Add Item</button><br><br>

    
    <label for="totalAmount">Total Amount :</label>
    <input type="text" id="totalAmount" name="totalAmount" readonly><br><br>


    <button type="submit">Submit Bill</button>
    <button type="button" class="new-bill-btn" onclick="newBill()">New Bill</button>
</form>

<script>
    function addItem() {
        const table = document.getElementById('itemsTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        const itemCell = newRow.insertCell(0);
        const quantityCell = newRow.insertCell(1);
        const priceCell = newRow.insertCell(2);
        const totalCell = newRow.insertCell(3);
        const actionCell = newRow.insertCell(4);

        itemCell.innerHTML = '<input type="text" name="item[]" required>';
        quantityCell.innerHTML = '<input type="number" name="quantity[]" min="1" value="1" required>';
        priceCell.innerHTML = '<input type="number" name="price[]" step="0.01" min="0" required>';
        totalCell.innerHTML = '<input type="text" name="totalPrice[]" readonly>';
        actionCell.innerHTML = '<button type="button" onclick="removeItem(this)">Remove</button>';
    }

    function removeItem(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        const rows = document.querySelectorAll('#itemsTable tbody tr');
        rows.forEach(row => {
            const quantity = row.querySelector('input[name="quantity[]"]').value;
            const price = row.querySelector('input[name="price[]"]').value;
            const totalPriceField = row.querySelector('input[name="totalPrice[]"]');
            const totalPrice = quantity * price;

            totalPriceField.value = totalPrice.toFixed(2);
            total += totalPrice;
        });

        document.getElementById('totalAmount').value = total.toFixed(2);

        
        //* Calculate the grand total including tax

        const tax = document.getElementById('tax').value;
        const grandTotal = total + (total * (tax / 100));
        document.getElementById('grandTotal').value = grandTotal.toFixed(2);
    }

    document.getElementById('billForm').addEventListener('input', calculateTotal);

    function newBill() {
        document.getElementById('billForm').reset();
        const tableBody = document.querySelector('#itemsTable tbody');
        tableBody.innerHTML = `
            <tr>
                <td><input type="text" name="item[]" required></td>
                <td><input type="number" name="quantity[]" min="1" value="1" required></td>
                <td><input type="number" name="price[]" step="0.01" min="0" required></td>
                <td><input type="text" name="totalPrice[]" readonly></td>
                <td><button type="button" onclick="removeItem(this)">Remove</button></td>
            </tr>
        `;
        document.getElementById('totalAmount').value = '';
        document.getElementById('grandTotal').value = '';
    }
</script>

</body>
</html>
