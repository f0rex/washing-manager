@extends('layouts.app')

@section('content')

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title has-text-centered">Calendario</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <div class="buttons">
                <a class="button is-primary is-centered" href="{{ route('schedule.create') }}">Aggiungi lavaggio</a>
                <a class="button is-primary is-centered" href="{{ route('generator.create') }}">Genera calendario</a>
            </div>
        </div>
    </div>
</div>
<p>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Veicolo</th>
                <th>Lavato</th>
                <th class="has-text-centered">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
            <tr>
                <td>
                    @if (!is_null($schedule->scheduled_at))
                    {{ date('j F Y', strtotime($schedule->scheduled_at)) }}
                    @endif
                </td>
                <td>{{ $schedule->type }}</td>
                <td>{{ $schedule->vehicle->plate }}</td>
                <td>
                    @if (!is_null($schedule->washed_at))
                    <span class="icon has-text-success">
                        <i class="fas fa-check"></i>
                      </span>
                    @endif
                </td>
                <td>
                    <div class="buttons is-centered">
                        <a href="{{ route('schedule.edit', ['schedule' => $schedule]) }}" class="button is-warning">Modifica</a>
                        <form action="{{ route('schedule.destroy', ['schedule' => $schedule]) }}" method="POST">
                            <input class="button is-danger" type="submit" value="Elimina">
                            @method('delete')
                            @csrf
                        </form>
                      </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</p>

@endsection
            