import * as React from 'react'
import CustomerAddComponent from './CustomerAddComponent';
import HttpClient from "../../../HttpClient";
import { listCustomer } from "../../../createUrls";
import { useHistory } from 'react-router-dom'
import { mutate } from "swr";

const AddCustomer = () => {
    const history = useHistory()
    const handleSubmit = async (values: any) => {
        const res = await HttpClient.post(listCustomer, values)
        if(res.status === 201){
            await mutate('customers?page=1')
            history.push('/customers')
        }
    }

    return (
        <CustomerAddComponent onSubmit={handleSubmit} customer={{}} />
    );
}

export default AddCustomer