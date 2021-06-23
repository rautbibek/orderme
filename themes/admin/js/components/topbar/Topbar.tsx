import * as React from 'react'
import "./topbar.css"
import {NotificationsNone, Settings} from "@material-ui/icons";

const Topbar = () => {
    return(
        <div className='topbar'>
            <div className='tobbarWrapper'>
                <div className='topLeft'>
                    <span className='logo'>Order Me</span>
                </div>
                <div className='topRight'>
                    <div className='topbarIconContainer'>
                        <NotificationsNone/>
                        <span className='topIconBadge'>2</span>
                    </div>
                    <div className='topbarIconContainer'>
                        <Settings/>
                    </div>
                    <img src="https://st2.depositphotos.com/1104517/11965/v/600/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg" className='topAvatar' alt=""/>
                </div>
            </div>
        </div>
    )
}


export default Topbar
