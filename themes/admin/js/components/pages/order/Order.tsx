import * as React from 'react'
import {ListPages} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'title', headerName: 'Name', flex: 1 },
];

const Order = () => {
    return (
        <DataTablesPaginate url={ListPages} columns={columns} title={'pages'}/>
    )
}

export default Order
