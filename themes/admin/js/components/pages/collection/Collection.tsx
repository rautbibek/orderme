import * as React from 'react'
import {ListCollection} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Collection = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={ListCollection} columns={columns} title={'collections'}/>
    )
}

export default Collection
