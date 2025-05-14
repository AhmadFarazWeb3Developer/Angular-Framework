import { useEffect, useState } from "react";
import Papa from "papaparse";
import "./App.css";

function CarDataset() {
  const [carData, setCarData] = useState([]);

  useEffect(() => {
    Papa.parse("/cars_data.csv", {
      download: true,
      header: true,
      complete: (result) => {
        setCarData(result.data);
        console.log(result.data);
      },
      error: (error) => {
        console.error("Error parsing CSV:", error);
      },
    });
  }, []);

  return (
    <div className="App">
      <h1>Car Dataset</h1>
      <table>
        <thead>
          <tr>
            <th>Car Model</th>
            <th>Brand</th>
            <th>Year</th>
            <th>Price</th>
            <th>Engine Type</th>
            <th>Fuel Type</th>
            <th>Mileage (MPG)</th>
            <th>Color</th>
            <th>Transmission</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          {carData.map((car, index) => (
            <tr key={index}>
              <td>{car["Car Model"]}</td>
              <td>{car["Brand"]}</td>
              <td>{car["Year"]}</td>
              <td>{car["Price"]}</td>
              <td>{car["Engine Type"]}</td>
              <td>{car["Fuel Type"]}</td>
              <td>{car["Mileage (MPG)"]}</td>
              <td>{car["Color"]}</td>
              <td>{car["Transmission"]}</td>
              <td>{car["Location"]}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
export default CarDataset;
