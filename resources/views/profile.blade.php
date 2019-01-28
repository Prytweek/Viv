@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Hello {{ Auth::user()->name }}</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <h2>Settings</h2>
        <form method="POST" action="{{ route('updateProfile', Auth::user()->id) }}" class="row">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme-light" value="0" {{ Auth::user()->theme == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="theme-light">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme-dark" value="1" {{ Auth::user()->theme == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="theme-dark">Dark</label>
                </div>
            </div>
            <div class="spacing-20"></div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fal fa-fw fa-save"></i> Save</button>
            </div>
        </form>
        @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
            <div class="spacing-20"></div>
            <h2>Insider features</h2>
            <p>There are currently no Insider features available.</p>
        @endif
    </div>
    <div class="col-12 col-md-4">
        <h2>Details</h2>
        <p>
            <b>Name</b>: {{ Auth::user()->name }}<br />
            <b>Email</b>: {{ Auth::user()->email }}<br />
            <b>Role</b>: {{ Auth::user()->getRoles()->name }}
        </p>
    </div>
</div>
@endsection