import * as React from 'react'
import MenuEditComponent from './MenuEditComponent'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";

const EditMenu = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `menus/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: false })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`menus/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('menus')
            history.push('/menus')
        }
    }
    return (
        <MenuEditComponent onSubmit={handleSubmit} menu={{ name: data.data.name, design: data.data.design }} />
    )
}

export default EditMenu
