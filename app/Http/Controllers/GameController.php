<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

/**
 * GameController
 *
 * Controller for managing game-related actions and views.
 */
class GameController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function homeIndex()
    {
        return view('home');
    }

    /**
     * Show the new game page.
     *
     * @return \Illuminate\View\View
     */
    public function newGameIndex()
    {
        return view('new-game');
    }

    /**
     * Show the game history page.
     *
     * @return \Illuminate\View\View
     */
    public function historyIndex()
    {
        return view('history', [
            'gameList' => Game::all(),
        ]);
    }

    /**
     * Save a new game.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $moves = $request->input('moves');

        // Create a new game history record
        $game = new Game();
        $game->moves = $moves;
        $game->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the game history details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Find the game history record by its ID
        $gameHistory = Game::find($id);

        if (!$gameHistory) {
            return redirect()->back()->with('error', 'Game history not found');
        }

        // Pass the game history record to the view
        return view('history-game', [
            'gameHistory' => $gameHistory
        ]);
    }

    /**
     * Update the moves of a game history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMoves(Request $request, $id)
    {
        // Retrieve the game history record based on the specific criteria
        $gameHistory = Game::find($id);

        $moves = $request->input('moves');
        
        // Retrieve the existing moves and append the new moves
        $existingMoves = json_decode($gameHistory->moves);
        $newMoves = json_decode($moves);
        $updatedMoves = array_merge($existingMoves, $newMoves);

        // Update the moves field with the updated moves data
        $gameHistory->moves = json_encode($updatedMoves);

        // Save the updated game history record
        $gameHistory->save();

        return response()->json(['success' => true]);
    }
}
