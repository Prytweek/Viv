@extends('layouts.app')
@section('title') {{ $milestone->codename }} &middot; Milestone @endsection

@section('toolset')
<a class="dropdown-item" href="{{ route('editMilestone', ['id' => $milestone->id]) }}"><i class="fal fa-fw fa-pencil"></i> Edit milestone</a>
<form method="POST" action="{{ route('destroyMilestone', ['id' => $milestone->id]) }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="dropdown-item"><i class="fal fa-fw fa-trash-alt"></i> Delete milestone</button>
</form>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron tabs build-header">
    <div class="container">
        <h2><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} <span class="font-weight-normal">version {{ $milestone->version }}</span></h2>
        <h6>{{ $milestone->codename }}{!! $milestone->name !== '' ? ' &middot; '.$milestone->name : '' !!}</h6>
        <p class="lead">{{ $milestone->description }}</p>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link active" href="{{ route('showMilestone', ['id' => $milestone->id]) }}">
                    Overview
                </a>
                @foreach ($platforms as $platform)
                    <a class="nav-link" href="{{ route('platformMilestone', ['id' => $milestone->id, 'platform' => getPlatformClass($platform->platform)]) }}">
                        {{ getPlatformById($platform->platform) }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 previous-milestone">
        @if ($previous)
            <a href="{{ route('showMilestone', ['id' => $previous->id]) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="fal fa-fw fa-angle-double-left"></i>
                <i class="fab fa-fw fa-windows"></i>
                <span class="font-weight-bold">{{ $previous->osname }}</span>
                <span class="d-none d-sm-inline d-lg-none"><br /></span> {{ $previous->name }}
            </a>
        @endif
    </div>
    <div class="col-12 col-sm-6 next-milestone">
        @if ($next)
            <a href="{{ route('showMilestone', ['id' => $next->id]) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i>
                <span class="font-weight-bold">{{ $next->osname }}</span>
                <i class="fal fa-fw fa-angle-double-right d-none d-sm-inline d-lg-none"></i>
                <span class="d-none d-sm-inline d-lg-none"><br /></span> {{ $next->name }}
                <i class="fal fa-fw fa-angle-double-right d-inline d-sm-none d-lg-inline"></i>
            </a>
        @endif
    </div>
    <div class="spacing-40"></div>
    @if ($milestone->preview->timestamp > 0)
        <div class="col-6 col-md text-center lifecycle-stats">
            <h5>Start Preview</h5>
            <h4>{{ $milestone->preview->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->public->timestamp > 0)
        <div class="col-6 col-md text-center lifecycle-stats">
            <h5>Public Release</h5>
            <h4>{{ $milestone->public->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainEol->timestamp > 0)
        <div class="col-6 col-md text-center lifecycle-stats">
            <h5>Main Support</h5>
            <h4>{{ $milestone->mainEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainXol->timestamp > 0)
        <div class="col-6 col-md text-center lifecycle-stats">
            <h5>Extended Support</h5>
            <h4>{{ $milestone->mainXol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->ltsEol->timestamp > 0)
        <div class="col-6 col-md text-center lifecycle-stats">
            <h5>LTSC Support</h5>
            <h4>{{ $milestone->ltsEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($progress)
        <div class="col-12">
            <div class="progress">
                <div class="progress-bar bg-preview-done" style="width: {{ $progress['preview_done'] }}%"></div>
                <div class="progress-bar bg-preview-go" style="width: {{ $progress['preview_go'] }}%"></div>
                <div class="progress-bar bg-public-done" style="width: {{ $progress['public_done'] }}%"></div>
                <div class="progress-bar bg-public-go" style="width: {{ $progress['public_go'] }}%"></div>
                <div class="progress-bar bg-extended-done" style="width: {{ $progress['extended_done'] }}%"></div>
                <div class="progress-bar bg-extended-go" style="width: {{ $progress['extended_go'] }}%"></div>
                <div class="progress-bar bg-lts-done" style="width: {{ $progress['lts_done'] }}%"></div>
                <div class="progress-bar bg-lts-go" style="width: {{ $progress['lts_go'] }}%"></div>
            </div>
        </div>
    @endif
    <div class="spacing-40"></div>
    @foreach ($platforms as $platform)
        <div class="col-xl-4 col-lg-6 col-12 platform-card">
            <h4>{{ getPlatformById($platform->platform) }}</h4>
            <h6>{{ $platform->count }} builds</h6>
            
            <div class="timeline">
                @foreach ($platform->builds as $build)
                    <div class="timeline-row">
                        <a class="row" href="{{ route('showRelease', ['build' => $build->build, 'platform' => getPlatformClass($build->platform)]) }}">
                            <div class="col-5 build"><img src="{{ asset('img/platform/'.getPlatformImage($build->platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($build->platform) }}" />{{ $build->build }}.{{ $build->delta }}</div>
                            <div class="col-3 ring">
                                <span class="label {{ $build->class }}">{{ $build->flight }}</span>
                            </div>
                            <div class="col-4 date">
                                <span class="date">{{ $build->date->format('j M Y') }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="timeline-row">
                    <a class="row" href="{{ route('showMilestone', ['id' => $milestone->id, 'platform' => getPlatformClass($platform->platform)]) }}">
                        <div class="col"><img src="{{ asset('img/platform/'.getPlatformImage($platform->platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform->platform) }}" /></div>
                        <div class="col text-right">
                            See all <i class="fal fa-fw fa-angle-double-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection