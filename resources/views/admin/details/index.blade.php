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
                                                    <div class="form-group col-md-6">
                                                        <label for="content" class="col-form-label">Content</label>
                                                        <select name="content_id" id="content" class="form-control">
                                                            <option value="">Select Content</option>
                                                            @foreach($contents as $name => $id)
                                                                <option {{old('content_id') == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('content_id')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
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
                                                    <div class="form-group col-md-12">
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
                                        <th>Phone 1</th>
                                        <th>Facebook</th>
                                        <th>Image 1</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($details ) && $details -> count() > 0)
                                        @foreach($details as $detail)

                                            <tr class="text-center">
                                                <td> {{$detail->id}}</td>
                                                <td> {{$detail->name}}</td>
                                                <td><a href="tel:{{$detail->phone1}}">{{$detail->phone1}}</a></td>
                                                <td><a target="_blank" href="{{$detail->emailFacebook}}">Facebook</a></td>
                                                <td><img src="{{asset($detail->imageUrl1)}} " style="width: 50px;"></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <form class="mr-1" action="{{route('details.destroy', $detail)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger delete_button" type="submit">Delete</button>
                                                        </form>

                                                        <button class="btn btn-info"
                                                                data-id="{{$detail->id}}"
                                                                data-name="{{$detail->name}}"
                                                                data-location="{{$detail->location }}"
                                                                data-link="{{$detail->link}}"
                                                                data-notes="{{$detail->notes}}"
                                                                data-emailFacebook="{{$detail->emailFacebook}}"
                                                                data-emailInstagram="{{$detail->emailInstagram}}"
                                                                data-phone1="{{$detail->phone1}}"
                                                                data-phone2="{{$detail->phone2}}"
                                                                data-phone3="{{$detail->phone3}}"
                                                                data-imageUrlLocation="{{$detail->imageUrlLocation}}"
                                                                data-imageUrl1="{{$detail->imageUrl1}}"
                                                                data-imageUrl2="{{$detail->imageUrl2}}"
                                                                data-imageUrl3="{{$detail->imageUrl3}}"
                                                                data-toggle="modal"
                                                                data-target="#ModalEditContent_{{$detail->id}}">Edit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade ModalEditType" id="ModalEditContent_{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <form method="post" action="{{route('details.update', $detail)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalEditLabel">Edit Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="id" class="col-form-label">Id</label>
                                                                    <input readonly name="id" type="text" class="form-control" id="id">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="content" class="col-form-label">Content</label>
                                                                    <select name="content_id" id="content" class="form-control">
                                                                        <option value="">Select Content</option>
                                                                        @foreach($contents as $name => $id)
                                                                            <option {{old('content_id', $detail->content_id) == $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('content_id')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
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
                                                                    <label for="imageUrlLocation_{{$detail->id}}" class="col-form-label">
                                                                        @if($detail->imageUrlLocation)
                                                                            <img id="imageUrlLocation" style="width: 100px" src="{{asset($detail->imageUrlLocation)}}" alt="" class="imageUrlLocation_{{$detail->id}}">
                                                                        @else
                                                                            <img id="imageUrlLocation" style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrlLocation_{{$detail->id}}">
                                                                        @endif
                                                                        Location image
                                                                    </label>
                                                                    <input name="imageUrlLocation" data-target=".imageUrlLocation_{{$detail->id}}" type="file" class="form-control imageUrl d-none" id="imageUrlLocation_{{$detail->id}}">
                                                                    @error('imageUrlLocation')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="imageUrl1_{{$detail->id}}" class="col-form-label">
                                                                        @if($detail->imageUrl1)
                                                                            <img id="imageUrl1" style="width: 100px" src="{{asset($detail->imageUrl1)}}" alt="" class="imageUrl1_{{$detail->id}}">
                                                                        @else
                                                                            <img id="imageUrl1" style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl1_{{$detail->id}}">
                                                                        @endif
                                                                        Image 1
                                                                    </label>
                                                                    <input name="imageUrl1" data-target=".imageUrl1_{{$detail->id}}" type="file" class="form-control imageUrl d-none" id="imageUrl1_{{$detail->id}}">
                                                                    @error('imageUrl1')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="imageUrl2_{{$detail->id}}" class="col-form-label">
                                                                        @if($detail->imageUrl2)
                                                                            <img id="imageUrl2" style="width: 100px" src="{{asset($detail->imageUrl2)}}" alt="" class="imageUrl2_{{$detail->id}}">
                                                                        @else
                                                                            <img id="imageUrl2" style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl2_{{$detail->id}}">
                                                                        @endif
                                                                        Image 1
                                                                    </label>
                                                                    <input name="imageUrl2" data-target=".imageUrl2_{{$detail->id}}" type="file" class="form-control imageUrl d-none" id="imageUrl2_{{$detail->id}}">
                                                                    @error('imageUrl2')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="imageUrl3_{{$detail->id}}" class="col-form-label">
                                                                        @if($detail->imageUrl3)
                                                                            <img id="imageUrl3" style="width: 100px" src="{{asset($detail->imageUrl3)}}" alt="" class="imageUrl3_{{$detail->id}}">
                                                                        @else
                                                                            <img id="imageUrl3" style="width: 100px" src="{{asset('assets/admin/images/city.png')}}" alt="" class="imageUrl3_{{$detail->id}}">
                                                                        @endif
                                                                        Image 1
                                                                    </label>
                                                                    <input name="imageUrl3" data-target=".imageUrl3_{{$detail->id}}" type="file" class="form-control imageUrl d-none" id="imageUrl3_{{$detail->id}}">
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

@endsection


@section('js')
    <script>

        $(document).ready(function() {

            $('.ModalEditType').on('show.bs.modal', function(event) {
                var btnEdit = $(event.relatedTarget);
                var id = btnEdit.data('id');
                var name = btnEdit.data('name');
                var location = btnEdit.data('location');
                var link = btnEdit.data('link');
                var notes = btnEdit.data('notes');
                var emailFacebook = btnEdit.data('emailfacebook');
                var emailInstagram = btnEdit.data('emailinstagram');
                var phone1 = btnEdit.data('phone1');
                var phone2 = btnEdit.data('phone2');
                var phone3 = btnEdit.data('phone3');
                var imageUrlLocation = btnEdit.data('imageUrlLocation');
                var imageUrl1 = btnEdit.data('imageUrl1');
                var imageUrl2 = btnEdit.data('imageUrl2');
                var imageUrl3 = btnEdit.data('imageUrl3');

                var modal = $(this)

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #location').val(location);
                modal.find('.modal-body #link').val(link);
                modal.find('.modal-body #notes').val(notes);
                modal.find('.modal-body #emailFacebook').val(emailFacebook);
                modal.find('.modal-body #emailInstagram').val(emailInstagram);
                modal.find('.modal-body #phone1').val(phone1);
                modal.find('.modal-body #phone2').val(phone2);
                modal.find('.modal-body #phone3').val(phone3);
                modal.find('.modal-body #imageUrlLocation').val(imageUrlLocation);
                modal.find('.modal-body #imageUrl1').val(imageUrl1);
                modal.find('.modal-body #imageUrl2').val(imageUrl2);
                modal.find('.modal-body #imageUrl3').val(imageUrl3);

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

            });

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
