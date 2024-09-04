<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Sidebar Navigation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="loadSchool">Display Schools</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="loadSubjects">Display Subjects</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content area -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div id="contentArea" class="mt-3">
                    <!-- Content will be loaded here -->
                    <h2>Welcome! Please select an option from the sidebar.</h2>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            // Load content into the #contentArea
            function loadContent(url) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#contentArea').html(data); // Load the response into the content area
                    },
                    error: function() {
                        $('#contentArea').html('<p>An error has occurred while loading the content.</p>'); // Display an error message if the request fails
                    }
                });
            }

            // Event handler for loading schools
            $('#loadSchool').on('click', function(e){
                e.preventDefault();
                loadContent('display_school.php'); // Load the display_school.php content
            });

            // Event handler for loading subjects
            $('#loadSubjects').on('click', function(e){
                e.preventDefault();
                loadContent('display_subjects.php'); // Load the display_subjects.php content
            });
        });
    </script>
</body>
</html>
