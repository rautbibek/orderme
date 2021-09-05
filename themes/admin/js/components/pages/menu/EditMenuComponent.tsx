import * as React from 'react'
import Nestable from 'react-nestable';
import KeyboardArrowRightIcon from '@material-ui/icons/KeyboardArrowRight';
import KeyboardArrowDownIcon from '@material-ui/icons/KeyboardArrowDown';


interface EditMenuComponentProps {
    design?: any
}
const EditMenuComponent: React.FC<EditMenuComponentProps> = ({design}) => {
    const items = [
        {id: "5de0b3eb0ebcf", name: "Home", value: "/", children: [], reference: "link"},
        {id: "5de0b3ed0ebcf", name: "About", value: "/", children: [], reference: "link"},
        {id: "5desb3eb0ebcf", name: "Contact us", value: "/", children: [], reference: "link"},
        {id: "5de0b3ebfebcf", name: "Apple", value: "/", children: [], reference: "link"},
        {id: "5de0d3eb0ebcf", name: "Bfall", value: "/", children: [], reference: "link"}
    ];


    const renderItem = ({ item }) => {
        return (
            <div style={{marginBottom: 20, height: 40, backgroundColor:'grey'}}>{item.name}</div>
        )
    };
    return (
        <Nestable
            items={items}
            renderItem={renderItem}
            collapsed={true}
            renderCollapseIcon={({ isCollapsed }: { isCollapsed: boolean }) => isCollapsed ? <KeyboardArrowRightIcon/> : <KeyboardArrowDownIcon/>  }
        />
    )
}

export default EditMenuComponent
