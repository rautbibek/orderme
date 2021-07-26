import * as React from 'react'
import ProductEditComponent from './ProductEditComponent'
import HttpClient from "../../../HttpClient";
import { listProduct } from "../../../createUrls";
import { useHistory } from 'react-router-dom'
import { mutate } from "swr";

const AddProduct = () => {

    const history = useHistory()
    const handleSubmit = async (values: any) => {
        const res = await HttpClient.post(listProduct, values)
        if (res.status === 201) {
            console.log(res)
        }
    }
    return (
        <ProductEditComponent onSubmit={handleSubmit} />
    )
}

export default AddProduct
