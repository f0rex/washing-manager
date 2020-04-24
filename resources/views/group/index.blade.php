@extends('layouts.app')

@section('content')

<div class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title has-text-centered">Gruppi di veicoli</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            <a class="button is-primary is-centered" href="{{ route('group.create') }}">Crea gruppo</a>
        </div>
    </div>
</div>
<p>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>Nome gruppo</th>
                <th>Veicoli</th>
                <th>Pulizia interni/28 giorni</th>
                <th>Pulizia esterni/28 giorni</th>
                <th class="has-text-centered">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $group->vehicles()->count() }}</td>
                <td>{{ $group->internal }}</td>
                <td>{{ $group->external }}</td>
                <td>
                    <div class="buttons is-centered">
                        <a href="{{ route('group.edit', ['group' => $group]) }}" class="button is-warning">Modifica</a>
                        <form action="{{ route('group.destroy', ['group' => $group]) }}" method="POST">
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
            