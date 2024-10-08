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
});

