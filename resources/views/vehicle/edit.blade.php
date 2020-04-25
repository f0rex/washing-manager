@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Modifica vettura
</h1>
<form action="{{ route('vehicle.update', ['vehicle' => $vehicle]) }}" method="POST">
    @method('put')
    @csrf
    <div class="field">
        <label class="label">Targa</label>
        <div class="control">
            <input name="plate" class="input @error('plate') is-danger @enderror" type="text" value="{{ $vehicle->plate }}" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Gruppo</label>
        <div class="control is-expanded">
            <div class="select is-fullwidth @error('group') is-danger @enderror">
                <select name="group" required>
                    <option value="">--- Seleziona un gruppo ---</option>
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}" @if ($group->id == $vehicle->group->id) selected @endif>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Ultimo lavaggio interno</label>
        <div class="control">
            <input name="last_washed_internally_at" class="input @error('last_washed_internally_at') is-danger @enderror" type="date" value="{{ $vehicle->last_washed_internally_at }}">
        </div>
    </div>
    <div class="field">
        <label class="label">Ultimo lavaggio esterno</label>
        <div class="control">
            <input name="last_washed_externally_at" class="input @error('last_washed_externally_at') is-danger @enderror" type="date" value="{{ $vehicle->last_washed_externally_at }}">
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary">Modifica</button>
        </div>
    </div>
</form>

@endsection