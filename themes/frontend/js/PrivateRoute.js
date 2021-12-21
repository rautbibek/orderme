import * as React from 'react';
import { Route } from 'react-router-dom'
import SideBar from "./layout/Sidebar";
import {Menu} from "@material-ui/icons";
import {useState} from "react";
import Layout from "./layout/Layout";

const PrivateRoute = (props) => {
    const { component: Component, ...rest } = props;
    const [ showNav, setShowNav] = useState(true)
    return (
        <Route {...rest} render={items => (
            <>
                <div className="header-home" >
                    <Menu fontSize={"large"} onClick={() => setShowNav(!showNav)} />
                </div>
                    <div style={{display:'flex'}}>
                        <SideBar show={showNav}/>
                        <Layout show={showNav} ><Component/></Layout>
                    </div>
            </>

        )} />
    )
}

export default PrivateRoute;


