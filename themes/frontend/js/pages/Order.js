import React from 'react';
import ReactDOM from 'react-dom';
import HttpClient from "../HttpClient";
import useSWR from "swr";
import {Button} from "react-bootstrap";
import { Link,useHistory, useLocation } from "react-router-dom"

const Order = () => {
    const url = `all-orders`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const history = useHistory()
    const [currentPage , setCurrentPage] = React.useState(1)

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if(!data){
        return (
            <div></div>
        )
    }
    return (
        <div className="row">
            {data.data.map((item, index) => {
                return (
                    <div className="col-md-12 border rounded shadow mb-2 py-3" >
                       <div className="row">
                           <div className="col-md-4">
                               <p># {item.uuid}</p>
                               <span>State: {item.state}</span>
                           </div>
                           <div className="col-md-6">
                               <p className="float-right" >Total: Rs. {item.total/100}</p>
                               <br/>
                               <br/>
                                <Button size={"sm"} className="float-right" onClick={()=>history.push(`order-detail/${item.id}`)}>
                                    View
                                </Button>
                           </div>
                       </div>
                    </div>
                )
            })}
        </div>
    )
}

export default Order
