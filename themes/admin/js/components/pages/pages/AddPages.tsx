import * as React from 'react'
import PagesEditComponent from './PagesEditComponent'
import HttpClient from "../../../HttpClient";
import {ListPages} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddPages = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListPages, values)
        if(res.status === 201){
           await mutate('pages')
            history.push('/pages')
        }
    }
    return (
        <PagesEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddPages
