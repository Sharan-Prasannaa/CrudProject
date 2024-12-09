<x-app-web-layout>

    <x-slot name="title">
        Edit Data
    </x-slot>

    @section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="card">
                        <div class="class-header" style="padding-top:10px;padding-inline:10px">
                            <h4>Edit Data
                                <a href="{{ url('sample') }}"class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('sample/'.$editData->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="sample-form">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$editData->name}}"/>

                                </div>

                                <div class="mb-3">
                                    <label>Gender - </label>
                                    <span>{{ ucfirst($editData->gender) }}</span>
                                    <div>
                                        <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                                        <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female
                                        <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> Other
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description"  class="form-control" rows="3"> {{ ($editData->description)}}</textarea>

                                </div>

                                {{-- <div class="mb-3">
                                    <label for="profile_picture">Change/Upload Picture</label>
                                    <input type="file" name="profile_picture" class="form-control" accept="image/*">
                                    @error('profile_picture') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> --}}

                                <div class="mb-3">
                                    <label>Upload Image</label>
                                    <input type="file" name="profile_picture" class="form-control"/>

                                </div>

                                <div class="mb-3">
                                    <label>Is Active</label>
                                    <input type="checkbox" name="is_active" value="1" {{ $editData->is_active == true ? 'checked':'' }}/>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" id="submit-button">Update</button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
    <script>
        // Form validation rules
        $("#sample-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                    minlength: 3
                },
                gender: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Name is required.",
                    maxlength: "Name can't be longer than 255 characters.",
                    minlength: "Name must have more than 3 characters"
                },
                gender: {
                    required: "Gender is required."
                },
                description: {
                    required: "Description is required."
                },
            },
            errorPlacement: function(error, element) {
                // For radio buttons
                if (element.attr("name") == "gender") {
                    error.appendTo(element.closest("div"));
                } else {
                    error.insertAfter(element);
                }
                error.addClass('invalid-feedback');
            },

            submitHandler:function(form){
                form.submit();
            }
        });
    </script>
@endpush
    {{-- <x-slot name="scripts">
        <script>
            console.log('this is my script area');
            alert('this is my script area');
        </script>
    </x-slot> --}}


</x-app-web-layout>
