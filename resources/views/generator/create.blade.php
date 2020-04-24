@extends('layouts.app')

@section('content')
@if ($groupsNotCreated || $vehiclesNotCreated)
<p class="has-text-centered">Per iniziare, crea dei gruppi e aggiungi i veicoli</p>
@else
<p class="has-text-centered">Clicca sul pulsante per generare il calendario. Se è stato generato un calendario precedentemente, verrà sovrascritto</p>
<div class="columns is-centered">
    <div class="column is-half">
        <form action="{{ route('generator.generate') }}" method="POST">
            @csrf
            <div class="field is-grouped is-grouped-centered">
                <div class="control">
                <div class="select is-fullwidth">
                    <select name="weeks" required>
                        @for ($i = 1; $i < 11; $i++)
                        <option value="{{ $i * 4 }}">{{ $i * 4 }} settimane</option>
                        @endfor
                    </select>
                </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary">Genera calendario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
            