document.getElementById('addBtn').addEventListener('click', function () {
    // get input values
    const itemCode = document.getElementById('itemCode').value.trim();
    const itemName = document.getElementById('itemName').value.trim();
    const quantity = document.getElementById('quantity').value.trim();
    const price = document.getElementById('price').value.trim();


    if (!itemCode || !itemName || !quantity || !price || isNaN(quantity) || isNaN(price) || quantity <= 0 || price <= 0) {
        alert('Please enter valid values in all fields.');
        return;
    }

    const tbody = document.querySelector('tbody');

    const newRow = document.createElement('tr');

    const idCell = document.createElement('td');
    const nameCell = document.createElement('td');
    const quantityCell = document.createElement('td');
    const priceCell = document.createElement('td');
    const actionCell = document.createElement('td');

    idCell.textContent = itemCode;
    nameCell.textContent = itemName;
    quantityCell.textContent = quantity;
    priceCell.textContent = `$${parseFloat(price).toFixed(2)}`;

    // Edit button
    //this can be a seperate method if u want
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    editBtn.className = 'edit-btn';
    editBtn.addEventListener('click', function () {
        // Create input fields for editing
        const idInput = document.createElement('input');
        idInput.className = 'edit-input'; // Add this line
        idInput.value = itemCode;

        const nameInput = document.createElement('input');
        nameInput.className = 'edit-input'; // Add this line
        nameInput.value = itemName;

        const quantityInput = document.createElement('input');
        quantityInput.className = 'edit-input'; // Add this line
        quantityInput.value = quantity;

        const priceInput = document.createElement('input');
        priceInput.className = 'edit-input'; // Add this line
        priceInput.value = price;


        // Replace cells with input fields
        idCell.innerHTML = '';
        nameCell.innerHTML = '';
        quantityCell.innerHTML = '';
        priceCell.innerHTML = '';

        idCell.appendChild(idInput);
        nameCell.appendChild(nameInput);
        quantityCell.appendChild(quantityInput);
        priceCell.appendChild(priceInput);

        // Create a save button
        const saveBtn = document.createElement('button');
        saveBtn.textContent = 'Save';
        saveBtn.className = 'save-btn';
        actionCell.innerHTML = ''; // Clear action cell for new buttons
        actionCell.appendChild(saveBtn);
        actionCell.appendChild(deleteBtn); // Keep delete button

        // Save changes on button click
        saveBtn.addEventListener('click', function () {
            const updatedCode = idInput.value.trim();
            const updatedName = nameInput.value.trim();
            const updatedQuantity = quantityInput.value.trim();
            const updatedPrice = priceInput.value.trim();

            if (!updatedCode || !updatedName || !updatedQuantity || !updatedPrice || isNaN(updatedQuantity) || isNaN(updatedPrice) || updatedQuantity <= 0 || updatedPrice <= 0) {
                alert('Please enter valid values in all fields.');
                return;
            }

            // Update the cells with new values
            idCell.textContent = updatedCode;
            nameCell.textContent = updatedName;
            quantityCell.textContent = updatedQuantity;
            priceCell.textContent = `$${parseFloat(updatedPrice).toFixed(2)}`;

            // Reset the action cell to original state
            actionCell.innerHTML = ''; // Clear action cell
            actionCell.appendChild(editBtn); // Re-add edit button
            actionCell.appendChild(deleteBtn); // Re-add delete button

            /*
                // Prepare data to send
                const data = {
                    itemCode: updatedCode,
                    itemName: updatedName,
                    quantity: updatedQuantity,
                    price: updatedPrice
                };

                // Send data to the server
                fetch('Inventory.php', {
                    method: 'POST', // Use POST method
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data) // Send JSON data
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Assuming the server responds with JSON
                })
                .then(data => {
                    console.log('Success:', data); // Handle success response
                   
                })
                .catch(error => {
                    console.error('Error:', error); // Handle error response
                });

                 
                // Reset the action cell to original state
                actionCell.innerHTML = ''; // Clear action cell
                actionCell.appendChild(editBtn); // Re-add edit button
                actionCell.appendChild(deleteBtn); // Re-add delete button

             */

        });
    });

    // Create delete button
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';
    deleteBtn.className = 'del-btn';
    deleteBtn.addEventListener('click', function () {
        tbody.removeChild(newRow);
    });

    // Append buttons to the action cell
    actionCell.appendChild(editBtn);
    actionCell.appendChild(deleteBtn);

    // Append cells to the new row
    newRow.appendChild(idCell);
    newRow.appendChild(nameCell);
    newRow.appendChild(quantityCell);
    newRow.appendChild(priceCell);
    newRow.appendChild(actionCell);

    // Append the new row to the table body
    tbody.appendChild(newRow);

    // Clear input fields
    document.getElementById('itemCode').value = '';
    document.getElementById('itemName').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('price').value = '';
});