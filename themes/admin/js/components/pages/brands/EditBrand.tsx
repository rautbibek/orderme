import * as React from 'react'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";
import BrandEditComponent from "./BrandEditComponent";

const EditCollection = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `brands/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`brands/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('brands')
            history.push('/brands')
        }
    }
    return (
        <BrandEditComponent onSubmit={handleSubmit} brand={{ name: data.data.name, product_type_id: data.data.product_type_id }} />
    )
}

export default EditCollection
