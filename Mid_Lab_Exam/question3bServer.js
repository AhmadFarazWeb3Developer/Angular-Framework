const http = require("http");
const mysql = require("mysql");
const dtModule = require("./question3bMyTime");

// Start HTTP Server
const server = http.createServer((req, res) => {
  res.writeHead(200, { "Content-Type": "text/plain" });
  res.end(`Current DateTime: ${dtModule.getDateTime()}`);
});

server.listen(8080, () => {
  console.log("Server running on port 8080");
});

// Create MySQL connection
const conn = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
});

conn.connect((err) => {
  if (err) throw err;
  console.log("Connected to MySQL");

  // ✅ Create two databases
  conn.query("CREATE DATABASE IF NOT EXISTS task3b_215154", (err) => {
    if (err) throw err;
    console.log("Database task3b_215154 created or exists.");
  });

  conn.query("CREATE DATABASE IF NOT EXISTS task3b1_215154", (err) => {
    if (err) throw err;
    console.log("Database task3b1_215154 created or exists.");
  });

  // ✅ Use task3b_215154 and create users + temp table + insert records
  conn.query("USE task3b_215154", (err) => {
    if (err) throw err;

    // Create users table
    conn.query(
      `
      CREATE TABLE IF NOT EXISTS users (
        id_215154 INT AUTO_INCREMENT PRIMARY KEY,
        name_215154 VARCHAR(255),
        address_215154 VARCHAR(255)
      )`,
      (err) => {
        if (err) throw err;
        console.log("Table 'users' created.");

        // Insert multiple records
        const records = [
          ["John", "Highway 71"],
          ["Peter", "Lowstreet 4"],
          ["Amy", "Apple st 652"],
          ["Hannah", "Mountain 21"],
          ["Michael", "Valley 345"],
          ["Sandy", "Ocean blvd 2"],
          ["Betty", "Green Grass 1"],
          ["Richard", "Sky st 331"],
          ["Susan", "One way 98"],
          ["Vicky", "Yellow Garden 2"],
          ["Ben", "Park Lane 38"],
          ["William", "Central st 954"],
          ["Chuck", "Main Road 989"],
          ["Viola", "Sideway 1633"],
        ];

        conn.query(
          "INSERT INTO users (name_215154, address_215154) VALUES ?",
          [records],
          (err) => {
            if (err) throw err;
            console.log("Records inserted into 'users'.");
          }
        );
      }
    );

    // Create temp table (without PK)
    conn.query(
      `
      CREATE TABLE IF NOT EXISTS temp (
        name_215154 VARCHAR(255),
        address_215154 VARCHAR(255)
      )`,
      (err) => {
        if (err) throw err;
        console.log("Table 'temp' created without primary key.");

        // Add Primary Key to 'temp'
        conn.query(
          "ALTER TABLE temp ADD COLUMN id_215154 INT AUTO_INCREMENT PRIMARY KEY FIRST",
          (err) => {
            if (err) {
              if (
                err.code === "ER_DUP_FIELDNAME" ||
                err.code === "ER_MULTIPLE_PRI_KEY"
              ) {
                console.log("Primary key already exists on 'temp'.");
              } else {
                throw err;
              }
            } else {
              console.log("Primary key added to 'temp'.");
            }
          }
        );
      }
    );
  });

  // ✅ Use task3b1_215154 and create 4 more tables
  conn.query("USE task3b1_215154", (err) => {
    if (err) throw err;

    const tables = ["orders", "products", "customers", "inventory"];
    tables.forEach((table) => {
      conn.query(
        `
        CREATE TABLE IF NOT EXISTS ${table} (
          id INT AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(255)
        )`,
        (err) => {
          if (err) throw err;
          console.log(`Table '${table}' created in task3b1_215154.`);
        }
      );
    });
  });
});
