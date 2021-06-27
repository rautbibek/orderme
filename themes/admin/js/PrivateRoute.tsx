import * as React from 'react';
import { Route } from 'react-router-dom'
import './app.css'
import Topbar from "./components/topbar/Topbar";
import Sidebar from "./components/sidebar/Sidebar";

const PrivateRoute = (props) => {
    const { component: Component, ...rest } = props;
    return (
        <Route {...rest} render={items => (
            <div>
                <div className="container">
                    <Component {...items} />
                </div>
            </div>
        )} />
    )
}

export default PrivateRoute;


