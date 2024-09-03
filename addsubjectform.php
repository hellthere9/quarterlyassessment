<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add Subject Form</h2>
        <form action="addsubjectprocess.php" method="POST" enctype="multipart/form-data">
           <div class="form-group">
                <label for="gradelevel">Grade Level</label>
                <input type="number" class="form-control" id="gradelevel" name="gradelevel" min="1" max="99">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <textarea class="form-control" id="subject" name="subject" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="file">Upload File</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
