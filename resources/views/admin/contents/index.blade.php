@extends('admin.layouts.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Content</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Content</li>
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
                                        <form method="POST" action="{{route('contents.store')}}" enctype="multipart/form-data">
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
                                                        <label for="type" class="col-form-label">Type</label>
                                                        <select name="type_id" id="type" class="form-control">
                                                            <option value="">Select type</option>
                                                            @foreach($types as $name => $id)
                                                                <option {{old('type_id') == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
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
                                @if(session('message'))
                                    <div class="alert alert-info">{{session('message')}}</div>
                                @endif
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="text-center bg-dark">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Information</th>
                                        <th>Image</th>
                                        <th>View Details</th>
                                        <th>Add Details</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($contents ) && $contents -> count() > 0)
                                        @foreach($contents as $content)

                                            <tr class="text-center">
                                                <td> {{$content->id}}</td>
                                                <td> {{$content->name}}</td>
                                                <td> {{$content->information}}</td>
                                                <td><img src="{{asset($content->imageUrl)}} " style="width: 50px;"></td>
                                                <td><a href="{{route('details.show', $content)}}" class="btn btn-success">view Details</a></td>
                                                <td class="d-flex justify-content-center">
                                                    <button data-id="{{$content->id}}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalAddType"><i class="fa fa-plus"></i></button>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <form class="mr-1 " action="{{route('contents.destroy', $content)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger delete_button" type="submit">Delete</button>
                                                        </form>

                                                        <button class="btn btn-info" data-id="{{$content->id}}" data-name="{{$content->name}}" data-information="{{$content->information }}" data-imageType="{{asset($content->imageUrl)}}" data-toggle="modal" data-target="#ModalEditContent_{{$content->id}}">Edit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade ModalEditType" id="ModalEditContent_{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form method="post" action="{{route('contents.update', $content)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalEditLabel">Edit Content</h5>
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
                                                                    <label for="type" class="col-form-label">City</label>
                                                                    <select name="type_id" id="type" class="form-control">
                                                                        <option value="">Select city</option>
                                                                        @foreach($types as $name => $id)
                                                                            <option {{$content->type_id == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('city_id')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_content_image_{{$content->id}}" class="col-form-label">
                                                                        @if($content->imageUrl)
                                                                            <img style="width: 100px" src="{{asset($content->imageUrl)}}" alt="" class="edit_content_image_{{$content->id}}">
                                                                        @else
                                                                            <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="edit_content_image_{{$content->id}}">
                                                                        @endif
                                                                    </label>
                                                                    <input data-target=".edit_content_image_{{$content->id}}" name="imageUrl" type="file" class="form-control imageUrl d-none" id="edit_content_image_{{$content->id}}">
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
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{route('details.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddLabel">New Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="content_id" id="content_id" value="">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="location" class="col-form-label">location</label>
                            <input name="location" type="text" class="form-control" id="location" value="{{old('location')}}">
                            @error('location')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link" class="col-form-label">link</label>
                            <input name="link" type="text" class="form-control" id="link" value="{{old('link')}}">
                            @error('link')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="notes" class="col-form-label">notes</label>
                            <input name="notes" type="text" class="form-control" id="notes" value="{{old('notes')}}">
                            @error('notes')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailFacebook" class="col-form-label">Facebook</label>
                            <input name="emailFacebook" type="url" class="form-control" id="emailFacebook" value="{{old('emailFacebook')}}">
                            @error('emailFacebook')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailInstagram" class="col-form-label">Instagram</label>
                            <input name="emailInstagram" type="url" class="form-control" id="emailInstagram" value="{{old('emailInstagram')}}">
                            @error('emailInstagram')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone1" class="col-form-label">Phone 1</label>
                            <input name="phone1" type="tel" class="form-control" id="phone1" value="{{old('phone1')}}">
                            @error('phone1')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone2" class="col-form-label">Phone 2</label>
                            <input name="phone2" type="tel" class="form-control" id="phone2" value="{{old('phone2')}}">
                            @error('phone2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone3" class="col-form-label">Phone 3</label>
                            <input name="phone3" type="tel" class="form-control" id="phone3" value="{{old('phone3')}}">
                            @error('phone3')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="imageUrlLocation" class="col-form-label">
                                Location image
                                <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrlLocation">
                            </label>
                            <input name="imageUrlLocation" data-target=".imageUrlLocation" type="file" class="form-control imageUrl d-none" id="imageUrlLocation">
                            @error('imageUrlLocation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="imageUrl1" class="col-form-label">
                                Image 1
                                <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl1">
                            </label>
                            <input name="imageUrl1" data-target=".imageUrl1" type="file" class="form-control imageUrl d-none" id="imageUrl1">
                            @error('imageUrl1')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="imageUrl2" class="col-form-label">
                                Image 2
                                <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl2">
                            </label>
                            <input name="imageUrl2" data-target=".imageUrl2" type="file" class="form-control imageUrl d-none" id="imageUrl2">
                            @error('imageUrl2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="imageUrl3" class="col-form-label">
                                Image 3
                                <img style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl3">
                            </label>
                            <input name="imageUrl3" data-target=".imageUrl3" type="file" class="form-control imageUrl d-none" id="imageUrl3">
                            @error('imageUrl3')
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
                modal.find('.modal-body #content_id').val(id);
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

            $('.delete_button').click(function (e) {
                e.preventDefault();
                if (confirm("Do you want delete?")){
                    $(this).parents('form').submit()
                }
            });

            setTimeout(function () {
                $('.alert').slideUp();
            }, 2000);


        });
    </script>

@endsection
