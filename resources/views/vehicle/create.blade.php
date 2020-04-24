@extends('layouts.app')

@section('content')

<h1 class="title has-text-centered">
    Crea vettura
</h1>
<form action="{{ route('vehicle.store') }}" method="POST">
    @csrf
    <div class="field">
        <label class="label">Targa</label>
        <div class="control">
            <input name="plate" class="input" type="text" placeholder="Targa" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Gruppo</label>
        <div class="control is-expanded">
            <div class="select is-fullwidth">
                <select name="group" required>
                    <option value="">--- Seleziona un gruppo ---</option>
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
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