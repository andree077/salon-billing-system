
function searchCustomers(query) {
    $.ajax({
        url: 'search_customers.php',
        type: 'post',
        data: { query: query },
        success: function(response) {
            $('#customerList').html(response);
        }
    });
}

function fillCustomerFields(name, email, phone, gender) {
    $('#customerSearch').val(name);
    $('#customerName').val(name);
    $('#customerEmail').val(email);
    $('#customerPhone').val(phone);
    $('#customerGender').val(gender);
    $('#customerResults').hide();
    $('#addCustomerButton').hide();
    $('#customerList').hide();

}

$(document).ready(function() {
    $('#addCustomerButton').click(function() {
        var customer_name = $('#customerName').val();
        var email = $('#customerEmail').val();
        var phone = $('#customerPhone').val();
        var gender = $('#customerGender').val();

        $.ajax({
            url: 'add_customer.php',
            type: 'post',
            data: {
                customer_name: customer_name,
                email: email,
                phone: phone,
                gender: gender
            },
            success: function(response) {
                alert(response); // You can replace this with a more user-friendly message
            }
        });
    $('#addCustomerButton').hide();

    });
});

$(document).ready(function() {
    var tableVisible = false;
    // Function to add a new service row
    function addServiceRow(serviceName, serviceCost, employeeName, tips) {
        var serviceRow = $(
            '<tr>' +
            '<td>' + serviceName + '</td>' +
            '<td>' + serviceCost + '</td>' +
            '<td>' + employeeName + '</td>' +
            '<td>' + tips + '</td>' +
            '<td><button class="remove-service">Remove Service</button></td>' +
            '</tr>'
        );


        // Add click event for removing a service row
        serviceRow.find(".remove-service").click(function() {
            $(this).closest("tr").remove();
        });

        // Append the service row to the service table
        $("#serviceTable tbody").append(serviceRow);
        if (!tableVisible) {
            $("#serviceTable").show();
            tableVisible = true;
        }
    }

    // Add Service Functionality
    $("#addService").click(function() {
        var serviceName = $("#service-name").val();
        var serviceCost = $("#service-cost").val();
        var employeeName = $("#employee-name").val();
        var tips = $("#tips").val(); // Get tips value

        // Validate input before adding to the table
        if (serviceName && serviceCost && employeeName && tips) {
            addServiceRow(serviceName, serviceCost, employeeName, tips);

            // Clear input fields
            $("#service-name").val('');
            $("#service-cost").val('');
            $("#employee-name").val('');
            $("#tips").val(''); // Clear the tips field
        }
    });

    // Event delegation for dynamically added service rows
    $("#serviceTable").on("click", ".remove-service", function() {
        $(this).closest("tr").remove();
    });

    // Initialize the autocomplete for Service Name and Employee Name fields
    $(".service-name, .employee-name").on("input", function() {
        var fieldName = $(this).attr("class");
        var query = $(this).val();
        var costInput = $(this).siblings(".service-cost");
        
        // Perform the search based on the field name
        if (fieldName === "service-name") {
            searchServices(query, costInput);
        } else if (fieldName === "employee-name") {
            searchEmployees(query);
        }
    });

});

function searchServices(query, costInput) {
    $.ajax({
        url: 'search_services.php',
        type: 'post',
        data: { query: query },
        success: function(response) {
            $('#serviceList').html(response);
            $('#serviceList').show();
            costInput.val(''); // Clear the cost field when searching for a new service.
        }
    });
}

function searchEmployees(query) {
    $.ajax({
        url: 'search_employee.php',
        type: 'post',
        data: { query: query },
        success: function(response) {
            $('#employeeList').html(response);
            $('#employeeList').show();

            }
        });
}

function fillServiceFields(name, cost) {
    $('#service-name').val(name);
    $('#service-cost').val(cost);
    $('#serviceList').hide();
}

	function fillEmployeeFields(name) {
		$('#employee-name').val(name);
        $('#employeeList').hide();

	}

    function generateInvoice(customerName, customerEmail, customerPhone, customerGender, serviceRows) {
        // Calculate the total bill
        var totalBill = 0;
        for (var i = 0; i < serviceRows.length; i++) {
          totalBill += serviceRows[i].serviceCost;
        }
      
        // Calculate the GST tax
        var gstTax = totalBill * 0.18;
      
        // Calculate the tip
        var tip = totalBill * 0.15;
      
        // Calculate the final amount
        var finalAmount = totalBill + gstTax + tip;
      
        // Generate the invoice
        var invoice = `
          <h1>Invoice</h1>
      
          <p>
            Customer Name: ${customerName}
          </p>
      
          <p>
            Customer Email: ${customerEmail}
          </p>
      
          <p>
            Customer Phone: ${customerPhone}
          </p>
      
          <p>
            Customer Gender: ${customerGender}
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
              ${serviceRows.map((serviceRow) => {
                return `
                  <tr>
                    <td>${serviceRow.serviceName}</td>
                    <td>${serviceRow.serviceCost}</td>
                    <td>${serviceRow.employeeName}</td>
                    <td>${serviceRow.tips}</td>
                  </tr>
                `;
              })}
            </tbody>
          </table>
      
          <p>
            Total Bill: ${totalBill}
          </p>
      
          <p>
            GST Tax (18%): ${gstTax}
          </p>
      
          <p>
            Tip: ${tip}
          </p>
      
          <p>
            Final Amount: ${finalAmount}
          </p>
        `;
      
        return invoice;
      }
      $("#generateInvoice").click(function() {
        // Get the customer information and service details from the form
        var customerName = $("#customerName").val();
        var customerEmail = $("#customerEmail").val();
        var customerPhone = $("#customerPhone").val();
        var customerGender = $("#customerGender").val();
      
        var serviceRows = [];
        $(".service-row").each(function() {
          serviceRows.push({
            serviceName: $(this).find(".service-name").val(),
            serviceCost: $(this).find(".service-cost").val(),
            employeeName: $(this).find(".employee-name").val(),
            tips: $(this).find(".tips").val()
          });
        });
      
        // Make an AJAX request to the server to generate the invoice
        $.ajax({
            url: "generate_invoice.php",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
              customerName: customerName,
              customerEmail: customerEmail,
              customerPhone: customerPhone,
              customerGender: customerGender,
              serviceRows: serviceRows
            }),
            success: function(response) {
              // Display the invoice to the user
              $("#invoice").html(response);
            }
          });
          
      });
      
