@extends('main')

@section('container')
        <div id="historyList" class="">
                <table class="table">
                        <thead>
                                <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Last Played</th>
                                        <th scope="col">Load Games</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach ($gameList as $game)
                                        <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $game->created_at }}</td>
                                                <td>{{ $game->updated_at }}</td>
                                                <td>
                                                        <a href="../game-history/{{ $game->id }}" class="text-decoration-none">Load Game</a>
                                                </td>
                                        </tr>
                                @endforeach
                        </tbody>
                </table>
        </div>
@endsection