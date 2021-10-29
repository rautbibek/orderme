import * as React from 'react'
import HttpClient from "../../../HttpClient";
import {ListBrands} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";
import BrandEditComponent from "./BrandEditComponent";

const AddBrand = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListBrands, values)
        if(res.status === 201){
            await mutate('brands?page=1')
            history.push('/brands')
        }
    }
    return (
        <BrandEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddBrand
