import * as React from 'react'
import {ListTheme} from "../../../createUrls";
import Datatables from "../../Layout/Datatables";
import {Edit} from "@material-ui/icons";
import PermDataSettingIcon from '@material-ui/icons/PermDataSetting';
import { useHistory, useRouteMatch } from 'react-router-dom'
const columns = [
    { field: 'name', headerName: 'Name', flex: 1 },
];
const Themes = () => {
    const history = useHistory()
    return <Datatables url={ListTheme} columns={columns} title={'themes'} extraRouteButton={{url: 'themes/config', icon: <PermDataSettingIcon/>}}  />
}

export default Themes
