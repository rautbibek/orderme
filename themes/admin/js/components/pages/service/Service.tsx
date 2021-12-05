import * as React from 'react'
import {ListService} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'title', headerName: 'Name', flex: 1 },
];

const Service = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={ListService} columns={columns} title={'services'}/>
    )
}

export default Service
