import CarDataset from "./CarDataset";
import GoogleMapComponent from "./GoogleMapComponent";

function App() {
  return (
    <div>
      <h1>Google Map</h1>
      <GoogleMapComponent location={location} />
      <CarDataset />
    </div>
  );
}

export default App;
