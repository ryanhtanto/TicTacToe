<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function homeIndex()
    {
        return view('home');
    }

    public function newGameIndex()
    {
        return view('new-game');
    }

    public function historyIndex()
    {
        return view('history', [
            'gameList' => Game::all(),
        ]);
    }

    public function save(Request $request)
    {
        // Validate the input

        $moves = $request->input('moves');

        // Create a new game history record
        $game = new Game();
        $game->moves = $moves;
        $game->save();

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        // Find the game history record by its ID
        $gameHistory = Game::find($id);

        if (!$gameHistory) {
            return redirect()->back()->with('error', 'Game history not found');
        }

        // Pass the game history record to the view
        return view('history-game', ['gameHistory' => $gameHistory]);
    }

    public function updateMoves(Request $request, $id)
    {
        // Retrieve the game history record based on the specific criteria
        $gameHistory = Game::find($id);

        $moves = $request->input('moves');

        // Update the moves field with the new moves data
        $gameHistory->moves = $moves;

        // Save the updated game history record
        $gameHistory->save();

        return response()->json(['success' => true]);
    }

}
