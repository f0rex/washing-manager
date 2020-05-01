@extends('layouts.app')

@section('content')
<div class="notification is-warning has-text-centered">   
    <strong>Versione 1.1:</strong> Sistemata la generazione del calendario. Generare un nuovo calendario per correggere gli errori in quello attuale
</div>
<h1 class="title has-text-centered">
    Calendario
</h1>
@foreach ($schedules as $day => $types)
        @if ($loop->index % 7 == 0)
        <div class="columns">
        @endif
        <div class="column">

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
                        <del>{{ $listing->vehicle->plate }} ({{ $listing->vehicle->group->name }})</del>
                        @endif
                        <br>
                        @endforeach
                    </p>
                    @endforeach
               
@if ($loop->iteration % 7 == 0)
</div>
        @endif

</div>
@endforeach
@endsection