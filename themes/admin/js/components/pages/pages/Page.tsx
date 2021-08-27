import * as React from 'react'
import Datatables from "../../Layout/Datatables";
import {ListPages} from "../../../createUrls";

const columns = [
    { field: 'title', headerName: 'Name', flex: 1 },
];

const Page = () => {
    return (
        <Datatables url={ListPages} columns={columns} title={'pages'}/>
    )
}

export default Page
