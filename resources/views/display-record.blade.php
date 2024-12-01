<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spirosys - Task 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

</head>

<body>
    <div class="container card p-3 mt-3">
        <div class="row mb-3">
            <div class="col text-end">
                <a href="/task2" class='btn btn-success' style="width: 200px;">View Task 2</a>
            </div>
        </div>

        <div class="card-title p-1 bg-primary-subtle">
            <h2 class="text-center">Task - 1</h2>
        </div>
        <div class="card-body table-responsive">
            <table id="myTable" class="table table-bordered table-striped">
                <thead >
                    <tr>
                        <th>Job No</th>
                        <th>Borough</th>
                        <th>Street Name</th>
                        <th>Job Type</th>
                        <th>Filling Date</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $('document').ready(function(){

       $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('getrecords') }}",
        type: "GET",
    },
    columns: [
        { data: "Job_" },
        { data: "Borough" },
        { data: "Street_Name" },
        { data: "Job_Type" },
        { data: "Latest_Action_Date" }
    ]
});
            
})
    </script>
</body>

</html>