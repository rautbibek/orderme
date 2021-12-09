import * as React from 'react'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";
import CustomerEditComponent from './CustomerEditComponent';

const EditCustomer = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `customers/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(url, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: true})

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`customers/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('customers?page=1')
            await mutate(url)
            history.push('/customers')
        }
    }
    return (
        <CustomerEditComponent onSubmit={handleSubmit} customer={data.data} />
    )
}

export default EditCustomer