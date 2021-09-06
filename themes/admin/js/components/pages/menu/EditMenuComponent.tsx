import * as React from 'react'
import Nestable from 'react-nestable';
import ArrowRightIcon from '@material-ui/icons/ArrowRight';
import ArrowDropDownIcon from '@material-ui/icons/ArrowDropDown';
import {
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle, Grid,
    makeStyles
} from "@material-ui/core";
import CustomTextField from "../../Layout/CustomTextField";
import {Field, Form} from "react-final-form";
import {SingleSelect} from "react-select-material-ui";
import {Modal, ModalBody, ModalFooter, ModalHeader} from "reactstrap";
import SelectTable from "../../Layout/SelectTable";
import { nanoid } from 'nanoid'



interface EditMenuComponentProps {
    design?: any
    onSpecificChange?: any
}
const useStyles = makeStyles((theme) => ({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
    },
    form: {
        width: '100%',
    },
    buttonWrapper: {
        display: 'flex',
        marginTop: 20,
        marginButtom: 5,
        '& Button': {
            marginRight: 10
        }
    }
}));
const EditMenuComponent: React.FC<EditMenuComponentProps> = ({design, onSpecificChange}) => {
    const [modal, setModal] = React.useState(false)
    const classes = useStyles();
    const [items, setItems] = React.useState(design ? [design] : [])

    const handleMenu = (value) => {
        let design1 = items
        design1.push(value)
        setItems(design1)
        setModal(false)
    }

    interface MenuModalProps {
        onSubmit: any,
        menuprop: any
    }

    const MenuModal: React.FC<MenuModalProps> = ({onSubmit, menuprop}) => {
        return (
            <div >
                <Modal isOpen={true} style={{marginTop: 200}}>
                    <ModalHeader >Modal title</ModalHeader>
                    <ModalBody>
                            <Form
                                onSubmit={onSubmit}
                                initialValues={{
                                    ...menuprop
                                }}
                                render={({ handleSubmit, values }) => (
                                    <form onSubmit={handleSubmit} className={classes.form}>
                                        <CustomTextField name="name" type={'text'} label={'Name'}/>
                                        <Field name={`reference`}  >
                                            {({ input, meta }) => {
                                                return (
                                                    <Grid container spacing={3}>
                                                        <Grid item xs={12} style={{ marginBottom: 20 }}>
                                                            <SingleSelect
                                                                label={'Select Type'}
                                                                options={['Category', 'Collection', 'Page', 'Link']}
                                                                value={input.value}
                                                                onChange={(item) => {
                                                                    input.onChange(item)
                                                                }}
                                                                SelectProps={{
                                                                    msgNoOptionsAvailable: `No options available`,
                                                                    msgNoOptionsMatchFilter: `No options matches the filter`,
                                                                }}
                                                            />
                                                            {meta.touched && meta.error && <span style={{color: 'red'}}>{meta.error}</span>}
                                                        </Grid>
                                                    </Grid>
                                                )
                                            }}
                                        </Field>
                                        {!!values.reference && <SelectReference type={values.reference}/>}
                                        <Button variant={"outlined"} color={"primary"} type={"submit"}>Save</Button>
                                        <Button variant={"outlined"} color={"secondary"} onClick={() => setModal(false)}>Cancel</Button>

                                    </form>
                                )}


                            />
                    </ModalBody>
                </Modal>
            </div>
        )
    }
    const renderItem = ({ item, collapseIcon }) => {
        return (
            <div style={{
                display: 'flex',
                position: "relative",
                padding: "10px 15px",
                fontSize: "20px",
                border: "1px solid #526b6b",
                borderRadius: 5,
                background: "#e7ecec",
                cursor: "pointer"
            }}>
                {collapseIcon}
                {item.name}
            </div>
        )
    };

    const Collapser = ({ isCollapsed }) => {
        return (
            <div style={{display: 'flex', alignItems: "center", justifyContent: "center"}}>
                {isCollapsed ? <ArrowRightIcon /> : <ArrowDropDownIcon />}
            </div>
        );
    };
    console.log(design)
    return (
       <div>
           <Field name={'design'}>
               {({ input, meta }) => (
                   <div>
                       <div style={{display: 'flex', justifyContent: "right" , marginBottom: 10}}>
                           <Button onClick={() => setModal(!modal)}>Add item</Button>
                           {modal && <MenuModal onSubmit={(value) => {
                               onSpecificChange(value)
                               setModal(false)
                           }} menuprop={{id: nanoid(), name: ''}}/>}
                       </div>
                       <Nestable
                           items={...input.value}
                           onChange={(item) => input.onChange(item)}
                           renderItem={renderItem}
                           collapsed={true}
                           renderCollapseIcon={({ isCollapsed }) => (
                               <Collapser isCollapsed={isCollapsed} />
                           )}
                       />
                   </div>
               )}

           </Field>
       </div>
    )
}

export default EditMenuComponent

interface SelectReferenceProps {
    type: string
}
const SelectReference:React.FC<SelectReferenceProps> = ({type}) => {
    switch (type){
        case 'Category':
            return (
                <SelectTable label={'Select Category'} table={'categories'} name={'value'}/>
            )
        case 'Collection':
            return (
                <SelectTable label={'Select Collection'} table={'collections'} name={'value'}/>
            )
        case 'Page':
            return (
                <SelectTable label={'Select Page'} table={'pages'} name={'value'}/>
            )
        case 'Link':
            return (
                <CustomTextField label={'External Link'} type={'text'} name={'value'}/>
            )
    }
}
