document.querySelector('.add-btn').addEventListener('click', function () {

    const itemId = document.getElementById('item-id').value;
    const quantityToAdd = parseInt(document.getElementById('quantity').value);

    let itemfound = true;

    if (itemfound) {
        // get the table body
        const tbody = document.querySelector('tbody');

        // Create a new row
        const newRow = document.createElement('tr');

        // Create cells for the new row
        const idCell = document.createElement('td');
        const nameCell = document.createElement('td');
        const quantityCell = document.createElement('td');
        const priceCell = document.createElement('td');
        const deleteCell = document.createElement('td');

        // Set the content for the new cells
        idCell.textContent = itemId;
        nameCell.textContent = 'itemName';//for test purpose i add the this default name sudda
        quantityCell.textContent = quantityToAdd;
        priceCell.textContent = ((10) * (quantityToAdd)).toFixed(2); //i add 10 as default price for test bro

        // Create a delete button
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = '🗑️';
        deleteBtn.className = 'delete-btn';
        deleteBtn.addEventListener('click', function () {
            tbody.removeChild(newRow);
        });

        // Append cells to the new row
        deleteCell.appendChild(deleteBtn);
        newRow.appendChild(idCell);
        newRow.appendChild(nameCell);
        newRow.appendChild(quantityCell);
        newRow.appendChild(priceCell);
        newRow.appendChild(deleteCell);

        // Append the new row to the table body
        tbody.appendChild(newRow);
    } else {
        alert(`item id ${item - id} not found`)
    }

});

//we can use this code to search item and add to table
/*
document.querySelector('.add-btn').addEventListener('click', function () {
    const itemId = document.getElementById('item-id').value;
    const quantityToAdd = parseInt(document.getElementById('quantity').value);

    // Fetch item details from the server
    fetch(`Bill_Search.php?item=${encodeURIComponent(itemId)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(item => {
            if (item) {
                
                const tbody = document.querySelector('tbody');

                
                const newRow = document.createElement('tr');

                
                const idCell = document.createElement('td');
                const nameCell = document.createElement('td');
                const quantityCell = document.createElement('td');
                const priceCell = document.createElement('td');
                const deleteCell = document.createElement('td');

                
                idCell.textContent = item.id;
                nameCell.textContent = item.name; // Use the actual item name from the database
                quantityCell.textContent = quantityToAdd;
                priceCell.textContent = (item.price * quantityToAdd).toFixed(2);

                // Create a delete button
                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = '🗑️';
                deleteBtn.className = 'delete-btn';
                deleteBtn.addEventListener('click', function () {
                    tbody.removeChild(newRow);
                });

                // Append cells to the new row
                deleteCell.appendChild(deleteBtn);
                newRow.appendChild(idCell);
                newRow.appendChild(nameCell);
                newRow.appendChild(quantityCell);
                newRow.appendChild(priceCell);
                newRow.appendChild(deleteCell);

                // Append the new row to the table body
                tbody.appendChild(newRow);
            } else {
                alert(`Item ID ${itemId} not found`);
            }
        })
        .catch(error => {
            console.error('Error fetching item:', error);
            alert('An error occurred while fetching item details. Please try again.');
        });
});
*/

//bill total calculation part
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.cal-btn').addEventListener('click', function () {
        let totprice = 0;

        const tbody = document.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.forEach(row => {
            const priceCell = row.cells[3];
            totprice += parseFloat(priceCell.textContent) || 0; 
        });

        document.getElementById('total-amount').textContent = totprice.toFixed(2);
        
        originalPrice = totprice;

    });
});


//discount calculation part
let originalPrice = 0;

document.querySelector('.cal-discount-btn').addEventListener('click', function () {
    const discountInput = document.getElementById('discount-input').value;
    
    const discountPercentage = parseFloat(discountInput);

    // validate the input
    if (isNaN(discountPercentage) || discountPercentage < 0) {
        alert('Please enter a valid discount percentage');
        return;
    }

    // calculate the discounted price
    const discountAmount = (originalPrice * (discountPercentage / 100));
    const discountedPrice = originalPrice - discountAmount;

    // display the dis price
    document.getElementById('discounted-price').textContent = discountedPrice.toFixed(2);

    //update the ttal bill
    document.getElementById('total-bill').textContent = discountedPrice.toFixed(2);
});


//payment calculate part
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.cal-expences-btn').addEventListener('click', function () {
        // Get values from input fields
        const numberOfWorkers = parseInt(document.getElementById('numberofworkers').value);
        const paymentPerPerson = parseFloat(document.getElementById('payment').value);
        
        // Validate the input
        if (isNaN(numberOfWorkers) || numberOfWorkers < 0) {
            alert('Please enter a valid number of workers');
            return;
        }
        if (isNaN(paymentPerPerson) || paymentPerPerson < 0) {
            alert('Please enter a valid payment amount');
            return;
        }

        // Calculate total payment
        const totalPayment = numberOfWorkers * paymentPerPerson;

        // Display the total payment
        document.getElementById('total-payment').textContent = totalPayment.toFixed(2);

        totalPayment = workermoney;
    });
});


//fuel expence calculation part
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.cal-fuel-btn').addEventListener('click', function () {
        // Get values from input fields
        const distance = parseFloat(document.getElementById('distance').value);
        const fuelPerKm = parseFloat(document.getElementById('fuelforone').value);
        const pricePerLiter = parseFloat(document.getElementById('fuelprice').value);

        // Validate the input
        if (isNaN(distance) || distance < 0) {
            alert('Please enter a valid distance');
            return;
        }
        if (isNaN(fuelPerKm) || fuelPerKm < 0) {
            alert('Please enter a valid fuel consumption per KM');
            return;
        }
        if (isNaN(pricePerLiter) || pricePerLiter < 0) {
            alert('Please enter a valid fuel price');
            return;
        }

        // Calculate total fuel cost
        const totalFuelNeeded = distance / fuelPerKm;
        const totalFuelPrice = totalFuelNeeded * pricePerLiter;

        // Display the total fuel price
        document.getElementById('total-fuel-price').textContent = totalFuelPrice.toFixed(2);

        totalFuelPrice = fuelmoney;
    });
});


//total expencses

document.addEventListener('DOMContentLoaded', function() {
    // Function to calculate total expenses
    function calculateTotalExpenses() {
        // Example values; replace these with your calculations
        const fuelmoney = parseFloat(document.getElementById('total-fuel-price').textContent) || 0;
        const workermoney = parseFloat(document.getElementById('total-payment').textContent) || 0;

        const totalExpenses = fuelmoney + workermoney;

        // Update total expenses display
        document.getElementById('total-expenses').textContent = totalExpenses.toFixed(2);
    }

    // Add event listeners to your calculation buttons
    document.querySelector('.cal-expences-btn').addEventListener('click', calculateTotalExpenses);
    document.querySelector('.cal-fuel-btn').addEventListener('click', calculateTotalExpenses);
});


//discard button and print
document.addEventListener('DOMContentLoaded', function() {
    
    function clearAll() {
        const okmessage = confirm("Are you sure you want to clear all calculations?");
        
        if (okmessage) {
            
            location.reload();
        }
    }
    document.querySelector('.discard-btn').addEventListener('click', clearAll);
});

//bill generate

function generateBill() {
    // Get the current date
    const currentDate = new Date().toLocaleDateString();

    // Get the table of items
    const itemsTable = document.getElementById('bill-items');
    let itemsHTML = '';
    let totalAmount = 0;

    // Loop through table rows to create bill items
    for (let row of itemsTable.rows) {
        const id = row.cells[0].innerText;
        const name = row.cells[1].innerText;
        const quantity = row.cells[2].innerText;
        const price = row.cells[3].innerText;

        // Calculate total price
        totalAmount += parseFloat(price) * parseInt(quantity);

        // Create a row for the bill
        itemsHTML += `
            <tr>
                <td>${id}</td>
                <td>${name}</td>
                <td>${quantity}</td>
                <td>${price}</td>
            </tr>
        `;
    }

    // Create the bill content
    const billContent = `
        <div style="text-align: center;">
            <h2>CHANDREASEKARA BOOK SHOP</h2>
            <h3>Bill Date: ${currentDate}</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    ${itemsHTML}
                </tbody>
            </table>
            <h3>Total Amount: Rs ${totalAmount.toFixed(2)}</h3>
        </div>
    `;

    // Open a new window for printing
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Bill</title>');
    printWindow.document.write('<style>body { font-family: Arial; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(billContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

