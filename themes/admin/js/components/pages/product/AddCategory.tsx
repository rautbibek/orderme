import * as React from 'react'
import ProductEditComponent from './ProductEditComponent'
import HttpClient from "../../../HttpClient";
import {listCategory} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddProduct = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(listCategory, values)
        if(res.status === 201){
           await mutate('categories')
            history.push('/categories')
        }
    }
    return (
        <ProductEditComponent onSubmit={console.log}/>
    )
}

export default AddProduct
