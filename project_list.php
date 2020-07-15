<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tasksman</title>
    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
      <div class='container py-4'>
        <div class='row justify-content-center'>
          <div class='col-md-8'>
            <div class='card'>
              <div class='card-header'>All projects</div>
              <div class='card-body'>
                <a class='btn btn-primary btn-sm mb-3' href="new_project.php">Create new project</a>
                <ul class='list-group list-group-flush'>

                    <a class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' href="project.php">
                      Test project

                      <span class='badge badge-primary badge-pill'>
                        12 | 500
                      </span>
                    </a>

                    <a class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' href="project.php">
                      Test project 2

                      <span class='badge badge-primary badge-pill'>
                        20 | 250
                      </span>
                    </a>

                    <a class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' href="project.php">
                      Test project 3

                      <span class='badge badge-primary badge-pill'>
                        5 | 300
                      </span>
                    </a>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


</body>
</html>
