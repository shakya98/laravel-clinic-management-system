<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</head>

<body>
    <div class="container">
        <h1 class="d-flex align-items-center justify-content-center">Homepage</h1>

        <!-- Section 1: Add Patient Form -->
        <div class="section my-5" id="section1">
            <h2 class="d-flex align-items-center justify-content-center">Add Patient</h2>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6 my-4">
                    <form id="addPatientForm" action="{{ route('api.addPatient') }}" method="POST">
                        @csrf
                        <div class="form-group my-1">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="birthday">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="contact_no">Contact No:</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="photo">Photo:</label>
                            <input type="text" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="nic">NIC:</label>
                            <input type="text" class="form-control" id="nic" name="nic" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Add Patient</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Section 2: View All Patients -->
        <section class="my-5" id="viewAllPatientsSection">
            <h2 class="d-flex align-items-center justify-content-center">View All Patients</h2>
            <table class="table" id="patientsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Contact No</th>
                        <th>Photo</th>
                        <th>NIC</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="patientsTableBody">
                </tbody>
            </table>
        </section>

        <!-- Section 3: Get Total Bill Amount -->
        <section class="my-5" id="getTotalBillAmountSection">
            <h2 class="d-flex align-items-center justify-content-center">Get Total Bill Amount</h2>
            <div class="row">
                <div class="col-md-6">
                    <form id="getTotalBillAmountForm" method="POST">
                        @csrf
                        <div class="mb-3 my-1">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3 my-1">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Get Total Bill Amount</button>
                    </form>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div id="totalBillAmountDiv"></div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Record Modal -->
    <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Add Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRecordForm" method="POST">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group my-1">
                            <label for="record">Record:</label>
                            <textarea class="form-control" id="record" name="record" rows="3" required></textarea>
                        </div>
                        <div class="form-group my-1">
                            <label for="prescription">Prescription:</label>
                            <textarea class="form-control" id="prescription" name="prescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group my-1">
                            <label for="total_bill">Total Bill:</label>
                            <input type="number" class="form-control" id="total_bill" name="total_bill" required>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>