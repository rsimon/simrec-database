import React, { Component } from 'react';
import axios from 'axios';
import CssBaseline from '@material-ui/core/CssBaseline';
import Grid from '@material-ui/core/Grid';
import Paper from '@material-ui/core/Paper';

import MapPane from './map/MapPane';
import TablePane from './table/TablePane';

import './App.scss';

export default class App extends Component {

  state = {
    routes: [],
    selected: null
  }

  componentDidMount() {
    axios.get('/api/routes').then(response => {
      this.setState({ routes: response.data });
    });
  }

  onSelectRoute = route => _ => {
    if (route)
      this.setState({ selected: route.id });
    else 
      this.setState({ selected: null });
  }

  render() {
    return (
      <Grid container component="main">
        <CssBaseline />
        <Grid item xs={7} className="table-pane">
          <TablePane 
            routes={this.state.routes} 
            selected={this.state.selected} 
            onSelect={this.onSelectRoute} />
        </Grid>
        
        <Grid item xs={5} component={Paper} elevation={3}>
          <MapPane 
            routes={this.state.routes} 
            selected={this.state.selected}
            onSelect={this.onSelectRoute} />
        </Grid>
      </Grid>
    )
  }

}
