@extends('main')

@section('container')
        @if(count($gameList) > 0)
                <div id="historyList" class="">
                        <a href="../" class="mx-3">
                                <button type="button" class="btn btn-primary">Home</button>
                        </a>
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
                                                        <td>{{ $game->created_at->format('Y-m-d H:i:s') }}</td>
                                                        <td>{{ $game->updated_at->format('Y-m-d H:i:s') }}</td>
                                                        <td>
                                                                <a href="../game-history/{{ $game->id }}" class="text-decoration-none">Load Game</a>
                                                        </td>
                                                </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </div>
        @else
                <h1 class="text-center">You don't have the history games!</h1> 
                <div class="d-flex align-items-center justify-content-center p-1">
                        <a href="../" class="mx-3">
                                <button type="button" class="btn btn-primary">Home</button>
                        </a>
                </div>
        @endif
        
@endsection