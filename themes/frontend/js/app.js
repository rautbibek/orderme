import React from "react";
import { HashRouter, Route, Switch } from "react-router-dom";
import Home from "./components/Home";
import PrivateRoute from "./PrivateRoute";
import Order from "./components/Order";
import Reference from "./components/Reference";

const App = () => {


        return (
            <>
               <HashRouter>
                   <Switch>
                       <PrivateRoute path={"/"} exact component={Home} />
                       <PrivateRoute path={"/orders"} exact component={Order} />
                       <PrivateRoute path={"/reference-code"} exact component={Reference} />
                   </Switch>
               </HashRouter>
            </>

        );
}

export default App;
