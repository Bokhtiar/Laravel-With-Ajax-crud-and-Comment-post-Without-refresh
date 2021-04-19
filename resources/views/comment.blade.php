<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <section class="container">
        <form id="create_msg">
            <div class="form-gorup ">
                <input type="text" class="form-control" name="msg" id="msg">
                <input placeholder="Enter Your Message" type="submit" name="" class="btn btn-info" value="Send" id="">
            </div>
        </form>
    </section>

    <section class="container">
        <p id="show">
            @foreach ($comments as $comment)
            <span>
                bokhtiar : {{$comment->msg}}
             </span><br>
            @endforeach
        </p>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#create_msg").submit(function (e){
            e.preventDefault();

            let formData = {
                msg: $('#msg').val()
            }

            $.ajax({
                type:'POST',
                url: 'msg/store',
                data: formData,
                success:function(data){
                    $('#msg').val(''),

                    $('#show').prepend(`
                    <span>
                       bokhtiar `+ data.msg+`
                    </span> <br>
                    `);
                },
                error: function(error){
                    console.log(error)
                },
            })
        })
    </script>
</body>
</html>
