@extends('admin.layouts.layout')
@section('css')

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Details</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalAdd" data-whatever="@getbootstrap">Add</button>

              <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="POST" action="/Adddetails" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddLabel">New Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <label for="name" class="col-form-label">Name</label>
                          <input name="name" type="text" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                          <label for="phone" class="col-form-label">Phone</label>
                          <input name="phone1" type="text" class="form-control" id="phone1">
                          <input name="phone2" type="text" class="form-control" id="phone2">
                          <input name="phone3" type="text" class="form-control" id="phone3">
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-form-label">Email</label>
                          <textarea name="emailFacebook" class="form-control" id="emailFacebook"></textarea>
                          <textarea name="emailInstagram" class="form-control" id="emailInstagram"></textarea>
                        </div>

                        <div class="form-group">
                          <label for="location" class="col-form-label">Location</label>
                          <textarea name="location" class="form-control" id="location"></textarea>
                        </div>

                        <div class="form-group">
                          <label for="notes" class="col-form-label">Notes</label>
                          <textarea name="notes" class="form-control" id="notes"></textarea>
                        </div>

                        <div class="form-group">
                          <label for="link" class="col-form-label">Link</label>
                          <textarea name="link" class="form-control" id="link"></textarea>
                        </div>


                        <div class="form-group">
                          <label for="imageUrl" class="col-form-label">Image</label>
                          <input name="imageUrlLocation" type="file" class="form-control" id="imageUrlLocation">
                          <input name="imageUrl" type="file" class="form-control" id="imageUrl">
                          <input name="imageUrl" type="file" class="form-control" id="imageUrl">
                          <input name="imageUrl" type="file" class="form-control" id="imageUrl">
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Notes</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach($details as $details)

                  <tr>
                    <td> {{$details->id}}</td>
                    <td> {{$details->name}}</td>
                    <td> {{$details->phone}}</td>
                    <td> {{$details->email}}</td>
                    <td> {{$details->location}}</td>
                    <td> {{$details->notes}}</td>
                    <td> {{$details->link}}</td>
                    <td><img src="images/{{$details->imageUrl}}" style="width: 50px; height: 50px"></td>

                    <td>
                      <div class="row">
                        <form class="mr-1 " action="/Deletecity/{{$details->id}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>

                        <button class="btn btn-info" data-id="{{$details->id}}" data-name="{{$details->name}}" data-information="{{$details->information }}" data-imagedetails="{{asset('images/'.$details->imageUrl)}}" data-toggle="modal" data-target="#ModalEdit" data-whatever="@getbootstrap">Edit</button>
                      </div>
                      <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <form method="POST" action="/Editdetails" enct ype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ModalEditLabel">Edit Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <div class="form-group">
                                  <label for="id" class="col-form-label">Id</label>
                                  <input readonly name="id" type="text" class="form-control" id="id">
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-form-label">Name</label>
                                  <input name="name" type="text" class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                  <label for="phone" class="col-form-label">Phone</label>
                                  <input name="phone1" type="text" class="form-control" id="phone1">
                                  <input name="phone2" type="text" class="form-control" id="phone2">
                                  <input name="phone3" type="text" class="form-control" id="phone3">
                                </div>

                                <div class="form-group">
                                  <label for="information" class="col-form-label">Information</label>
                                  <textarea name="information" class="form-control" id="information"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="imageUrl" class="col-form-label">Image</label>
                                  <input name="imageUrl" type="file" class="form-control" id="imageUrl">
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->

          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')

<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#imageUrl').change(function() {
      $('#image_input').val($(this).val())
    })
  })
  $('#ModalEdit').on('show.bs.modal', function(event) {
    var btnEdit = $(event.relatedTarget);
    var id = btnEdit.data('id');
    var name = btnEdit.data('name');
    var information = btnEdit.data('information');
    var imageUrl = btnEdit.data('imagedetails');

    var modal = $(this)

    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #information').val(information);
    modal.find('.modal-body #image_input').val(imageUrl);
  });
</script>

@endsection