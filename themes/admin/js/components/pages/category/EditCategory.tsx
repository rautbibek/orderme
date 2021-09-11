import * as React from 'react'
import CategoryEditComponent from './CategoryEditComponent'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";

const EditCategory = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `categories/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`categories/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('categories')
            history.push('/categories')
        }
    }
    return (
        <CategoryEditComponent onSubmit={handleSubmit} category={{ name: data.data.name, parentId: data.data.parent_id }} />
    )
}

export default EditCategory
