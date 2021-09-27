import * as React from 'react'
import CategoryEditComponent from './CategoryEditComponent'
import HttpClient from "../../../HttpClient";
import {listCategory} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddCategory = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(listCategory, values)
        if(res.status === 201){
           await mutate('categories?page=1')
            history.push('/categories')
        }
    }
    return (
        <CategoryEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddCategory
