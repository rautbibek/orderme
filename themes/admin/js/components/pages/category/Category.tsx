import * as React from 'react'
import {listCategory} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Category = () => {
    return (
        <DataTablesPaginate url={listCategory} columns={columns} title={'categories'}/>
    )
}

export default Category
