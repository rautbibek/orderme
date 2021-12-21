import React from 'react';
import ReactDOM from 'react-dom';
import {Button} from "reactstrap";
import useSWR from "swr";
import HttpClient from "../HttpClient";

const Setting = () => {
    const fetchData = async () => {
        return await HttpClient.get(`reference-code`)
    }
    const { data: data, error } = useSWR(`reference-code`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: false })
    if(!data){
        return(
            <div>page loading error...</div>
        )
    }
    return (
        <div >
            <div style={{margin:20}}>
                <p className={"mb-2"}>Reference code: {data.data.reference} </p>
                <p className={"mb-2"}>Reference Link: <a href={`https://tradekunj.com/login?reference=${data.data.reference}`}>{`https://tradekunj.com/login?reference=${data.data.reference}`}</a> </p>
                <p className={"mb-2"}>Point Value: {data.data.point_value} </p>
            </div>
        </div>
    )
}

export default Setting
