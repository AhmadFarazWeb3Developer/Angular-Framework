var fs = require("fs");


fs.writeFile(
  "fsd-2025.txt",
  "we are studing write file Method In NodeJS",
  function (err) {
    if (err) throw err;
    console.log("Saved!");
  }
);
