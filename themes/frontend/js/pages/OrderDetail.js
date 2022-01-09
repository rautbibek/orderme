import React from 'react'
import { useHistory, useRouteMatch } from 'react-router-dom'
import HttpClient from "../HttpClient";
import useSWR, { mutate } from "swr";
import {Col, Row} from "reactstrap";
import {Box, Grid} from "@material-ui/core";
import {Button} from "react-bootstrap";

export default function OrderDetail(props) {
    const history = useHistory()

    const match = useRouteMatch()

    const url = `order/${match.params.id}`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if (error) return <div>failed to load</div>
    if (!data) return <div>loading...</div>

    return (
        <Grid container spacing={3}>
            <Grid item xs={8}>
                <Button size={"sm"} onClick={() => history.push(`/orders`)}>Back </Button>
            </Grid>
            <Grid item xs={12} >
                <Box
                    sx={{
                        width: '100%',
                        border: '1px solid #3daf3b',
                        borderRadius: 5,
                        justifyContent: 'center',
                        padding: 10
                    }}
                >
                    <Row>
                        <Col md={4}>
                            <h5>Summary</h5>
                            <p>#: {data.data.uuid}</p>
                            <p>Total: Rs. {data.data.total / 100}</p>
                        </Col>
                        <Col md={4}>
                            <h5>Shipping Address</h5>
                            <p>Name: {data.data.customer_address.name}</p>
                            <p>Phone: {data.data.customer_address.phone_number}</p>
                            <p>Address: {data.data.customer_address.street1}</p>
                            <p>Street 2: {data.data.customer_address.street2}</p>
                        </Col>
                        <Col>
                            <h5>Status</h5>
                            <p>Order Status: {data.data.state}</p>
                            <p>Shipment: {data.data.shipping_state}</p>
                            <p>Payment: {data.data.payment_state}</p>
                        </Col>
                    </Row>
                </Box>
                <Box
                    sx={{
                        width: '100%',
                        border: '1px solid #3daf3b',
                        borderRadius: 5,
                        justifyContent: 'center',
                        padding: 10,
                        marginTop: 20
                    }}
                >
                    <table className="table">
                        <thead>
                        <tr>
                            <th scope="col">image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        {data.data.cart_items.map((item, index) => {
                            return (
                                <tr>
                                    <td scope="row">
                                        <img style={{height: 50}} src={item.variant.product.image[0] ?? '/no-image.jpg'} alt={item.variant.product.title}/>
                                    </td>
                                    <td>
                                        <p>{item.variant.product.title}</p>
                                        { JSON.stringify(item.variant.features)}
                                    </td>
                                    <td>Rs. {item.unit_price/100}</td>
                                    <td>{item.quantity}</td>
                                    <td>Rs. {item.total/100}</td>
                                </tr>
                            )
                        })}

                        </tbody>
                    </table>

                    <Row>

                        <Col>
                            <p>Delivery Charge: Rs. {data.data.adjustment_total / 100}</p>
                            <p>Total: {data.data.total/100}</p>
                        </Col>
                    </Row>

                </Box>

            </Grid>
        </Grid>
    )
}
