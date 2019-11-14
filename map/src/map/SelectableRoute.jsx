import React from 'react';
import { GeoJSON, Popup } from 'react-leaflet';

const SelectableRoute = props => {

  const init = ref => {
    if (ref && props.selected) ref.leafletElement.openPopup();
  }

  return(
    <GeoJSON ref={init} data={props.data.geom_kml}>
      <Popup>{props.data.id}</Popup>
    </GeoJSON>
  )

}

export default SelectableRoute;