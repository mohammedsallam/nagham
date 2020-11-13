@extends('admin.layouts.layout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>City</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">City</li>
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

              <div class="modal fade add_modal" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="POST" action="{{route('cityAdd')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddLabel">New City</h5>
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
{{--                          <div class="form-group">--}}
{{--                              <label for="type" class="col-form-label">Type</label>--}}
{{--                              <input name="type" type="text" class="form-control" id="type">--}}
{{--                          </div>--}}
                        <div class="form-group">
                          <label for="add_city_image" class="col-form-label">
                              Image
                              <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="add_city_image">
                          </label>
                          <input data-target=".add_city_image" name="imageUrl" type="file" class="form-control d-none imageUrl" id="add_city_image">
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
                    <th>View Type</th>
                    <th>Add Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($cities ) && $cities -> count() > 0)
                  @foreach($cities as $city)
                  <tr class="text-center">
                    <td> {{$city->id}}</td>
                    <td> {{$city->name}}</td>
                    <td> {{$city->information}}</td>
                    <td><img src="{{asset($city->imageUrl)}} " style="width: 50px; height: 50px"></td>
                    <td><a href="{{route('typeIndex', $city-> id)}}" class="btn btn-success">view type</a></td>
                    <td class="d-flex justify-content-center">
                        <button data-id="{{$city->id}}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalAddType"><i class="fa fa-plus"></i></button>
                    </td>
                      <td>
                          <div class="d-flex justify-content-center">
                            <form class="mr-1 " action="/Deletecity/{{$city->id}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <a href="{{route('cityDelete', $city-> id)}}" class="btn btn-danger" type="submit">Delete</a>
                            </form>

                            <button class="btn btn-info" data-id="{{$city->id}}" data-name="{{$city->name}}" data-information="{{$city->information}}" data-imagecity="{{asset($city->imageUrl)}}" data-toggle="modal" data-target="#ModalEdit_{{$city->id}}">Edit</button>
                          </div>
                      </td>
                  </tr>
                  <div class="modal fade ModalEditCity" id="ModalEdit_{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <form method="post" action="{{route('cityEdit', $city->id)}}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="ModalEditLabel">Edit City</h5>
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

                                      {{--                                  <div class="form-group">--}}
                                      {{--                                      <label for="type" class="col-form-label">Type</label>--}}
                                      {{--                                      <input name="type" type="text" class="form-control" id="type">--}}
                                      {{--                                  </div>--}}
                                      <div class="form-group">
                                          <label for="city_image_edit_{{$city->id}}" class="col-form-label">
                                              @if($city->imageUrl)
                                                  <img style="width: 100px" src="{{asset($city->imageUrl)}}" alt="" class="city_image_edit_{{$city->id}}">
                                              @else
                                                  <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="city_image_edit_{{$city->id}}">
                                              @endif
                                          </label>
                                          <input data-target=".city_image_edit_{{$city->id}}" name="imageUrl" type="file" class="form-control imageUrl d-none" id="city_image_edit_{{$city->id}}">
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
        <form method="POST" action="{{route('typeAdd')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddLabel">New Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="city_id" id="city_id" value="">
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
                        <label for="type_image" class="col-form-label">
                            Image
                            <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="type_image">
                        </label>
                        <input name="imageUrl" data-target=".type_image" type="file" class="form-control imageUrl d-none" id="type_image">
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

        {{--if ("{{session('errors')}}"){--}}
        {{--    $('.add_modal').modal();--}}
        {{--}--}}

        $('.ModalEditCity').on('show.bs.modal', function(event) {
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
            modal.find('.modal-body #city_id').val(id);
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

