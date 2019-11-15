import React from 'react';
import { GeoJSON, Popup } from 'react-leaflet';
import { CardContent, Typography } from '@material-ui/core';

const SelectableRoute = props => {

  const init = ref => {
    if (ref && props.selected) ref.leafletElement.openPopup();
  }
  
  return (
    <GeoJSON ref={init} data={props.geom_kml} onClick={props.onClick}>
      <Popup>
        <Typography>
          <a href="#">{props.id}</a>
        </Typography>

        <Typography variant="body2" component="p">
          {props.description}
        </Typography>

        <Typography variant="body2" component="p" color="textSecondary">
          {props.lower_date} - {props.upper_date}
        </Typography>
      </Popup>
    </GeoJSON>
  )

}

export default SelectableRoute;