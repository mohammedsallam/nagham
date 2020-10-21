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
                          <label for="imageUrl" class="col-form-label">
                              Image
                              <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="city_image">
                          </label>
                          <input name="imageUrl" type="file" class="form-control d-none imageUrl" id="imageUrl">
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
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Information</th>
                    <th>Image</th>
                    <th>View Type</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  @if(isset($cities ) && $cities -> count() > 0)
                  @foreach($cities as $city)

                  <tr>
                    <td> {{$city->id}}</td>
                    <td> {{$city->name}}</td>
                    <td> {{$city->information}}</td>
                    <td><img src="{{asset($city->imageUrl)}} " style="width: 50px; height: 50px"></td>
                    <td><a href="{{route('typeIndex', $city-> id)}}" class="btn btn-success">view type</a></td>

                    <td>
                      <div class="row">
                        <form class="mr-1 " action="/Deletecity/{{$city->id}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{route('cityDelete', $city-> id)}}" class="btn btn-danger" type="submit">Delete</a>
                        </form>

                        <button class="btn btn-info" data-id="{{$city->id}}" data-name="{{$city->name}}" data-information="{{$city->information}}" data-imagecity="{{asset($city->imageUrl)}}" data-toggle="modal" data-target="#ModalEdit" data-whatever="@getbootstrap">Edit</button>
                      </div>
                      <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <form method="post" action="{{route('cityEdit', $city)}}" enctype="multipart/form-data">
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
                                  <label for="imageUrlEdit" class="col-form-label">
                                        @if($city->imageUrl)
                                          <img style="width: 100px" src="{{asset($city->imageUrl)}}" alt="" class="city_image">
                                            @else
                                          <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="city_image">
                                      @endif
                                  </label>
                                  <input name="imageUrl" type="file" class="form-control imageUrl d-none" id="imageUrlEdit">
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
                    </td>
                  </tr>

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
</div>
@endsection

@section('js')

<script>
    $(document).ready(function() {

        {{--if ("{{session('errors')}}"){--}}
        {{--    $('.add_modal').modal();--}}
        {{--}--}}

        $('#ModalEdit').on('show.bs.modal', function(event) {
            var btnEdit = $(event.relatedTarget);
            var id = btnEdit.data('id');
            var name = btnEdit.data('name');
            var information = btnEdit.data('information');
            var type = btnEdit.data('type');

            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #information').val(information);
            // modal.find('.modal-body #type').val(type);
        });

        $('.imageUrl').change(function() {
            let image = $('.city_image'),
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

