import * as React from 'react';
import { DataGrid } from '@material-ui/data-grid';
import Button from '@material-ui/core/Button';
import {useHistory} from 'react-router-dom'
import HttpClient from "../../HttpClient";
import useSWR from 'swr'
import {makeStyles, IconButton} from "@material-ui/core";
import {Delete, Edit} from '@material-ui/icons';


interface DatatablesProps {
    url: string
    columns: any,
    title: string,
    extraAction?: any
    extraRouteButton?: any
}

const useStyles = makeStyles((theme) => ({
    buttonWrapper: {
        display: 'flex',
        '& IconButton': {
            marginRight: 10
        }
    }
}));


const DataTables: React.FC<DatatablesProps> = ({url, columns, title, extraAction, extraRouteButton}) => {
    const history = useHistory()

    const renderActionsButton = (row) => {
        const classes = useStyles()
        const history = useHistory()
        return (
            <div className={classes.buttonWrapper}>
                <IconButton color="primary" onClick={() => history.push(`/${url}/edit/${row.id}`)}>
                    <Edit />
                </IconButton>
                <IconButton color="secondary">
                    <Delete />
                </IconButton>
                {extraAction}
                {!!extraRouteButton && (
                    <IconButton color="inherit" onClick={() => history.push(`/${extraRouteButton.url}/${row.id}`)}>
                        {extraRouteButton.icon}
                    </IconButton>
                )}
            </div>
        )
    }

    const columnsArray = [
        ...columns,
        {
            field: '',
            headerName: 'Action',
            flex: 0.3,
            renderCell: renderActionsButton,
            disableClickEventBubbling: true,
            sortable: false,
        }
    ]

    const fetchData = async () => {
       return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: false} )

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    return (
        <div style={{ width: '100%' }}>
            <Button variant="contained" onClick={() => history.push(`/${title}/new`)} color="primary" style={{marginBottom: 10}}>
                New
            </Button>
            <div>
                <DataGrid rows={data.data} columns={columnsArray} autoHeight hideFooterPagination hideFooter disableSelectionOnClick />
            </div>
        </div>
    );
}

export default DataTables
