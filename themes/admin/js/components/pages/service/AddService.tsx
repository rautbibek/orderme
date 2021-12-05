import * as React from 'react'
import HttpClient from "../../../HttpClient";
import {ListService} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";
import ServiceEditComponent from "./ServiceEditComponent";

const AddCategory = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListService, values)
        if(res.status === 201){
            await mutate('services?page=1')
            history.push('/services')
        }
    }
    return (
        <ServiceEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddCategory
