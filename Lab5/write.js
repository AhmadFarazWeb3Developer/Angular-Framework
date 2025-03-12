var fs = require("fs");

//create a file named mynewfile3.txt:
fs.writeFile(
  "fsd-2025.txt",
  "we are studing write file Method In NodeJS",
  function (err) {
    if (err) throw err;
    console.log("Saved!");
  }
);
