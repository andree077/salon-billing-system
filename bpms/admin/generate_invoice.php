<?php

// Get the customer information and service details from the AJAX request
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$customerPhone = $_POST['customerPhone'];
$customerGender = $_POST['customerGender'];

$serviceRows = $_POST['serviceRows'];

// Calculate the total bill
$totalBill = 0;
foreach ($serviceRows as $serviceRow) {
  $totalBill += $serviceRow['service_cost'];
}

// Calculate the GST tax
$gstTax = $totalBill * 0.18;

// Calculate the tip
$tip = $totalBill * 0.15;

// Calculate the final amount
$finalAmount = $totalBill + $gstTax + $tip;

// Generate the invoice
$invoice = <<<HTML
  <h1>Invoice</h1>

  <p>
    Customer Name: $customerName
  </p>

  <p>
    Customer Email: $customerEmail
  </p>

  <p>
    Customer Phone: $customerPhone
  </p>

  <p>
    Customer Gender: $customerGender
  </p>

  <h2>Service Details</h2>

  <table>
    <thead>
      <tr>
        <th>Service Name</th>
        <th>Service Cost</th>
        <th>Employee Name</th>
        <th>Tips</th>
      </tr>
    </thead>

    <tbody>
      %foreach ($serviceRows as $serviceRow)
        <tr>
          <td>$serviceRow['service_name']</td>
          <td>$serviceRow['service_cost']</td>
          <td>$serviceRow['employee_name']</td>
          <td>$serviceRow['tips']</td>
        </tr>
      %endforeach
    </tbody>
  </table>

  <p>
    Total Bill: $totalBill
  </p>

  <p>
    GST Tax (18%): $gstTax
  </p>

  <p>
    Tip: $tip
  </p>

  <p>
    Final Amount: $finalAmount
  </p>
HTML;

// Display the invoice
echo $invoice;
