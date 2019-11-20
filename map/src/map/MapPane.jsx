import React from 'react'; 
import { LayersControl, Map, TileLayer } from 'react-leaflet';
import { merge } from '@mapbox/geojson-merge';
import Bounds from 'geojson-bounds';
import SelectableRoute from './SelectableRoute';

const MapPane = props => {

  // Routes are not guaranteed to have geometry!
  const routesWithGeometry = props.routes.filter(r => r.geom_kml);

  const e = Bounds.extent(merge(routesWithGeometry.map(r => r.geom_kml)));
  const bounds = isNaN(e[0]) ? [[-90, -80], [90, 80]] : [[ e[1], e[0] ], [ e[3], e[2] ]];

  return (
    <Map bounds={bounds} onPopupClose={props.onSelect()}>
      <LayersControl position="topright">
        <LayersControl.BaseLayer checked name="Digital Atlas of the Roman Empire">
          <TileLayer 
              url="http://dare.ht.lu.se/tiles/imperium/{z}/{x}/{y}.png"
              attribution="Tiles: <a href='http://imperium.ahlfeldt.se/'>DARE 2014</a>" />
        </LayersControl.BaseLayer>

        <LayersControl.BaseLayer name="Ancient World Mapping Center">
          <TileLayer
            url="http://a.tiles.mapbox.com/v3/isawnyu.map-knmctlkh/{z}/{x}/{y}.png"
            attribution="Tiles &copy; <a href='http://mapbox.com/'>MapBox</a> | Tiles and Data &copy; 2013 <a href='http://www.awmc.unc.edu'>AWMC</a>" />
        </LayersControl.BaseLayer>

        <LayersControl.BaseLayer name="OpenStreetMap">
          <TileLayer
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            attribution="&copy; <a href=&quot;http://osm.org/copyright&quot;>OpenStreetMap</a> contributors" />
        </LayersControl.BaseLayer>
      </LayersControl>

      { props.routes.map(route => 
        <SelectableRoute 
          key={route.id} 
          selected={route.id === props.selected} 
          onClick={props.onSelect(route)}
          {...route} />
      )}        
    </Map>
  )

}

export default MapPane;