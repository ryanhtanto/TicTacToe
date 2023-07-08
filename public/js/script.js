/**
 * Tic Tac Toe Game
 *
 * Handles the game logic and interaction.
 */

// Selectors
const cells = document.querySelectorAll(".cell");
const statusText = document.querySelector("#statusText");
const restartBtn = document.querySelector("#restartBtn");
const saveBtn = document.querySelector("#saveBtn");

// Game Variables
const winConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
];
let options = ["", "", "", "", "", "", "", "", ""];
let currentPlayer = "X";
let running = false;
let moveHistory = [];

initializeGame();

/**
 * Initialize the game.
 */
function initializeGame() {
    cells.forEach((cell) => cell.addEventListener("click", cellClicked));
    restartBtn.addEventListener("click", restartGame);
    saveBtn.addEventListener("click", saveGame); // Add event listener for save button
    statusText.textContent = `${currentPlayer}'s turn`;
    running = true;
}

/**
 * Load the game data and update the UI.
 * @param {string} movesData - The moves data in JSON format.
 */
const movesData = document.querySelector("#movesData").textContent;
loadGameData(movesData);

function loadGameData(movesData) {
    // Parse the moves data into an array
    const moves = JSON.parse(movesData);

    // Reset the options array
    options = ["", "", "", "", "", "", "", "", ""];


    // Update the cells based on the moves data
    moves.forEach((move) => {
        const cellIndex = move.index;
        const player = move.player;
        options[cellIndex] = player; // Update the options array
    });

    // Display the moves in the cells
    cells.forEach((cell, index) => {
        cell.textContent = options[index];
    });

    // Check the winner
    checkWinner();
}

/**
 * Handle the click event on a cell.
 */
function cellClicked() {
    const cellIndex = this.getAttribute("cellIndex");

    if (options[cellIndex] != "" || !running) {
        return;
    }

    updateCell(this, cellIndex);
    checkWinner();

    // Save the move to the history
    moveHistory.push({
        index: cellIndex,
        player: this.textContent
    });

}

/**
 * Update the selected cell with the current player's symbol.
 * @param {Element} cell - The selected cell element.
 * @param {number} index - The index of the cell.
 */
function updateCell(cell, index) {
    options[index] = currentPlayer;
    cell.textContent = currentPlayer;
}

/**
 * Switch the current player.
 */
function changePlayer() {
    currentPlayer = currentPlayer == "X" ? "O" : "X";
    statusText.textContent = `${currentPlayer}'s turn`;
}

/**
 * Check for a winner or draw.
 */
function checkWinner() {
    let roundWon = false;

    for (let i = 0; i < winConditions.length; i++) {
        const condition = winConditions[i];
        const cellA = options[condition[0]];
        const cellB = options[condition[1]];
        const cellC = options[condition[2]];

        if (cellA == "" || cellB == "" || cellC == "") {
            continue;
        }
        if (cellA == cellB && cellB == cellC) {
            roundWon = true;
            break;
        }
    }

    if (roundWon) {
        statusText.textContent = `${currentPlayer} wins!`;
        running = false;
    } else if (!options.includes("")) {
        statusText.textContent = `Draw!`;
        running = false;
    } else {
        changePlayer();
    }
}

/**
 * Restart the game.
 */
function restartGame() {
    currentPlayer = "X";
    options = ["", "", "", "", "", "", "", "", ""];
    statusText.textContent = `${currentPlayer}'s turn`;
    cells.forEach((cell) => (cell.textContent = ""));
    running = true;
    moveHistory = [];
}

/**
 * Save the game data to the database when dave button clicked.
 */
function saveGame() {
    saveGameToDatabase(moveHistory);
}

/**
 * Save the game data to the database using AJAX.
 * @param {Array} moveHistory - The move history array.
 */
function saveGameToDatabase(moveHistory) {
	// Convert the move history to a JSON string
	const moves = JSON.stringify(moveHistory);
	// Send a separate AJAX request to retrieve the CSRF token
	$.ajax({
            url: "/csrf-token",
            type: "GET",
            success: function(response) {
            // Extract the CSRF token from the response
            const csrfToken = response.csrfToken;

            const gameId = document.querySelector("#saveBtn").dataset.gameId;

            // Send another AJAX request to the Laravel route to save the data
            // Check if the game ID is present
            if (gameId) {
                // Send the AJAX request to update the game data
                $.ajax({
                    url: "/update/" + gameId,
                    type: "POST",
                    data: {
                        _token: csrfToken, // Include the CSRF token
                        moves: moves,
                    },
                    success: function (response) {
                        console.log(response);
                        alert('Game Saved');
                    },
                    error: function (xhr, status, error) {
                        alert("Error updating game!");
                        console.error("Error updating game:", error);
                        console.log(xhr);
                        console.log(status);
                    },
                });
            } else {
                // calidate not null
                if(moves !== '[]'){
                    // Send the AJAX request to save the game data
                    $.ajax({
                        url: "/save",
                        type: "POST",
                        data: {
                            _token: csrfToken, // Include the CSRF token
                            moves: moves,
                        },
                        success: function (response) {
                            console.log(response);
                            alert('Game Saved');
                        },
                        error: function (xhr, status, error) {
                            alert("Error saving game!");
                            console.error("Error saving game:", error);
                            console.log(xhr);
                            console.log(status);
                        },
                    });
                }else{
                    alert('Game can not be null!');
                }
            }
        },
            error: function(xhr, status, error) {
            console.error("Error retrieving CSRF token:", error);
        }
	});
}