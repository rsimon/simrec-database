import React, { Component } from 'react';
import axios from 'axios';
import CssBaseline from '@material-ui/core/CssBaseline';
import Grid from '@material-ui/core/Grid';
import Paper from '@material-ui/core/Paper';

import MapPane from './map/MapPane';

import './App.css';

export default class App extends Component {

  state = {
    routes: []
  }

  componentDidMount() {
    axios.get('/api/routes').then(response => {
      this.setState({
        routes: response.data.map(r => r.geom_kml)
      });
    });
  }

  render() {
    return (
      <Grid container component="main">
        <CssBaseline />
        <Grid item xs={false} sm={4} md={7} className="table-pane" />
        <Grid item xs={12} sm={8} md={5} component={Paper} elevation={6} square>
          <MapPane routes={this.state.routes} />
        </Grid>
      </Grid>
    )
  }

}
