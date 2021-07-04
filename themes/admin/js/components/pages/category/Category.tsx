import * as React from 'react'
import Datatables from "../../Layout/Datatables";
import {listCategory} from "../../../createUrls";

const columns = [
    { field: 'name', headerName: 'Name', width: 300 },
];

const Category = () => {
    return (
        <Datatables url={listCategory} columns={columns} title={'categories'}/>
    )
}

export default Category
