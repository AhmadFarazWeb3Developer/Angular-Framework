var fs = require("fs");

fs.unlink("fsd.txt", function (err) {
  if (err) throw err;
  console.log("File deleted!");
});
