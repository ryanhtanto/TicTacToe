@extends('main')

@section('container')
        <h1 class="text-center">Welcome to Tic Tac Toe Game!</h1>
        <p class="text-center">Select option in the bottom</p>
        <div class="d-flex align-items-center justify-content-center">
                <a href="../new-game" class="p-5">
                        <button type="button" class="btn btn-primary">New Game</button>
                </a>
                <a href="../history" class="p-5">
                        <button type="button" class="btn btn-primary">History</button>
                </a>
        </div>
        
@endsection