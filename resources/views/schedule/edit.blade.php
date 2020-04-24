@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Modifica lavaggio
</h1>
<form action="{{ route('schedule.update', ['schedule' => $schedule]) }}" method="POST">
    @method('put')
    @csrf
    <div class="field">
        <label class="label">Data lavaggio</label>
        <div class="control">
            <input name="scheduled_at" class="input" type="date" value="{{ $schedule->scheduled_at }}" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Tipo</label>
        <div class="control is-expanded">
            <div class="select is-fullwidth">
                <select name="type" required>
                    <option value="">--- Seleziona un tipo ---</option>
                    <option value="internal" @if ($schedule->type == 'internal') selected @endif>Interno</option>
                    <option value="external" @if ($schedule->type == 'external') selected @endif>Esterno</option>
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Veicolo</label>
        <div class="control is-expanded">
            <div class="select is-fullwidth">
                <select name="vehicle" required>
                    <option value="">--- Seleziona un veicolo ---</option>
                    @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" @if ($schedule->vehicle->id == $vehicle->id) selected @endif>{{ $vehicle->plate }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Lavaggio effettuato il</label>
        <div class="control">
            <input name="washed_at" class="input" type="date" value="{{ $schedule->washed_at }}">
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary">Modifica</button>
        </div>
    </div>
</form>

@endsection