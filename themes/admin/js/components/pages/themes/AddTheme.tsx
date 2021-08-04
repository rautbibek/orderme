import * as React from 'react'
import ThemeEditComponent from "./ThemeEditComponent";
import HttpClient from "../../../HttpClient";
import {ListTheme} from "../../../createUrls";
import {mutate} from "swr";
import {useHistory} from 'react-router-dom'

const AddTheme = () => {
    const history = useHistory();
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListTheme, values)
        if(res.status === 201){
            await mutate('themes')
            history.push('/themes')
        }
    }
    return (
        <ThemeEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddTheme
