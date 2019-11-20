import React from 'react';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import Button from '@material-ui/core/Button';
import Icon from '@material-ui/core/Icon';

const stopPropagation = evt => evt.stopPropagation();

const TablePane = props => {

  return (
    <Paper elevation={3}>
      <Table aria-label="simple table">
        <TableHead>
          <TableRow>
            <TableCell></TableCell>
            <TableCell>Description</TableCell>
            <TableCell>Lower Date</TableCell>
            <TableCell>Lower Date Error</TableCell>
            <TableCell>Upper Date</TableCell>
            <TableCell>Upper Date Error</TableCell>
            <TableCell>Route Type</TableCell>
            <TableCell />
          </TableRow>
        </TableHead>
        <TableBody>
          { props.routes.map(route => 
            <TableRow
              hover
              key={route.id}
              onClick={props.onSelect(route)} 
              selected={route.id === props.selected}>
                
              <TableCell 
                className="no-geometry" title="This route has no geometry">{!route.geom_kml && <Icon>warning</Icon>}
              </TableCell>

              <TableCell className="description">{route.description}</TableCell>
              <TableCell>{route.lower_date}</TableCell>
              <TableCell>{route.lower_date_error}</TableCell>
              <TableCell>{route.upper_date}</TableCell>
              <TableCell>{route.upper_date_error}</TableCell>
              <TableCell>{route.route_type}</TableCell>
              <TableCell className="edit-record">
                <Button 
                  component="a" 
                  href={`/crud/routes/read/${route.id}`} 
                  size="small" 
                  variant="contained" 
                  color="primary"
                  onClick={stopPropagation}>

                  <Icon>visibility</Icon>
                </Button>

                <Button 
                  component="a" 
                  href={`/crud/routes/edit/${route.id}`}
                  size="small"
                  variant="contained" 
                  color="primary"
                  onClick={stopPropagation}>

                  <Icon>create</Icon>
                </Button>
              </TableCell>
            </TableRow>
          )}
        </TableBody>
      </Table>
    </Paper>
  )

}

export default TablePane;