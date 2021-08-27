import * as React from 'react'
import Datatables from "../../Layout/Datatables";
import {ListCollection} from "../../../createUrls";

const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];

const Menu = () => {
    return (
        <Datatables url={ListCollection} columns={columns} title={'collections'}/>
    )
}

export default Menu
