import * as React from 'react'
import Datatables from "../../Layout/Datatables";
import {ListMenus} from "../../../createUrls";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Menu = () => {
    return (
        <Datatables url={ListMenus} columns={columns} title={'menus'}/>
    )
}

export default Menu
