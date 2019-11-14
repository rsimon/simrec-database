import React from 'react';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

const TablePane = props => {

  return (
    <Paper elevation={3}>
      <Table aria-label="simple table">
        <TableHead>
          <TableRow>
            <TableCell>Id</TableCell>
            <TableCell>Description</TableCell>
            <TableCell>Lower Date</TableCell>
            <TableCell>Lower Date Error</TableCell>
            <TableCell>Upper Date</TableCell>
            <TableCell>Upper Date Error</TableCell>
            <TableCell>Route Type</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          { props.routes.map(route => 
            <TableRow key={route.id} hover onClick={props.onClick(route)}>
              <TableCell>{route.id}</TableCell>
              <TableCell>{route.description}</TableCell>
              <TableCell>{route.lower_date}</TableCell>
              <TableCell>{route.lower_date_error}</TableCell>
              <TableCell>{route.upper_date}</TableCell>
              <TableCell>{route.upper_date_error}</TableCell>
              <TableCell>{route.route_type}</TableCell>
            </TableRow>
          )}
        </TableBody>
      </Table>
    </Paper>
  )

}

export default TablePane;