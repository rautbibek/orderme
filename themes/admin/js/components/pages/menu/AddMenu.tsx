import * as React from 'react'
import MenuEditComponent from './MenuEditComponent'
import HttpClient from "../../../HttpClient";
import {ListCollection} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddMenu = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListCollection, values)
        if(res.status === 201){
           await mutate('collections')
            history.push('/collections')
        }
    }
    return (
        <MenuEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddMenu
