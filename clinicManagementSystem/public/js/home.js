$(document).ready(function () {
    // Function to load all patients
    function loadPatients() {
        $.ajax({
            url: "/api/getPatients",
            method: "GET",
            success: function (response) {
                console.log(response);
                $("#patientsTableBody").empty();
                $.each(response, function (index, patient) {
                    var row = `
                        <tr>
                            <td>${patient.id}</td>
                            <td>${patient.name}</td>
                            <td>${patient.birthday}</td>
                            <td>${patient.contact_no}</td>
                            <td>${patient.photo}</td>
                            <td>${patient.nic}</td>
                            <td>${patient.notes}</td>
                            <td>
                                <button class="btn btn-primary add-record-btn" data-id="${patient.id}" data-bs-toggle="modal" data-bs-target="#addRecordModal">Add Record</button>
                            </td>
                            
                        </tr>
                    `;
                    $("#patientsTable").append(row);
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    }

    loadPatients();

    // Add Patient Form Submit
    $("#addPatientForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        var method = form.attr("method");
        var data = form.serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (response) {
                console.log(response);
                form[0].reset();
                alert("Patient added successfully");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                // Handle error response here
            },
        });
    });

    // Event delegation for "Add Record" button
    $(document).on("click", ".add-record-btn", function () {
        const id = $(this).data("id");
        $("#addRecordModal").data("id", id);
        $("#addRecordForm").attr("action", `/api/addRecord/${id}`);
        $("#addRecordModal").modal("show");
        console.log(id);
    });

    // Add Record Form Submit
    $("#addRecordForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();
        var id = $("#addRecordModal").data("id");

        $.ajax({
            type: "POST",
            url: `/api/addRecord/${id}`,
            data: data,
            success: function (response) {
                console.log(response);
                form[0].reset();
                alert("Record added successfully");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    // Get Total Bill Amount Form Submit
    $("#getTotalBillAmountForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            type: "POST",
            url: `api/getTotalBillAmount`,
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response);
                var totalBillAmountData = response.totalBillData;
                var totalBillSum = response.totalBillSum;

                var tableHtml = '<table class="table">';
                tableHtml +=
                    "<tr><th>Patient Name</th><th>Record ID</th><th>Prescription ID</th><th>Total Bill</th></tr>";

                for (var i = 0; i < totalBillAmountData.length; i++) {
                    var record = totalBillAmountData[i];
                    tableHtml += "<tr>";
                    tableHtml += "<td>" + record.patient_name + "</td>";
                    tableHtml += "<td>" + record.record_id + "</td>";
                    tableHtml += "<td>" + record.prescription_id + "</td>";
                    tableHtml += "<td>" + record.total_bill + "</td>";
                    tableHtml += "</tr>";
                }

                tableHtml += "</table>";

                $("#totalBillAmountDiv").html(tableHtml);

                $("#totalBillAmountDiv").append(
                    '<p class="my-5">Total Bill Sum: ' + totalBillSum + "</p>"
                );
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                $("#totalBillAmountDiv").text("Add a valid range");
            },
        });
    });
});
