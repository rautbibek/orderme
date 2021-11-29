import * as React from 'react'
import {ListOrder} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'uuid', headerName: 'Orders', flex: 1 },
    { field: 'state', headerName: 'State',width: 150},
    { field: 'created_at', headerName: 'Created At', width: 250},
    { field: 'name', headerName: 'Customer' , width: 150},
    {
        field: 'total',
        headerName: 'Total',
        renderCell: (params) => (
            <div style={{display: "flex", justifyContent: "center", width: '100%'}}>
                Rs. {params.value/100}
            </div>
        ),
        width: 150

    },



];

const Order = () => {
    return (
        <DataTablesPaginate url={ListOrder} columns={columns} title={'orders'}/>
    )
}

export default Order
