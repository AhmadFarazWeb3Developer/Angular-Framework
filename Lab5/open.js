var fs = require("fs");

fs.open("fsd-2025.txt", "w", function (err, file) {
  if (err) throw err;
  console.log("Saved!");
});
