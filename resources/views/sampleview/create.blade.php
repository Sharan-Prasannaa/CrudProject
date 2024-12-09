<x-app-web-layout>

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Add Sample Data
                            <a href="{{ url('sample') }}" class="btn btn-primary float-end">Home</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('sample/create') }}" method="POST" enctype="multipart/form-data" id="sample-form">
                            @csrf
                            <!-- Form Fields -->
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" />
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" />
                            </div>

                            <div class="mb-3">
                                <label>Gender</label>
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
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture">Upload Image</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control" />
                                <div class="invalid-feedback" id="profile_picture_error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="is_active">Is Active</label>
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') == true ? 'checked' : '' }} />
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" id="submit-button">Save</button>
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
        $.validator.addMethod("filesize", function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1024);
        }, "File size must not exceed {0} KB.");
        // Form validation rules
        $("#sample-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                gender: {
                    required: true
                },
                description: {
                    required: true
                },
                profile_picture: {
                    required: true,
                    extension: "jpeg|jpg|png|gif",
                    filesize: 1024 // Max size in KB (1MB)
                }
            },
            messages: {
                name: {
                    required: "Name is required.",
                    maxlength: "Name can't be longer than 255 characters.",
                    minlength: "Name must have more than 3 characters"
                },
                email: {
                    required: "Email is required.",
                    email: "Please enter a valid email address."
                },
                gender: {
                    required: "Gender is required."
                },
                description: {
                    required: "Description is required."
                },
                profile_picture: {
                    required: "Please upload a profile picture.",
                    extension: "Only image files (jpeg, jpg, png, gif) are allowed.",
                    filesize: "The image size must not exceed 1 MB."
                }
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
</x-app-web-layout>
