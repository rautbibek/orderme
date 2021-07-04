import * as React from 'react';
import { DataGrid } from '@material-ui/data-grid';
import Button from '@material-ui/core/Button';
import {useHistory} from 'react-router-dom'
import HttpClient from "../../HttpClient";
import useSWR from 'swr'

interface DatatablesProps {
    url: string
    columns: any,
    title: string
}

const DataTables: React.FC<DatatablesProps> = ({url, columns, title}) => {
    const history = useHistory()

    const fetchData = async () => {
       return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData )

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    return (
        <div style={{ width: '100%' }}>
            <Button variant="contained" onClick={() => history.push(`/${title}/new`)} color="primary" style={{marginBottom: 10}}>
                New
            </Button>
            <div>
                <DataGrid rows={data.data} columns={columns} autoHeight hideFooterPagination hideFooter />
            </div>
        </div>
    );
}

export default DataTables
