@extends('layouts.app')

@section('content')
<h1 class="title has-text-centered">
    Calendario
</h1>
@foreach ($schedules as $day => $types)
<div class="box">
    <article class="media">
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ date('l j F, Y', strtotime($day)) }}</strong>
                    <br>
                    @foreach ($types as $type => $listings)
                    <p>
                        <span class="tag is-primary">
                            {{ $type }}
                        </span>
                        <br>
                        @foreach ($listings as $listing)
                        @if (is_null($listing->washed_at))
                        {{ $listing->vehicle->plate }} ({{ $listing->vehicle->group->name }})
                        <a href="{{ route('schedule.wash', ['schedule' => $listing]) }}">
                            <span class="icon has-text-success">
                                <i class="fas fa-soap"></i>
                            </span>
                        </a>
                        @else
                        <del>{{ $listing->vehicle->plate }}</del>
                        @endif
                        <br>
                        @endforeach
                    </p>
                    @endforeach
                </p>
            </div>
        </div>
    </article>
</div>
@endforeach
@endsection