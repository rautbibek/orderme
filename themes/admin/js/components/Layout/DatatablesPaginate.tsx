import * as React from 'react';
import { DataGrid } from '@material-ui/data-grid';
import Button from '@material-ui/core/Button';
import {useHistory, useLocation} from 'react-router-dom'
import HttpClient from "../../HttpClient";
import useSWR from 'swr'
import {makeStyles, IconButton} from "@material-ui/core";
import {Delete, Edit} from '@material-ui/icons';
import Pagination from "@material-ui/lab/Pagination";


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


const DataTablesPaginate: React.FC<DatatablesProps> = ({url, columns, title, extraAction, extraRouteButton}) => {
    const history = useHistory()
    const [currentPage , setCurrentPage] = React.useState(1)

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
       return await HttpClient.get(`${url}?page=${currentPage}`)
    }

    const { data, mutate } = useSWR(`${url}?page=${currentPage}`, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: true} )

    if (!data) return <div>loading...</div>
    const handlePagination = async(event, value) => {
        await setCurrentPage(value)
    }
    return (
        <div style={{ width: '100%' }}>
            <Button variant="contained" onClick={() => history.push(`/${title}/new`)} color="primary" style={{marginBottom: 10}}>
                New
            </Button>
            <div>
                <DataGrid rows={data.data.data} columns={columnsArray} autoHeight hideFooterPagination hideFooter disableSelectionOnClick />
            </div>
            <div style={{width: '100%', marginTop: 20, display:'flex', justifyContent: "center"}}>
                <Pagination count={data.data.last_page} variant="outlined" color="secondary" page={data.data.current_page} defaultPage={1} onChange={handlePagination} />
            </div>
        </div>
    );
}

export default DataTablesPaginate
