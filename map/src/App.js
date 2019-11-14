import React, { Component } from 'react';
import axios from 'axios';
import { Map, TileLayer, GeoJSON, Popup } from 'react-leaflet';

import './App.css';

const position = [51.505, -0.09]

export default class App extends Component {

  state = {
    routes: []
  }

  // For testing
  componentDidMount() {
    axios.get('/api/routes').then(response => {
      this.setState({
        routes: response.data.map(r => r.geom_kml)
      });
    });
  }

  render() {
    return (
      <Map center={position} zoom={13}>
        <TileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution="&copy; <a href=&quot;http://osm.org/copyright&quot;>OpenStreetMap</a> contributors" />

        { this.state.routes.map((route, idx) => 
          <GeoJSON key={idx} data={route}>
            <Popup>A pretty CSS3 popup.<br />Easily customizable.</Popup>
          </GeoJSON>
        )}        
      </Map>
    )
  }

}
