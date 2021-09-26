import * as React from 'react'
import {ListMenus} from "../../../createUrls";
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Menu = () => {
    return (
        <DataTablesPaginate url={ListMenus} columns={columns} title={'menus'}/>
    )
}

export default Menu
