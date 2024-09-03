<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Subjects</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Subjects</h2>
        <table id="subjectsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Grade Level</th>
                    <th>Subject</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be inserted here by DataTables -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#subjectsTable').DataTable({
                "ajax": {
                    "url": "display_subjects.php",
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "id" },
                    { "data": "gradelevel" },
                    { "data": "subject" },
                    {
                        "data": "file",
                        "render": function(data, type, row) {
                            if (data) {
                                return `<a href="${data}" target="_blank">View File</a>`;
                            }
                            return 'No File';
                        }
                    }
                ]
            });
        });
    </script>
</body>
</html>
