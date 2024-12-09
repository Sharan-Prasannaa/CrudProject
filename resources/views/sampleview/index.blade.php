<x-app-web-layout>

    <x-slot name="title">
        My laravel
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="class-header" style="padding-top:10px;padding-inline:10px">
                        <h4>Sample Data
                            <a href="{{ url('sample/create') }}"class="btn btn-primary float-end">Add Data</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{--{{ $viewData }}--}}
                        <table class="table table-bordered table-striped">
                            <thread>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thread>
                            <tbody>
                                @foreach ($viewData as $item)
                                <tr id="row-{{ $item->id }}">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <img src="{{ ($item->profile_picture) }}" style="width:70px; height:70px;" alt="No Image Chosen">
                                    </td>
                                    <td>
                                        @if($item->is_active)
                                        <span class="text-success">Active</span>
                                        @else
                                        <span class="text-danger">In-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('sample/' .$item->id.'/edit')}}" class="btn btn-success mx-2">Edit</a>
                                        <button
                                            class="btn btn-danger delete-btn"
                                            data-id="{{ $item->id}}"
                                        >
                                            Delete
                                        </button>




                                        {{-- <a
                                            href="{{ url('sample/'.$item->id.'/delete')}}"
                                            class="btn btn-danger mx-2"
                                            onclick="return confirm('Are you sure ?')"
                                        >
                                            Delete
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $viewData->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-slot name="scripts">
        <script>
            console.log('this is my script area');
            alert('this is my script area');
        </script>
    </x-slot> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).on('click', '.delete-btn', function(e){
            e.preventDefault();
            console.log('Delete button clicked for ID:', $(this).data('id'));

            if(!confirm('Are you sure you want to delete this record?')){
                return;
            }

            let id=$(this).data('id');
            let url=`/sample/${id}/delete`;

            $.ajax({
                url:url,
                type:'GET',
                data:{
                    _token:'{{ csrf_token() }}',
                },
                success:function(response){
                    console.log('AJAX success:', response);
                    alert(response.success); //Display success message
                    console.log(`#row-${id}`);
                    $(`#row-${id}`).remove(); //remove Row from table
                },
                error:function(xhr){
                    alert('An error occured while trying to delete the record.');
                }
            });
        });
    </script>




</x-app-web-layout>
