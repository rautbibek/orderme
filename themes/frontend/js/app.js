import React from "react";
import { HashRouter, Route, Switch } from "react-router-dom";
import Home from "./pages/Home";
import PrivateRoute from "./PrivateRoute";
import Order from "./pages/Order";
import Reference from "./pages/Reference";
import Profile from "./pages/Profile";
import Addresses from "./pages/Addresses";
import OrderDetail from "./pages/OrderDetail";

const App = () => {


        return (
            <>
               <HashRouter>
                   <Switch>
                       <PrivateRoute path={"/"} exact component={Home} />
                       <PrivateRoute path={"/orders"} exact component={Order} />
                       <PrivateRoute path={"/reference-code"} exact component={Reference} />
                       <PrivateRoute path={"/profile"} exact component={Profile} />
                       <PrivateRoute path={"/addresses"} exact component={Addresses} />
                       <PrivateRoute path={"/order-detail/:id"} exact component={OrderDetail} />
                   </Switch>
               </HashRouter>
            </>

        );
}

export default App;
