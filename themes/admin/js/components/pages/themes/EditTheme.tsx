import * as React from 'react'
import ThemeEditComponent from "./ThemeEditComponent";
import HttpClient from "../../../HttpClient";
import {ListTheme} from "../../../createUrls";
import useSWR, {mutate} from "swr";
import { useHistory, useRouteMatch } from 'react-router-dom'


const AddTheme = () => {
    const history = useHistory();
    const match = useRouteMatch()
    const url = `themes/${match.params.id}/edit`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: false })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListTheme, values)
        if(res.status === 201){
            await mutate('themes')
            history.push('/themes')
        }
    }
    return (
        <ThemeEditComponent onSubmit={handleSubmit} theme={{id: data.data.id, name: data.data.name, active: data.data.active}}/>
    )
}

export default AddTheme
