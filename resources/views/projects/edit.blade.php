@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Project') }}</div>

                <div class="px-4">
                    <form action="/projects/{{ $project->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name  }}">
                            @if ($errors->has('name'))
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description"> Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $project->description  }}</textarea>
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
@endsection
