@extends('admin.layouts.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Type</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Type</li>
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
                  <form method="POST" action="{{route('typeAdd')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddLabel">New Content</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <label for="name" class="col-form-label">Name</label>
                          <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="information" class="col-form-label">Information</label>
                          <textarea name="information" class="form-control" id="information">{{old('information')}}</textarea>
                            @error('information')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                          <div class="form-group">
                              <label for="city" class="col-form-label">City</label>
                              <select name="city_id" id="city" class="form-control">
                                  <option value="">Select city</option>
                                  @foreach($cities as $name => $id)
                                      <option {{old('city_id') == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                  @endforeach
                              </select>
                              @error('city_id')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        <div class="form-group">
                          <label for="type_image" class="col-form-label">
                              Image
                              <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="type_image">
                          </label>
                          <input data-target=".type_image" name="imageUrl" type="file" class="form-control imageUrl d-none" id="type_image">
                            @error('imageUrl')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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
                  <tr class="text-center bg-dark">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Information</th>
                    <th>Image</th>
                    <th>View Content</th>
                    <th>Add Content</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  @if(isset($types ) && $types -> count() > 0)
                  @foreach($types as $type)

                  <tr class="text-center">
                    <td> {{$type->id}}</td>
                    <td> {{$type->name}}</td>
                    <td> {{$type->information}}</td>
                    <td><img src="{{asset($type->imageUrl)}} " style="width: 50px; height: 50px"></td>
                    <td><a href="{{route('contentIndex', $type-> id)}}" class="btn btn-success">view Content</a></td>
                    <td class="d-flex justify-content-center">
                        <button data-id="{{$type->id}}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalAddType"><i class="fa fa-plus"></i></button>
                    </td>
                    <td>
                      <div class="d-flex justify-content-center">
                          <form class="mr-1 " action="{{route('typeDelete', $type->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit">Delete</button>
                          </form>
                          <button class="btn btn-info" data-id="{{$type->id}}" data-name="{{$type->name}}" data-information="{{$type->information }}" data-imageType="{{asset($type->imageUrl)}}" data-toggle="modal" data-target="#ModalEditType_{{$type->id}}">Edit</button>

                      </div>
                    </td>
                  </tr>
                  <div class="modal fade ModalEditType" id="ModalEditType_{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <form method="post" action="{{route('typeEdit', $type)}}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="ModalEditLabel">Edit Type</h5>
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
                                          <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}">
                                          @error('name')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>

                                      <div class="form-group">
                                          <label for="information" class="col-form-label">Information</label>
                                          <textarea name="information" class="form-control" id="information">{{old('information')}}</textarea>
                                          @error('information')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="city" class="col-form-label">City</label>
                                          <select name="city_id" id="city" class="form-control">
                                              <option value="">Select city</option>
                                              @foreach($cities as $name => $id)
                                                  <option {{$type->city_id == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                              @endforeach
                                          </select>
                                          @error('city_id')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="edit_type_image_{{$type->id}}" class="col-form-label">
                                              @if($type->imageUrl)
                                                  <img style="width: 100px" src="{{asset($type->imageUrl)}}" alt="" class="edit_type_image_{{$type->id}}">
                                              @else
                                                  <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="edit_type_image_{{$type->id}}">
                                              @endif
                                          </label>
                                          <input data-target=".edit_type_image_{{$type->id}}" name="imageUrl" type="file" class="form-control imageUrl d-none" id="edit_type_image_{{$type->id}}">
                                          @error('imageUrl')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
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

                  @endforeach
                  @endif

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="ModalAddType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('contentAdd')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddLabel">New Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type_id" id="type_id" value="">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="information" class="col-form-label">Information</label>
                        <textarea name="information" class="form-control" id="information">{{old('information')}}</textarea>
                        @error('information')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content_image" class="col-form-label">
                            Image
                            <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="content_image">
                        </label>
                        <input name="imageUrl" data-target=".content_image" type="file" class="form-control imageUrl d-none" id="content_image">
                        @error('imageUrl')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
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

@endsection


@section('js')
<script>

    $(document).ready(function() {

        $('.ModalEditType').on('show.bs.modal', function(event) {
            var btnEdit = $(event.relatedTarget);
            var id = btnEdit.data('id');
            var name = btnEdit.data('name');
            var information = btnEdit.data('information');

            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #information').val(information);

        });

        $('#ModalAddType').on('show.bs.modal', function(event) {
            var btnEdit = $(event.relatedTarget);
            var id = btnEdit.data('id');
            var modal = $(this);
            modal.find('.modal-body #type_id').val(id);
        });

        $('.imageUrl').change(function() {
            let image = $($(this).data('target')),
                file = this.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                image.attr('src', reader.result);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }

        })


});
</script>

@endsection
