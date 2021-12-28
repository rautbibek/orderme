import React from 'react';
import ReactDOM from 'react-dom';
import HttpClient from "../HttpClient";
import useSWR, {mutate} from "swr";

const Home = () => {

    const url = `user-profile`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData)

    if(!data){
        return (
            <div></div>
        )
    }

    const userData = {...data.data, image: data.data.config?.image || null}

    return (
        <div class="container">
            <div class="main-body">

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">

                        <div class="d-flex flex-column align-items-center text-center">
                            <img src={!userData.image ? '/no-image.jpg' : userData.image} alt="Profile Image" class="rounded-circle" width="150" />
                            <div class="mt-3">
                                <h4>{userData.name}</h4>
                                <p class="text-secondary mb-1">{userData.email}</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" href="#">Edit Profile</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-sm-4 d-flex justify-content-center">

                            </div>
                            <div class="col-sm-4 d-flex justify-content-center">

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    )
}

export default Home
