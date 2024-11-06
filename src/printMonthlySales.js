function generateBill() {
    const currentDate = new Date().toLocaleDateString();

    const itemsTable = document.getElementById('sales-table');
    let itemsHTML = '';
    let totalAmount = 0;

    for (let row of itemsTable.rows) {

        if (row.rowIndex === 0) continue;

        // Access each cell's text content (index-based)
        const date = row.cells[0].innerText;
        const id = row.cells[1].innerText;
        const name = row.cells[2].innerText;
        const price = parseFloat(row.cells[3].innerText);
        const quantity = parseInt(row.cells[4].innerText);
        const total = parseFloat(row.cells[5].innerText);

        totalAmount += total;

        itemsHTML += `
            <tr>
                <td>${id}</td>
                <td>${name}</td>
                <td>${quantity}</td>
                <td>${price.toFixed(2)}</td>
                <td>${total.toFixed(2)}</td>
            </tr>
        `;
    }

    // Prepare the content of the bill
    const billContent = `
        <div style="text-align: center;">
            <h2>CHANDREASEKARA BOOK SHOP</h2>
            <h3>Report Generated Date: ${currentDate}</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${itemsHTML}
                </tbody>
            </table>
            <h3>Total Sales In This Month: Rs ${totalAmount.toFixed(2)}</h3>
        </div>
    `;

    // Open a new window to display the bill content for printing
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Bill</title>');
    printWindow.document.write('<style>body { font-family: Arial; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(billContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
