import * as React from 'react'
import {ListBrands} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Brands = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={ListBrands} columns={columns} title={'brands'}/>
    )
}

export default Brands
