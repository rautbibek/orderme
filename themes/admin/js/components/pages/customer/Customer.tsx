import * as React from 'react';
import { listCustomer } from '../../../createUrls';
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
    { field: 'email', headerName: 'Email', flex: 1 },
    { field: 'phone_number', headerName: 'Phone Number', flex: 1 },
];

const Customer = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={listCustomer} columns={columns} title={'customers'} />
    )
}

export default Customer
