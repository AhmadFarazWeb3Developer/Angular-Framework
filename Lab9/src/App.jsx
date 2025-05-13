import React, { useState, useEffect } from "react";
import "./App.css";
function App() {
  const [data, setData] = useState([]);
  useEffect(() => {
    async function fetchData() {
      const response = await fetch("http://localhost/Lab9/src/dbReact.php");
      const json = await response.json();
      setData(json);
    }
    fetchData();
  }, []);
  return (
    <div>
      {data.map((item) => (
        <div key={item.id}>
          <h1>{item.name}</h1>
          <p>{item.email}</p>
          <p>{item.phone}</p>
          <p>{item.city}</p>
        </div>
      ))}
    </div>
  );
}
export default App;
