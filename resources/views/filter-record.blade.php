<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spirosys - Task 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container card p-3 mt-4">
        <div class="row mb-3">
            <div class="col text-end">
                <a href="/" class='btn btn-success' style="width: 200px;"> View Task 1</a>
            </div>
        </div>
        <div class="card-title bg-primary-subtle p-1">
            <h2 class="text-center">Task 2</h2>
        </div>
        <div class="card-body">
            <form id="filterForm">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="filterType" class="form-label">Filter By:</label>
                        <select id="filterType" name="filter" class="form-control">
                            <option value="day">Last 7 Days</option>
                            <option value="month">Last Month</option>
                            <option value="year">Last Year</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="selectedDate" class="form-label">Select Date:</label>
                        <input type="date" id="selectedDate" name="selected_date" required class="form-control" value="<?= date('Y-m-d') ?>">
                        <br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Fetch Data</button>
                    </div>
                </div>

            </form>
            <br><br>
            <div class="table-responsive">

                <table id="dataTable" class=" display table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Job</th>
                            <th>Borough</th>
                            <th>Initial Cost</th>
                            <th>Latest Action Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();

        const filter = $('#filterType').val();
        const selectedDate = $('#selectedDate').val();

        const loadingSpinner = `
            <tr id="loadingRow">
                <td colspan="4" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Loading data, please wait...</p>
                </td>
            </tr>
        `;
        $('#dataTable tbody').html(loadingSpinner);

        $.ajax({
            url: '{{ route("fetch_data") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                filter: filter,
                selected_date: selectedDate
            },
            success: function(data) {
               
              
                if (data.data) {
                    data = data.data;
                }

                $('#dataTable').DataTable({
                    destroy: true,
                    data: data, 
                    columns: [
                        { data: 'Job_' },
                        { data: 'Borough' },
                        { data: 'Initial_Cost' },
                        { data: 'Latest_Action_Date' }
                    ],
                    order: [[2, 'desc']]
                }).draw(); 
            },
            error: function(xhr, status, error) {
            
                $('#dataTable tbody').html(`
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            <p>Error fetching data! Please try again.</p>
                        </td>
                    </tr>
                `);
            }
        });
    });
});


    </script>


</body>

</html>