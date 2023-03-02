@extends('layouts.app')

@section('content')

<div class="container">

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
            Session::forget('success');
        @endphp
    </div>
    @endif

    <div class="row">
        <div class="col-md-4 with-background">
            <div class="col-sm-5 col-md-5 col-lg-5">
                <h2>Banks</h2>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Add Project') }}</div>

                <div class="px-4">
                    <form action="/projects" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Project Name">
                            @if ($errors->has('name'))
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div class="col-md-7 table-responsive with-background margin-left">
        <div>
            @csrf
            
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <input type="text" class="form-control" id="search_field" name="search_field" placeholder="E.g Marketing system">
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-primary" id="search">Search</button>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-secondary" id="clear">Clear</button>
                </div>
            </div>
        </div>
  
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th scope="col" class="col-sm-4 col-md-4 col-lg-4">Name</th>
                    <th scope="col" class="col-sm-2 col-md-2 col-lg-4">Added By</th>
                    <th scope="col" class="col-sm-2 col-md-2 col-lg-3">Actions</th>
                </tr>
            </thead>
            
            <tbody>
               @if ($banks->count() == 0)
                   <tr>
                       <td colspan="4" class="text-danger text-center"><strong>No Project(s) to display</strong></td>
                   </tr> 
               @endif
            <?php $counter = 1; ?>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $counter }}.</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->user->name }}</td>
                    <td class="row custom-buttons">
                        <a href="projects/{{ $project->id }}/edit" class="btn btn-success mr-2">Edit</a>
                        <form action="/projects/{{ $project->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php $counter++; ?>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $projects->links() !!}
    </div>
    <div class="d-flex justify-content-center padding-top-1">
        <p>Displaying {{ $projects->count() }} of {{ $projects->total() }} Project(s)</p>
    </div>
    </div>
    </div>
</div>


<script type="text/javascript">
    function filterResults () {
        let search_field = document.getElementById("search_field");
        let href = '/projects';

        if(search_field.value !== '') {
            href += '?search=' + search_field.value;
        }

        document.location.href=href;
    }

    document.getElementById("search").addEventListener("click", filterResults);
    document.getElementById("clear").addEventListener("click", filterResults);
</script>

@endsection