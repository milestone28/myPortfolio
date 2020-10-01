@extends('layouts.app')


@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Categories</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Categories</div>

        <div class="card-body">
            <table class="table">

                <thead>
                    <th>Name</th>
                    <th></th>
                </thead>

                <tbody>
                    
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <div id="getName" data-categoryName="{{ $category->name }}"> {{ $category->name }} </div>
                        </td>

                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm  float-right mx-2">Edit</a>

                           
                                <button class="btn btn-danger btn-sm float-right" onclick="handleDelete({{ $category->id }})">Delete</button>
                             

                        </td>
                        
                    </tr>
                @endforeach
                </tbody>
              
            </table>

                <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-center font-weight-bold">Are You Sure you want to delete this category :  <span id="showName"></span>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                </form>
        </div>

    </div>
    
@endsection

@section('scripts')

<script>

    function handleDelete(id){

        var form = document.getElementById('deleteCategoryForm')
        var elmnt = document.getElementById("getName");
        var attr = elmnt.getAttributeNode("data-categoryName").value;
        document.getElementById("showName").innerHTML = attr;
        form.action = '/categories/' + id
        $('#deleteModal').modal('show')
    }

</script>

@endsection



