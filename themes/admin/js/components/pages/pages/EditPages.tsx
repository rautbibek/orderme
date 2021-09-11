import * as React from 'react'
import PagesEditComponent from './PagesEditComponent'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";

const EditPages = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `pages/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`pages/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('pages')
            history.push('/pages')
        }
    }
    return (
        <PagesEditComponent onSubmit={handleSubmit} page={{ title: data.data.title, description: data.data.description, active: data.data.active }} />
    )
}

export default EditPages
