var mysql = require("mysql2");

const con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "Lab6",
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Connected!");

  con.query(
    "CREATE TABLE customers (name VARCHAR(255), address VARCHAR(255))",
    function (err, result) {
      if (err) throw err;
      console.log("Table created");

      const values = [
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

      con.query(
        "INSERT INTO customers (name, address) VALUES ?",
        [values],
        function (err, result) {
          if (err) throw err;
          console.log("Number of records inserted: " + result.affectedRows);
        }
      );

      con.end();
    }
  );
});
