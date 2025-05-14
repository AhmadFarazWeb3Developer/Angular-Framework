import React, { useRef, useState } from "react";
import { GoogleMap, LoadScript, Autocomplete } from "@react-google-maps/api";

const containerStyle = {
  width: "100%",
  height: "100vh",
};

const defaultCenter = {
  lat: 33.6844,
  lng: 73.0479,
};

const GoogleMapComponent = () => {
  const [mapCenter, setMapCenter] = useState(defaultCenter);
  const autocompleteRef = useRef(null);

  const handlePlaceChanged = () => {
    const place = autocompleteRef.current.getPlace();
    if (place.geometry) {
      const location = place.geometry.location;
      setMapCenter({
        lat: location.lat(),
        lng: location.lng(),
      });
    }
  };

  return (
    <LoadScript googleMapsApiKey="YOUR_API_KEY" libraries={["places"]}>
      <GoogleMap
        mapContainerStyle={containerStyle}
        center={mapCenter}
        zoom={13}
      >
        <Autocomplete
          onLoad={(autocomplete) => (autocompleteRef.current = autocomplete)}
          onPlaceChanged={handlePlaceChanged}
        >
          <input
            type="text"
            placeholder="Search location"
            style={{
              boxSizing: "border-box",
              border: "1px solid transparent",
              width: "240px",
              height: "32px",
              padding: "0 12px",
              borderRadius: "3px",
              boxShadow: "0 2px 6px rgba(0,0,0,0.3)",
              fontSize: "16px",
              position: "absolute",
              left: "50%",
              top: "10px",
              transform: "translateX(-50%)",
              zIndex: "10",
            }}
          />
        </Autocomplete>
      </GoogleMap>
    </LoadScript>
  );
};

export default GoogleMapComponent;
