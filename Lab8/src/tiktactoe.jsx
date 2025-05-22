import React, { useState } from "react";
import "./App.css";

const TicTacToe = () => {
  const [board, setBoard] = useState(Array(9).fill(null));
  const [isXNext, setIsXNext] = useState(true);

  const winner = calculateWinner(board);

  const handleClick = (index) => {
    if (board[index] || winner) return;
    const newBoard = [...board];
    newBoard[index] = isXNext ? "X" : "O";
    setBoard(newBoard);
    setIsXNext(!isXNext);
  };

  const handleRestart = () => {
    setBoard(Array(9).fill(null));
    setIsXNext(true);
  };

  const renderSquare = (i) => (
    <button className="square" onClick={() => handleClick(i)}>
      {board[i]}
    </button>
  );

  return (
    <div className="container">
      <h1 className="title">Tic Tac Toe</h1>
      <div className="status">
        {winner
          ? `🎉 Winner: ${winner}`
          : board.includes(null)
            ? `Next Player: ${isXNext ? "X" : "O"}`
            : "😐 It's a Draw!"}
      </div>
      <div className="board">
        {[0, 3, 6].map((rowStart) => (
          <div className="row" key={rowStart}>
            {renderSquare(rowStart)}
            {renderSquare(rowStart + 1)}
            {renderSquare(rowStart + 2)}
          </div>
        ))}
      </div>
      <button className="restart" onClick={handleRestart}>
        🔄 Restart Game
      </button>
    </div>
  );
};

function calculateWinner(squares) {
  const lines = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];
  for (let [a, b, c] of lines) {
    if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
      return squares[a];
    }
  }
  return null;
}

export default TicTacToe;
