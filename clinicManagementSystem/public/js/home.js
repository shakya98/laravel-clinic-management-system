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
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $("#totalBillAmountDiv").text("Total revenue is: " + response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                $("#totalBillAmountDiv").text("Add a valid range");
            },
        });
    });
});
