import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import HttpClient from "../HttpClient";
import useSWR, { mutate } from "swr";
import { CopyToClipboard } from "react-copy-to-clipboard/lib/Component";
import { CheckCircle, FileCopy } from "@material-ui/icons";

const Home = () => {

    const url = `user-profile`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const [copy, setCopy] = useState({ link: false, code: false })

    const { data: data, error } = useSWR(`${url}`, fetchData)

    if (!data) {
        return (
            <div>Loading...</div>
        )
    }

    const userData = { ...data.data, image: data.data.config?.image || null }


    const copyToClipBoard = async (text) => {
        await window.navigator.clipboard.writeText(text);
        setCopy({ ...copy, code: true })
    }

    return (
        <div class="">
            <div class="main-body">

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3" style={{backgroundColor:'#011627'}}>

                        <div class="text-center p-3">
                            <img src={!userData.image ? '/no-image.jpg' : userData.image} alt="Profile Image" class="rounded-circle mx-auto" width="150" />
                            <div class="mt-3">
                                <span class="text-white">{userData.name}</span>
                                <p class="text-white">{userData.email}</p>
                                Contact : <p class="text-white">{userData.phone_number}</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" href="#">Edit Profile</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8 mb-3">

                        <div class="row">

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Earning Points
                                    </div>
                                    <div class="card-body">
                                        <span>{userData.point_value}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Reference Code
                                    </div>
                                    <div class="card-body">
                                        <span className="border shadow">{userData.reference}</span>
                                        {!copy.code ?
                                            <CopyToClipboard text={userData.reference} onCopy={() => setCopy({ link: false, code: true })}>
                                                <FileCopy fontSize={"large"} />
                                            </CopyToClipboard>
                                            :
                                            <CheckCircle fontSize={"large"} className={"text-success"} />
                                        }
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Users Referred
                                    </div>
                                    <div class="card-body">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Total Orders
                                    </div>
                                    <div class="card-body">
                                        <span>4</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Pending Orders
                                    </div>
                                    <div class="card-body">
                                        <span>5</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="card text-center border shadow">
                                    <div class="card-header mt-2">
                                        Your Cart
                                    </div>
                                    <div class="card-body">
                                        <span>6 Products</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="row gutters-10">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Default Shipping Address</h6>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Recent Orders</h6>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    )
}

export default Home
