import * as React from 'react'
import {ListExpert} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
    { field: 'active', headerName: 'Active',width: 150},
];

const Expert = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={ListExpert} columns={columns} title={'experts'}/>
    )
}

export default Expert
