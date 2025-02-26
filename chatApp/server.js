const io = require("socket.io")(3000, {
  cors: {
    origin: "*",
  },
});

let users = {};

io.on("connection", (socket) => {
  socket.on("newUser", (username) => {
    users[socket.id] = username;
    io.emit("users", Object.values(users));
  });

  socket.on("message", (message) => {
    io.emit("message", message);
  });

  socket.on("userLeft", () => {
    delete users[socket.id];
    io.emit("users", Object.values(users));
  });

  socket.on("disconnect", () => {
    delete users[socket.id];
    io.emit("users", Object.values(users));
  });
});
