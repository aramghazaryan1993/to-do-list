@extends('layouts.app-view')

@section('content')


    <div class="container">
        <h2 style="text-align: center">To Do List</h2>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="add">
            Add To Do List
        </button>

        <div class="row mt-5">
            <div class="col-md-5 mx-auto">
                <form action="{{route('search.to.do.list')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input class="form-control border" type="search" placeholder="Search" id="example-search-input"
                               name="search">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="form-group mb-3" style="width: 500px;">

                            <select class="select2-multiplee form-control" name="tag_id[]" multiple="multiple"
                                    id="select2Multiplee">
                            </select>
                            <div id="test-listt"></div>
                        </div>
                        <input type="submit" value="Search">
                    </div>
                </form>
            </div>
        </div>


        <div class="G-table-block P-db-management-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Completed</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="list">

                @foreach($toDoLists as $toDoList)
                    <tr>
                        <td>{{$toDoList->title}}</td>
                        <td>{{$toDoList->text}}</td>
                        <td>{{$toDoList->date}}</td>
                        <td>
                            @if($toDoList->status == 'completed')
                                <button type="button" class="btn btn-danger">Completed</button>
                            @else
                                <button type="button" class="btn btn-success">Not Completed</button>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary edit" data-id="{{$toDoList->id}}"
                                    data-toggle="modal"
                                    data-target="#edit{{$toDoList->id}}">Edit
                            </button>
                        </td>
                        <td>
                            <form action="{{route('delete.to.do.list')}}" method="post">
                                @csrf
                                <button type="submit" value="{{$toDoList->id}}" name="to_do_id" class="btn btn-primary">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>


        <!-- Add To Do List  -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="container mt-5" style="max-width: 550px">
                            <h2 class="mb-5">To Do List</h2>
                            <form action="{{ route('add.to.do.list') }}" method="POST" id="myForm"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                           name="title">
                                </div>


                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="Date" class="form-control" id="date" placeholder="Enter Date"
                                           name="Date">
                                </div>

                                <div class="form-group">
                                    <label for="text">Text:</label>
                                    <textarea class="form-control" rows="5" id="text" name="text"></textarea>
                                </div>

                                <div class="custom-file">
                                    <input type="file" accept="image/*" name="image" class="custom-file-input"
                                           id="chooseFile" onchange="loadFile(event)">
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <strong> Image:</strong><br/>
                                    <img id="output" width="150px"/>
                                </div>
                                <div id="delete"></div>

                                <div class="form-group">
                                    <label for="sel1">Completed?:</label>
                                    <select class="form-control" id="sel1" name="status">
                                        <option></option>
                                        <option value="completed">Completed</option>
                                        <option value="not_completed">Not Completed</option>
                                    </select>
                                </div>


                                <div class="form-group mb-3">
                                    <label for="select2Multiple">Multiple Tags</label>
                                    <select class="select2-multiple form-control" name="tag_id[]" multiple="multiple"
                                            id="select2Multiple">
                                    </select>
                                    <div id="test-list"></div>
                                </div>

                                <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        {{ $toDoLists->links('pagination::simple-bootstrap-5') }}
    </div>

@endsection


@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--    <!-- Latest compiled JavaScript -->--}}
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
