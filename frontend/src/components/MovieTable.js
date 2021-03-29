import * as React from 'react';
import { DataGrid } from '@material-ui/data-grid';

const columns = [
  { field: 'tconst', headerName: 'ID', width: 130 },
  { field: 'primaryTitle', headerName: 'Title', width: 230 },
  { field: 'type', headerName: 'Type', width: 130 },
  { field: 'rating', headerName: 'Rating', width: 130 },
  { field: 'startYear', headerName: 'Start Year', width: 130 },
  { field: 'endYear', headerName: 'End Year', width: 130 },
  { field: 'genres', headerName: 'Genres', width: 160 },
  { field: 'isAdult', headerName: 'Adult Restriction', width: 160 },
];



export default function DataTable(props) {
  return (
    <div style={{ height: '700px', width: '100%' }}>
      <DataGrid rows={props.movieRows}
                columns={columns}
                pageSize={10}
                rowCount={100}
                onPageChange={(GridPageChangeParams) => (props.onPaginationChange(GridPageChangeParams))}
                paginationMode="server" />
    </div>
  );
}
