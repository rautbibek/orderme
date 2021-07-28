import * as React from 'react'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'
import useSWR, { mutate } from "swr";
import ProductEditComponent from './ProductEditComponent';

const EditProduct = () => {

    const history = useHistory()

    const match = useRouteMatch()
    const url = `products/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(url, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: false})

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    const handleSubmit = async (values: any) => {
        const res = await HttpClient.put(`products/${match.params.id}`, values)
        if (res.status === 200) {
            await mutate('products')
            await mutate(url)
            history.push('/products')
        }
    }
    return (
        <ProductEditComponent onSubmit={handleSubmit} product={data.data} />
    )
}

export default EditProduct
