import React from 'react'; 
import { Map, TileLayer, GeoJSON, Popup } from 'react-leaflet';

const MapPane = props => {

  return (
    <Map center={[51.505, -0.09]} zoom={13}>
      <TileLayer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        attribution="&copy; <a href=&quot;http://osm.org/copyright&quot;>OpenStreetMap</a> contributors" />

      { props.routes.map((route, idx) => 
        <GeoJSON key={idx} data={route}>
          <Popup>A pretty CSS3 popup.<br />Easily customizable.</Popup>
        </GeoJSON>
      )}        
    </Map>
  )

}

export default MapPane;