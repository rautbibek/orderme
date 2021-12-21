import React from "react";
import { Link } from "react-router-dom";
import { DropdownButton } from "react-bootstrap";
import {MenuItem} from "@material-ui/core";
import {Home, LocalMall, Map, MonetizationOn, People} from "@material-ui/icons";


const SideBar  = ({show}) => {

        return (
            <>
                <div className={show ? 'sidenav active' : 'sidenav'}>
                    <ul>
                        <li>
                            <Link to="/" replace >
                                <Home/> <span>Home</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/orders" replace>
                                 <LocalMall/> <span>Order</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/reference-code" replace>
                               <MonetizationOn/> <span> Refer Code</span>
                            </Link>
                        </li>
                        {/*<li>*/}
                        {/*    <Link to="/profile" replace>*/}
                        {/*        <People/> <span> Profile</span>*/}
                        {/*    </Link>*/}
                        {/*</li>*/}
                        {/*<li>*/}
                        {/*    <Link to="/address" replace>*/}
                        {/*        <Map/> <span>Addresses</span>*/}
                        {/*    </Link>*/}
                        {/*</li>*/}
                    </ul>
                </div>
                </>
        );
}

export default SideBar;
