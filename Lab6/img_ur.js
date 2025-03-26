const mysql = require("mysql2");
const fs = require("fs");

const con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "Lab6",
});

con.connect((err) => {
  if (err) throw err;
  console.log("Connected to MySQL");

  const imagePath = "pic1.jpeg";
  const image = fs.readFileSync(imagePath);

  con.query(
    "INSERT INTO images (name, image) VALUES (?, ?)",
    ["pic1.jpeg", image],
    (err, result) => {
      if (err) throw err;
      console.log("Image inserted successfully!");

      con.query("SELECT * FROM images", (err, results) => {
        if (err) throw err;

        results.forEach((row) => {
          fs.writeFileSync(`retrieved_${row.name}`, row.image);
          console.log(`Image retrieved and saved as retrieved_${row.name}`);
        });

        con.end();
      });
    }
  );
});
