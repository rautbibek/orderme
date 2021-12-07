import * as React from 'react'
import HttpClient from "../../../HttpClient";
import {ListExpert} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";
import ExpertEditComponent from "./ExpertEditComponent";

const AddExpert = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListExpert, values)
        if(res.status === 201){
            await mutate('experts?page=1')
            history.push('/experts')
        }
    }
    return (
        <ExpertEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddExpert
