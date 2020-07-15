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
          <div class='col-md-6'>
            <div class='card'>
              <div class='card-header'>Create new project</div>
              <div class='card-body'>
                <form action="#">
                  <div class='form-group'>
                    <label htmlFor='name'>Project name</label>
                    <input type='text' class='form-control' name='name' />
                  </div>
                  <div class='form-group'>
                    <label htmlFor='description'>Project total</label>
                    <input type='number' step="any" class='form-control' name='total' />
                  </div>
                  <div class='form-group'>
                    <label htmlFor='description'>Project description</label>
                    <textarea class="form-control" name='description' rows='10'></textarea>
                  </div>
                  <button class='btn btn-primary'>Create</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


</body>
</html>
