@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Aggiungi lavaggio
</h1>
<form action="{{ route('schedule.store') }}" method="POST">
    @csrf
    <div class="field">
        <label class="label">Data lavaggio</label>
        <div class="control">
            <input name="scheduled_at" class="input" type="date" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Tipo</label>
        <div class="control is-expanded">
            <div class="select is-fullwidth">
                <select name="type" required>
                    <option value="">--- Seleziona un tipo ---</option>
                    <option value="internal">Interno</option>
                    <option value="external">Esterno</option>
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
                    <option value="{{ $vehicle->id }}">{{ $vehicle->plate }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary">Crea</button>
        </div>
    </div>
</form>

@endsection