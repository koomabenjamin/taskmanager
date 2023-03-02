@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Drug') }}</div>

                <div class="px-4">
                    <form action="/drugs/{{ $drug->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Drug Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $drug->name  }}">
                            @if ($errors->has('name'))
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <label for="weight">Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight" value="{{ $drug->weight  }}">
                                @if ($errors->has('weight'))
                                    <strong class="text-danger">{{ $errors->first('weight') }}</strong>
                                @endif
                            </div>
                            <div class="col">
                                <label for="weight_unit_id">Weight Unit</label>
                                <select class="form-control" name="weight_unit_id">
                                @foreach ($weightunits as $weightunit )
                                    <option value="{{ $weightunit->id }}" @if ($weightunit->id == $drug->weight_unit_id)
                                        {!! 'selected' !!}
                                    @endif>{{ $weightunit->name }}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('weight_unit_id'))
                                    <strong class="text-danger">{{ $errors->first('weight_unit_id') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_country_id">Manufacturer Country</label>
                            <select class="form-control" name="manufacturer_country_id">
                                @foreach ($manufacturercountries as $manufacturercountry )
                                    <option value="{{ $manufacturercountry->id }}" @if ($manufacturercountry->id == $drug->manufacturer_country_id)
                                        {!! 'selected' !!}
                                    @endif>{{ $manufacturercountry->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('manufacturer_country_id'))
                                <strong class="text-danger">{{ $errors->first('manufacturer_country_id') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Class Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $drug->description  }}</textarea>
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
