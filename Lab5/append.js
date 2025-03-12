var fs = require("fs");

fs.appendFile("fsd-2025.txt", " with power!", function (err) {
  if (err) throw err;
  console.log("Updated!");
});
