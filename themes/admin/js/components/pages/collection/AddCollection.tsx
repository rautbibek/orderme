import * as React from 'react'
import CollectionEditComponent from './CollectionEditComponent'
import HttpClient from "../../../HttpClient";
import {ListCollection} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddCollection = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListCollection, values)
        if(res.status === 201){
           await mutate('collections?page=1')
            history.push('/collections')
        }
    }
    return (
        <CollectionEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddCollection
