import * as React from 'react'
import HttpClient from "../../../HttpClient";
import { useHistory, useRouteMatch } from 'react-router-dom'


import useSWR from "swr";
import {Button} from "@material-ui/core";
import {Print} from "@material-ui/icons";



const Order = () => {

    const match = useRouteMatch()
    const url = `orders/${match.params.id}/edit`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>
    return (
        <div>
            <Button className="ml-1 mb-2" color={"secondary"} onClick={() => {
                var printContents = document.getElementById('printablearea').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }} >print <Print/> </Button>
            <div id="printablearea">
                <ComponentToPrint data={data}/>
            </div>
        </div>
    )
}

export default Order

interface ComponentProps {
    data: any,
}

const ComponentToPrint:React.FC<ComponentProps> = ({data}) => {
    return (
        <div className="container">
            <div className="row">
                <div className="col-12">
                    <div className="card">
                        <div className="card-body p-0">
                            <div className="row p-5">
                                <div className="col-md-6">
                                    <img style={{height: 70}} src="https://firebasestorage.googleapis.com/v0/b/tradekunj-prod.appspot.com/o/1e9cf880-a4a2-44be-af2f-684b3ca089fb-225835407_110499844660397_3299088769491264290_n.png?alt=media&token=c1064bdd-d6d8-4595-8412-d32096a3ef59"/>
                                </div>

                                <div className="col-md-6 text-right">
                                    <p className="font-weight-bold mb-1">Invoice #{data.data.uuid}</p>
                                    <p className="text-muted">Due to: {new Date(data.data.created_at).toDateString()}</p>
                                </div>
                            </div>
                            <div className="col-md-6 offset-md-4">
                                <h5>Tradekunj Pvt Ltd.</h5>
                                <p>Kirtimarg, Koteshor-32, Kathmandu</p>
                                <p>Tel: 01-5147254</p>
                            </div>

                            <hr className="my-5"/>

                            <div className="row pb-5 p-5">
                                <div className="col-md-6">
                                    <p className="font-weight-bold mb-4">Client Information</p>
                                    <p className="mb-1">Name: {data.data.customer_address.name}</p>
                                    <p className="mb-1">Phone: {data.data.customer_address.phone_number}</p>
                                    <p>{data.data.customer_address.street1}</p>
                                    <p className="mb-1">{data.data.customer_address.street2}</p>
                                </div>

                                <div className="col-md-6 text-right">
                                    <p className="font-weight-bold mb-4">Payment Details</p>
                                    <p className="mb-1"><span className="text-muted">Name: </span> {data.data.user.name}</p>
                                    <p className="mb-1"><span className="text-muted">Email: </span> {data.data.user.email}</p>
                                </div>
                            </div>

                            <div className="row p-5">
                                <div className="col-md-12">
                                    <table className="table">
                                        <thead>
                                        <tr>
                                            <th className="border-0 text-uppercase small font-weight-bold">ID</th>
                                            <th className="border-0 text-uppercase small font-weight-bold">Item</th>
                                            <th className="border-0 text-uppercase small font-weight-bold">Description</th>
                                            <th className="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                            <th className="border-0 text-uppercase small font-weight-bold">Unit
                                                Cost
                                            </th>
                                            <th className="border-0 text-uppercase small font-weight-bold">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {data.data.cart_items.map((item, index) => {
                                            return(
                                                <tr key={index}>
                                                    <td>{index+1}</td>
                                                    <td>{item.variant.product.title}</td>
                                                    <td>{ JSON.stringify(item.variant.features)}</td>
                                                    <td>{item.quantity}</td>
                                                    <td>Rs. {item.unit_price/100}</td>
                                                    <td>Rs. {item.unit_total/100}</td>
                                                </tr>
                                            )
                                        })}

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div className="d-flex flex-row-reverse bg-dark text-white p-4">
                                <div className="py-3 px-5 text-right">
                                    <div className="mb-2">Grand Total</div>
                                    <div className="h2 font-weight-light">Rs. {data.data.total/100}</div>
                                </div>

                                <div className="py-3 px-5 text-right">
                                    <div className="mb-2">Shipping Charge</div>
                                    <div className="h2 font-weight-light">Rs. {data.data.adjustment_total/100}</div>
                                </div>

                                <div className="py-3 px-5 text-right">
                                    <div className="mb-2">Sub - Total amount</div>
                                    <div className="h2 font-weight-light">Rs. {data.data.items_total/100}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    )
}
