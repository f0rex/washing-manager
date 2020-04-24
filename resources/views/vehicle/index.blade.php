@extends('layouts.app')

@section('content')

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title has-text-centered">Veicoli</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a class="button is-primary is-centered" href="{{ route('vehicle.create') }}">Crea veicolo</a>
        </div>
    </div>
</div>
<p>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>Targa veicolo</th>
                <th>Gruppo</th>
                <th>Ultimo lavaggio interno</th>
                <th>Ultimo lavaggio esterno</th>
                <th class="has-text-centered">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->plate }}</td>
                <td>
                    @if ($vehicle->group)
                    {{ $vehicle->group->name }}
                    @endif
                </td>
                <td>
                    @if (!is_null($vehicle->last_washed_internally_at))
                    {{ date('j F Y', strtotime($vehicle->last_washed_internally_at)) }}
                    @endif
                </td>
                <td>
                    @if (!is_null($vehicle->last_washed_externally_at))
                    {{ date('j F Y', strtotime($vehicle->last_washed_externally_at)) }}
                    @endif
                </td>
                <td>
                    <div class="buttons is-centered">
                        <a href="{{ route('vehicle.edit', ['vehicle' => $vehicle]) }}" class="button is-warning">Modifica</a>
                        <form action="{{ route('vehicle.destroy', ['vehicle' => $vehicle]) }}" method="POST">
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
            