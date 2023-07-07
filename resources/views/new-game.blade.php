@extends('main')

@section('container')
	<div id="gameContainer">
		<h1 class="text-center">Tic Tac Toe</h1>
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
		<h2 id="statusText" class="text-center"></h2>
                <div class="d-flex align-items-center justify-content-center p-1">
                        <button id="restartBtn" type="button" class="btn btn-primary mx-3">Restart</button>
		        <button id="saveBtn" type="button" class="btn btn-primary mx-3">Save Game</button>   
                </div>
                <div class="d-flex align-items-center justify-content-center p-1">
                        <a href="../" class="mx-3">
                                <button type="button" class="btn btn-primary">Home</button>
                        </a>
                        <a href="../history" class="mx-3">
                                <button type="button" class="btn btn-primary">History</button>
                        </a>
                </div>
	</div>
@endsection