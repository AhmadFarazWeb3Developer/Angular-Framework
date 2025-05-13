const http = require("http");
const fs = require("fs");

const server = http.createServer((req, res) => {
  res.writeHead(200, { "Content-Type": "text/plain" });

  // Create 10 files
  for (let i = 1; i <= 10; i++) {
    fs.writeFileSync(`file${i}.txt`, `This is file ${i}`);
  }
  res.write("Files created\n");

  // Read first 5 files
  for (let i = 1; i <= 5; i++) {
    const data = fs.readFileSync(`file${i}.txt`, "utf8");
    res.write(`Read file${i}: ${data}\n`);
  }

  // Update first 5 files
  for (let i = 1; i <= 5; i++) {
    fs.writeFileSync(`file${i}.txt`, `Updated content for file ${i}`);
    res.write(`Updated file${i}\n`);
  }

  // Delete first 5 files
  for (let i = 1; i <= 5; i++) {
    fs.unlinkSync(`file${i}.txt`);
    res.write(`Deleted file${i}\n`);
  }

  // Rename files 6–10
  for (let i = 6; i <= 10; i++) {
    fs.renameSync(`file${i}.txt`, `renamed_file${i}.txt`);
    res.write(`Renamed file${i} to renamed_file${i}\n`);
  }

  res.end("All operations completed");
});

server.listen(8080, () => {
  console.log("Server running on port 8080");
});
