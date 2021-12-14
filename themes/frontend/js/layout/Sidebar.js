import React from "react";
import { Link } from "react-router-dom";
import { DropdownButton } from "react-bootstrap";
import {MenuItem} from "@material-ui/core";

class SideBar extends React.Component {
    state = { active: !this.props.open || true };

    render = () => {
        const { open } = this.props;
        const active = !open;

        return (
            <nav id="sidebar" className={active ? "active" : null}>
                <div className="sidebar-header">
                </div>

                <ul className="list-unstyled components">
                    <li>
                        <Link to={"/me"} replace > Home</Link>
                    </li>
                    <li>
                        <Link to={"/me/setting"} replace > Setting</Link>
                    </li>
                </ul>
            </nav>
        );
    };
}

export default SideBar;
