import * as React from 'react'
import MenuEditComponent from './MenuEditComponent'
import HttpClient from "../../../HttpClient";
import {ListMenus} from "../../../createUrls";
import {useHistory} from 'react-router-dom'
import {mutate} from "swr";

const AddMenu = () => {

    const history = useHistory()
    const handleSubmit = async(values: any) => {
        const res = await HttpClient.post(ListMenus, values)
        if(res.status === 201){
           await mutate('menus?page=1')
            history.push('/menus')
        }
    }
    return (
        <MenuEditComponent onSubmit={handleSubmit}/>
    )
}

export default AddMenu
