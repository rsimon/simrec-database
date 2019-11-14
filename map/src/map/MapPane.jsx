import React from 'react'; 
import { Map, TileLayer } from 'react-leaflet';
import { merge } from '@mapbox/geojson-merge';
import Bounds from 'geojson-bounds';
import SelectableRoute from './SelectableRoute';

const MapPane = props => {
  const e = Bounds.extent(merge(props.routes.map(r => r.geom_kml)));
  const bounds = isNaN(e[0]) ? [[-90, -80], [90, 80]] : [[ e[1], e[0] ], [ e[3], e[2] ]];

  return (
    <Map bounds={bounds}>
      <TileLayer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        attribution="&copy; <a href=&quot;http://osm.org/copyright&quot;>OpenStreetMap</a> contributors" />

      { props.routes.map(route => 
        <SelectableRoute key={route.id} data={route} selected={route.id == props.selected} />
      )}        
    </Map>
  )

}

export default MapPane;