import * as React from 'react'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";
import ServiceEditComponent from "./ServiceEditComponent";

const EditService = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `services/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`services/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('services')
            history.push('/services')
        }
    }
    return (
        <ServiceEditComponent onSubmit={handleSubmit} service={{ title: data.data.title }} />
    )
}

export default EditService
