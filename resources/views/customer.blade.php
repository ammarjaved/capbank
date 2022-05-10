<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
</head>
<style>
    .alert-message {
        color: red;
    }
</style>
<body>
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/customer') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            </div>

{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
            <div class="dropdown" style="margin-top: 5px;float: right;">
                <button class="btn  dropdown-toggle"  type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Customer Application Creation
    </h2><br>
    <div class="row">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="addPost()">Add Post</a>
        </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
            <table id="customer_app" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Company Name</th>
                    <th>Premise Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer as $post)
                    <tr id="row_{{$post->id}}">
                        <td>{{ $post->id  }}</td>
                        <td>{{ $post->customer_name }}</td>
                        <td>{{ $post->company_no }}</td>
                        <td>{{ $post->premise_type }}</td>
                        <td><a href="javascript:void(0)" data-id="{{ $post->id }}" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="post-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form name="userForm" class="form-horizontal">
                    <input type="hidden" name="app_id" id="app_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2">customer_name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="customer name">
                            <span id="titleError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">company_no</label>
                        <div class="col-sm-12">
                        <input class="form-control" id="company_no" name="company_no" placeholder="company no" rows="4" cols="50">

                            <span id="descriptionError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">premise_type</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="premise_type" name="premise_type" placeholder="premise type" rows="4" cols="50">

                            <span id="premise_typeError" class="alert-message"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $('#customer_app').DataTable();

    function addPost() {
        $("#app_id").val('');
        $('#post-modal').modal('show');
    }

    function editPost(event) {
        var id  = $(event).data("id");
        let _url = `/customer/${id}`;
        $('#titleError').text('');
        $('#descriptionError').text('');
        $('#premise_typeError').text('');

        $.ajax({
            url: _url,
            type: "GET",
            success: function(response) {
                if(response) {
                    $("#app_id").val(response.id);
                    $("#customer_name").val(response.customer_name);
                    $("#company_no").val(response.company_no);
                    $("#premise_type").val(response.premise_type);
                    $('#post-modal').modal('show');
                }
            }
        });
    }

    function createPost() {
        var customer_name = $('#customer_name').val();
        var company_no = $('#company_no').val();
        var premise_type = $('#premise_type').val();
        var id = $('#app_id').val();

        let _url     = `/customer`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                customer_name: customer_name,
                company_no: company_no,
                premise_type: premise_type,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    if(id != ""){
                        $("#row_"+id+" td:nth-child(2)").html(response.data.customer_name);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.company_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.premise_type);
                    } else {
                        $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.customer_name+
                            '</td><td>'+response.data.company_no+'</td><td>'+response.data.premise_type+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td></tr>');
                    }
                    $('#customer_name').val('');
                    $('#company_no').val('');
                    $('#premise_type').val('');

                    $('#post-modal').modal('hide');
                }
            },
            error: function(response) {
                $('#titleError').text(response.responseJSON.errors.customer_name);
                $('#descriptionError').text(response.responseJSON.errors.company_no);
                $('#premise_typeError').text(response.responseJSON.errors.premise_type);
            }
        });
    }

    function deletePost(event) {
        var id  = $(event).data("id");
        let _url = `/customer/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(response) {
                $("#row_"+id).remove();
            }
        });
    }

</script>
