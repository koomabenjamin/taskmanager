@extends('layouts.app')

@section('content')

<div class="container with-background">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h2>Tasks</h2>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            @csrf
            
            <div class="row">
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="text" class="form-control" id="search_field" name="search_field" placeholder="E.g Interface design">
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 row">
                    <button type="submit" class="btn btn-primary" id="search">Search</button>
                </div>
                <div class="col-sm-1 col-md-1 col-lg-1">
                    <button type="submit" class="btn btn-secondary" id="clear">Clear</button>
                </div>
            </div>
        </div>
         
            <div class="col-sm-2 col-md-2 col-lg-2 text-right">
                <a href="tasks/create" class="btn btn-primary">Add Task</a>
            </div>
    </div>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
            Session::forget('success');
        @endphp
    </div>
    @endif

        <div class="py-4 table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th scope="col" class="col-sm-4 col-md-4 col-lg-3">Name</th>
                        <th scope="col" class="col-sm-1 col-md-1 col-lg-1">Project</th>
                        <th scope="col" class="col-sm-4 col-md-4 col-lg-2">Category</th>
                        <th scope="col" class="col-sm-4 col-md-4 col-lg-2">Tags</th>
                        <th scope="col" class="col-sm-2 col-md-2 col-lg-2">Members</th>
                        <th scope="col" class="col-sm-2 col-md-2 col-lg-2">Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if ($tasks->count() == 0)
                       <tr>
                           <td colspan="7" class="text-danger text-center"><strong>No Tasks to display</strong></td>
                       </tr> 
                   @endif
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->tags }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td class="row">
                            <a href="tasks/{{ $task->id }}/edit" class="btn btn-success mr-2">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $tasks->links() !!}
        </div>
        </div>

</div>

<script type="text/javascript">
    function filterResults () {
        let search_field = document.getElementById("search_field");
        let href = '/tasks';

        if(search_field.value !== '') {
            href += '?search=' + search_field.value;
        }

        document.location.href=href;
    }

    document.getElementById("search").addEventListener("click", filterResults);
    document.getElementById("clear").addEventListener("click", filterResults);
</script>

@endsection