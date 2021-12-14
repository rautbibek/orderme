import React from "react";
import { BrowserRouter as HashRouter, Route, Switch } from "react-router-dom";
import SideBar from "./layout/Sidebar";
import Setting from "./components/Setting";
import Home from "./components/Home";
import PrivateRoute from "./PrivateRoute";

class App extends React.Component {
    state = { open: false };

    toggleMenu = () => {
        this.setState({ open: !this.state.open });
        console.log(this.state.open);
    };

    render = () => {
        const { open } = this.state;

        return (
            <HashRouter>
                <div className="wrapper">
                    <SideBar open={open} />
                    <div>
                        <Switch>
                            <PrivateRoute exact path="/me/" component={Home} />
                            <PrivateRoute exact path="/me/setting" component={Setting} />
                        </Switch>
                    </div>
                </div>
            </HashRouter>
        );
    };
}

export default App;
