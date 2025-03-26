const mysql = require("mysql2");
const fs = require("fs");
const http = require("http");

const con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "Lab6",
});

con.connect((err) => {
  if (err) throw err;
  console.log("Connected to MySQL!");

  con.query(
    "CREATE TABLE IF NOT EXISTS insertImage (id INT AUTO_INCREMENT PRIMARY KEY, image LONGBLOB)",
    (err) => {
      if (err) throw err;
      console.log("Table created or already exists");

      fs.readFile("./image.png", (err, data) => {
        if (err) throw err;

        con.query(
          "INSERT INTO insertImage (image) VALUES (?)",
          [data],
          (err) => {
            if (err) throw err;
            console.log("Image inserted into the database");

            // Retrieve the image from the database
            con.query(
              "SELECT image FROM insertImage WHERE id = LAST_INSERT_ID()",
              (err, result) => {
                if (err) throw err;

                // Convert the image to a base64 string
                const base64Image = result[0].image.toString("base64");

                // Create an HTTP server to render the image
                const server = http.createServer((req, res) => {
                  res.writeHead(200, { "Content-Type": "text/html" });
                  res.write(`
                    <html>
                      <head><title>Image Render</title></head>
                      <body>
                        <h1>Image from Database</h1>
                        <img src="data:image/png;base64,${base64Image}" />
                      </body>
                    </html>
                  `);
                  res.end();
                });

                // Start the server
                server.listen(3000, () => {
                  console.log("Server running at http://localhost:3000");
                });

                // Close the database connection
                con.end();
              }
            );
          }
        );
      });
    }
  );
});
