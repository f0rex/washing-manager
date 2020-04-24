@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Crea gruppo di vetture
</h1>
<form action="{{ route('group.store') }}" method="POST">
    @csrf
    <div class="field">
        <label class="label">Nome del gruppo</label>
        <div class="control">
            <input name="name" class="input" type="text" placeholder="Esempio: Furgoni" required>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <label class="label">Giorni della settimana</label>
            <label class="checkbox"><input name='days[]' value='mon' type="checkbox"> Lunedì</label><br>
            <label class="checkbox"><input name='days[]' value='tue' type="checkbox"> Martedì</label><br>
            <label class="checkbox"><input name='days[]' value='wed' type="checkbox"> Mercoledì</label><br>
            <label class="checkbox"><input name='days[]' value='thu' type="checkbox"> Giovedì</label><br>
            <label class="checkbox"><input name='days[]' value='fri' type="checkbox"> Venerdì</label><br>
            <label class="checkbox"><input name='days[]' value='sat' type="checkbox"> Sabato</label><br>
            <label class="checkbox"><input name='days[]' value='sun' type="checkbox"> Domenica</label>
        </div>
    </div>
    <div class="field">
        <label class="label">Numero di volte di pulizia interni per ciascuna vettura in 28 giorni</label>
        <div class="control">
            <input name="internal" type="number" class="input" placeholder="Esempio: 4" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Numero di volte di pulizia esterni per ciascuna vettura in 28 giorni</label>
        <div class="control">
            <input name="external" type="number" class="input" placeholder="Esempio: 1" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Numero di vetture nel gruppo</label>
        <div class="control">
            <input v-model.number="vehicles" name="vehicles" type="number" class="input" placeholder="Esempio: 10" required>
        </div>
    </div>
    <div class="field" v-for="vehicle in vehicles">
        <label class="label">Vettura #@{{ vehicle }}</label>
        <div class="control">
            <input name="plates[]" class="input" type="text" placeholder="Targa">
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary">Crea</button>
        </div>
    </div>
</form>

@endsection