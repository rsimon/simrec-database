import React from 'react';
import { GeoJSON, Popup } from 'react-leaflet';
import { Typography } from '@material-ui/core';

const ROUTE_STYLES = {
  PRIMARY:   _ => ({ weight: 5, color: 'rgb(0, 0, 0)' }),
  SECONDARY: _ => ({ weight: 3, color: 'rgba(0, 0, 0, 0.8)' })
}

const SelectableRoute = props => {

  const init = ref => {
    if (ref && props.selected) ref.leafletElement.openPopup();
  }
  
  return (
    <GeoJSON 
      ref={init} 
      data={props.geom_kml} 
      onClick={props.onClick}
      style={ROUTE_STYLES[props.route_type]}>

      <Popup>
        <Typography>
          <a href={`crud/routes/read/${props.id}`}>{props.id}</a>
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