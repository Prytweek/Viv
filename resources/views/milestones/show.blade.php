@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} {{ $milestone->name }}<small>version {{ $milestone->version }}</small></h2>
        <p class="lead">{{ $milestone->description }}</p>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @if ($previous)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$previous->id) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="fal fa-fw fa-angle-double-left"></i> <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $previous->osname }}</span> {{ $previous->name }}
            </a>
        </div>
    @endif
    @if ($next)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$next->id) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $next->osname }}</span> {{ $next->name }} <i class="fal fa-fw fa-angle-double-right"></i>
            </a>
        </div>
    @endif
    <div class="spacing-20"></div>
    @if ($milestone->preview->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Start Preview</h5>
            <h4>{{ $milestone->preview->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->public->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Public Release</h5>
            <h4>{{ $milestone->public->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainEol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Main Support</h5>
            <h4>{{ $milestone->mainEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainXol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Extended Support</h5>
            <h4>{{ $milestone->mainXol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->ltsEol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>LTSC Support</h5>
            <h4>{{ $milestone->ltsEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    <div class="spacing-20"></div>
    <div class="col-3">
        <h4>PC</h4>
        <h5>{{ $pc_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>Xbox</h4>
        <h5>{{ $xbox_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>IoT</h4>
        <h5>{{ $iot_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>Server</h4>
        <h5>{{ $server_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>Holographic</h4>
        <h5>{{ $holographic_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>Team</h4>
        <h5>{{ $team_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>Mobile</h4>
        <h5>{{ $mobile_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>SDK</h4>
        <h5>{{ $sdk_count }} builds</h5>
    </div>
    <div class="col-3">
        <h4>ISO</h4>
        <h5>{{ $iso_count }} builds</h5>
    </div>
</div>
@endsection