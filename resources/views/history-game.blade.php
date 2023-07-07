@extends('main')

@section('container')
<div id="gameContainer">
        <h1>Tic Tac Toe</h1>
        <div id="cellContainer">
            <div cellIndex="0" class="cell"></div>
            <div cellIndex="1" class="cell"></div>
            <div cellIndex="2" class="cell"></div>
            <div cellIndex="3" class="cell"></div>
            <div cellIndex="4" class="cell"></div>
            <div cellIndex="5" class="cell"></div>
            <div cellIndex="6" class="cell"></div>
            <div cellIndex="7" class="cell"></div>
            <div cellIndex="8" class="cell"></div>
        </div>
        <h2 id="statusText"></h2>
        <button id="restartBtn">Restart</button>
        <button id="saveBtn">Save Game</button>
    </div>

    <div id="movesData" style="display: none;">{{ $gameHistory->moves }}</div>
@endsection