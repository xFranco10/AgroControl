const canvas = document.getElementById('game');
const context = canvas.getContext('2d');
const grid = 15;
const paddleHeight = grid * 5; // 80
const maxPaddleY = canvas.height - grid - paddleHeight;

var paddleSpeed = 6;
var ballSpeed = 5;

var player1Score = 0;
var player2Score = 0;


const leftPaddle = {
  // start in the middle of the game on the left side
  x: grid * 2,
  y: canvas.height / 2 - paddleHeight / 2,
  width: grid,
  height: paddleHeight,

  // paddle velocity
  dy: 0
};
const rightPaddle = {
  // start in the middle of the game on the right side
  x: canvas.width - grid * 3,
  y: canvas.height / 2 - paddleHeight / 2,
  width: grid,
  height: paddleHeight,

  // paddle velocity
  dy: 0
};
const ball = {
  // start in the middle of the game
  x: canvas.width / 2,
  y: canvas.height / 2,
  width: grid,
  height: grid,

  // keep track of when need to reset the ball position
  resetting: false,

  // ball velocity (start going to the top-right corner)
  dx: ballSpeed,
  dy: -ballSpeed
};

// check for collision between two objects using axis-aligned bounding box (AABB)
// @see https://developer.mozilla.org/en-US/docs/Games/Techniques/2D_collision_detection
function collides(obj1, obj2) {
  return obj1.x < obj2.x + obj2.width &&
         obj1.x + obj1.width > obj2.x &&
         obj1.y < obj2.y + obj2.height &&
         obj1.y + obj1.height > obj2.y;
}

function resetBall() {
  ball.resetting = true;
  setTimeout(() => {
    ball.resetting = false;
    ball.x = canvas.width / 2;
    ball.y = canvas.height / 2;
    ball.dx = ballSpeed; // Restablece la velocidad de la bola
    ball.dy = -ballSpeed; // Restablece la velocidad de la bola
  }, 400);
}

// game loop
function loop() {
  requestAnimationFrame(loop);
  context.clearRect(0,0,canvas.width,canvas.height);

  // move paddles by their velocity
  leftPaddle.y += leftPaddle.dy;
  rightPaddle.y += rightPaddle.dy;

  // prevent paddles from going through walls
  if (leftPaddle.y < grid) {
    leftPaddle.y = grid;
  }
  else if (leftPaddle.y > maxPaddleY) {
    leftPaddle.y = maxPaddleY;
  }

  if (rightPaddle.y < grid) {
    rightPaddle.y = grid;
  }
  else if (rightPaddle.y > maxPaddleY) {
    rightPaddle.y = maxPaddleY;
  }

  // draw paddles
  context.fillStyle = 'white';
  context.fillRect(leftPaddle.x, leftPaddle.y, leftPaddle.width, leftPaddle.height);
  context.fillRect(rightPaddle.x, rightPaddle.y, rightPaddle.width, rightPaddle.height);

  // move ball by its velocity
  ball.x += ball.dx;
  ball.y += ball.dy;

  // prevent ball from going through walls by changing its velocity
  if (ball.y < grid) {
    ball.y = grid;
    ball.dy *= -1;
  }
  else if (ball.y + grid > canvas.height - grid) {
    ball.y = canvas.height - grid * 2;
    ball.dy *= -1;
  }

  // Ejemplo en la función loop cuando un jugador anota un punto
  if (ball.x < 0) {
    // Jugador 2 anota un punto
    player2Score++;
    resetBall();
  } else if (ball.x > canvas.width) {
    // Jugador 1 anota un punto
    player1Score++;
    resetBall();
  }

  // check to see if ball collides with paddle. if they do change x velocity
  if (collides(ball, leftPaddle)) {
    ball.dx *= -1;

    // move ball next to the paddle otherwise the collision will happen again
    // in the next frame
    ball.x = leftPaddle.x + leftPaddle.width;
  }
  else if (collides(ball, rightPaddle)) {
    ball.dx *= -1;

    // move ball next to the paddle otherwise the collision will happen again
    // in the next frame
    ball.x = rightPaddle.x - ball.width;
  }

  // draw ball
  context.fillRect(ball.x, ball.y, ball.width, ball.height);

  // draw walls
  context.fillStyle = 'lightgrey';
  context.fillRect(0, 0, canvas.width, grid);
  context.fillRect(0, canvas.height - grid, canvas.width, canvas.height);

  // draw dotted line down the middle
  for (let i = grid; i < canvas.height - grid; i += grid * 2) {
    context.fillRect(canvas.width / 2 - grid / 2, i, grid, grid);
  }

  // Dentro de la función loop, después de dibujar los elementos existentes
  context.fillStyle = 'white';
  context.font = '24px Arial';
  context.fillText(`Player 1: ${player1Score}`, 20, 30);
  context.fillText(`Player 2: ${player2Score}`, canvas.width - 160, 30);

}

// Escucha eventos de teclado para mover las paletas de ambos jugadores
document.addEventListener('keydown', function(e) {
  // Jugador 1 (W para arriba y S para abajo)
  if (e.key === 'w' || e.key === 'W') {
    leftPaddle.dy = -paddleSpeed;
  } else if (e.key === 's' || e.key === 'S') {
    leftPaddle.dy = paddleSpeed;
  }

  // Jugador 2 (I para arriba y K para abajo)
  if (e.key === 'i' || e.key === 'I') {
    rightPaddle.dy = -paddleSpeed;
  } else if (e.key === 'k' || e.key === 'K') {
    rightPaddle.dy = paddleSpeed;
  }
});

// Escucha eventos de teclado para detener las paletas cuando se libere una tecla
document.addEventListener('keyup', function(e) {
  // Jugador 1 (W y S)
  if (e.key === 'w' || e.key === 'W' || e.key === 's' || e.key === 'S') {
    leftPaddle.dy = 0;
  }

  // Jugador 2 (I y K)
  if (e.key === 'i' || e.key === 'I' || e.key === 'k' || e.key === 'K') {
    rightPaddle.dy = 0;
  }
});




requestAnimationFrame(loop);