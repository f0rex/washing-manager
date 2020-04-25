@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Modifica gruppo di vetture
</h1>
<form action="{{ route('group.update', ['group' => $group]) }}" method="POST">
    @method('put')
    @csrf
    <div class="field">
        <label class="label">Nome del gruppo</label>
        <div class="control">
            <input name="name" class="input @error('name') is-danger @enderror" type="text" value={{ $group->name }} required>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <label class="label">Giorni della settimana</label>
            <label class="checkbox"><input name='days[]' value='mon' type="checkbox" @if ($group->mon) checked @endif> Lunedì</label><br>
            <label class="checkbox"><input name='days[]' value='tue' type="checkbox" @if ($group->tue) checked @endif> Martedì</label><br>
            <label class="checkbox"><input name='days[]' value='wed' type="checkbox" @if ($group->wed) checked @endif> Mercoledì</label><br>
            <label class="checkbox"><input name='days[]' value='thu' type="checkbox" @if ($group->thu) checked @endif> Giovedì</label><br>
            <label class="checkbox"><input name='days[]' value='fri' type="checkbox" @if ($group->fri) checked @endif> Venerdì</label><br>
            <label class="checkbox"><input name='days[]' value='sat' type="checkbox" @if ($group->sat) checked @endif> Sabato</label><br>
            <label class="checkbox"><input name='days[]' value='sun' type="checkbox" @if ($group->sun) checked @endif> Domenica</label>
        </div>
    </div>
    <div class="field">
        <label class="label">Numero di volte di pulizia interni per ciascuna vettura in 28 giorni</label>
        <div class="control">
            <input name="internal" type="number" min="1" class="input @error('internal') is-danger @enderror" value={{ $group->internal }} required>
        </div>
    </div>
    <div class="field">
        <label class="label">Numero di volte di pulizia esterni per ciascuna vettura in 28 giorni</label>
        <div class="control">
            <input name="external" type="number" min="1" class="input @error('external') is-danger @enderror" value={{ $group->external }} required>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary">Modifica</button>
        </div>
    </div>
</form>

@endsection