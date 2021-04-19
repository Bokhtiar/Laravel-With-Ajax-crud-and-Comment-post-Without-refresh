<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body class="container">
      <a href="{{ url('comment') }}">Comment</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button>
    <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">Index</th>
            <th scope="col">First name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="dataShow">
            @foreach ($tasks as $task)

            <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->name}}</td>
                <td>
                    <a class="btn btn-info"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$task->id}}" href="">Edit</a>
                    <a class="btn btn-danger" id="delete" href="">Delete</a>
                </td>
            </tr>

    <!--modal update add-->
      <div class="modal fade" id="editModal{{$task->id}}" data-bs-toggle="modal" data-bs-target="#editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="createTaskMessage"></div>

              <form action="" id="editTask">
                <input type="hidden" name="" value="{{$task->id}}" id="id">
                  <div>
                      <label for="">Update Task</label>
                      <input type="text" class="form-control" value="{{$task->name}}" name="name" id="name">
                  </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    <!--end update modal -->
           @endforeach
        </tbody>
      </table>
      <!--modal add-->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="createTaskMessage"></div>
              <form action="" id="createTask">
                  <div>
                      <label for="">Create Task</label>
                      <input type="text" class="form-control" name="name" id="name">
                  </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!--end modal -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createTask').submit( function(e){
            e.preventDefault();
            let formData = {
                name: $('#name').val()
            }

            $.ajax({
                type: 'POST',
                url: 'store',
                data: formData,
                success: function(data){
                    console.log(data)
                    $("#createTaskMessage").prepend('<div class="bg-success text-light text-center">Task Created SuccessFully</div>')
                    $('#name').val('');

                    $("#dataShow").prepend(`
                    <tr>
                        <th scope="row">`+ data.id+`</th>
                        <td>`+ data.name+`</td>
                        <td>
                            <a class="btn btn-info" id="edit" href="">Edit</a>
                            <a class="btn btn-danger" id="delete" href="">Delete</a>
                        </td>
                    </tr>
                    `);
                },
                error: function(error){
                    console.log(error)
                },
            })
        });


      $('#editTask').submit( function(e){
        e.preventDefault();
        let formData = {
            name: $('#name').val()
        }
        let id = $('#id').val()
        console.log(id)
        $.ajax({
            type : 'POST',
            url  : `/update/task/${id}`,
            data : formData,
            success: function(data){
                $('#name').val('');

            },
            error: function(error){
                console.log(error)
            },
        })


      })
    </script>
</body>
</html>
