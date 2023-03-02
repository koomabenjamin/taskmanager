@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Task') }}</div>

                <div class="px-4">
                    <form action="/tasks" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Task Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Task Name">
                            @if ($errors->has('name'))
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="project_id">Project Name</label>
                                <select class="form-control select2 select-search" name="project_id">
                                    @foreach ($projects as $project )
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_id'))
                                    <strong class="text-danger">{{ $errors->first('project_id') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="members">Members</label>
                            <select class="form-control" name="members">
                                @foreach ($members as $member )
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('members'))
                                <strong class="text-danger">{{ $errors->first('members') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category">Task Category</label>
                            <input type="text" class="form-control" id="category" name="category" placeholder="Task Category">
                            @if ($errors->has('category'))
                                <strong class="text-danger">{{ $errors->first('category') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="priority_level">Task Priority Level</label>
                            <input type="text" class="form-control" id="priority_level" name="priority_level" placeholder="Task Priority Level">
                            @if ($errors->has('priority_level'))
                                <strong class="text-danger">{{ $errors->first('priority_level') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Task Tags</label>
                            <textarea class="form-control" id="tags" rows="3" name="tags" placeholder="Task Tags"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select-search').select2();
    });
</script>

@endsection

