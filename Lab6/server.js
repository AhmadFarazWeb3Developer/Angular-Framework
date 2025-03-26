const http = require("http");
const mysql = require("mysql2");

// Create MySQL connection
const con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "Lab6",
});

con.connect((err) => {
  if (err) throw err;
  console.log("Connected to MySQL");
});

// Create an HTTP server
const server = http.createServer((req, res) => {
  if (req.url === "/image") {
    // Retrieve the latest image from MySQL
    con.query(
      "SELECT * FROM images ORDER BY id DESC LIMIT 1",
      (err, results) => {
        if (err) {
          res.writeHead(500, { "Content-Type": "text/plain" });
          res.end("Database Error");
          return;
        }

        if (results.length === 0) {
          res.writeHead(404, { "Content-Type": "text/plain" });
          res.end("No image found");
          return;
        }

        // Send the image as response
        res.writeHead(200, { "Content-Type": "image/jpeg" });
        res.end(results[0].image);
      }
    );
  } else {
    res.writeHead(200, { "Content-Type": "text/html" });
    res.end('<h2>Go to <a href="/image">View Image</a></h2>');
  }
});

// Start server on port 8080
server.listen(8080, () => {
  console.log("Server running at http://localhost:8080/");
});
