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
import * as _ from "lodash";
import EditIcon from '@material-ui/icons/Edit';
import DeleteForeverIcon from '@material-ui/icons/DeleteForever';
import * as yup from "yup";


interface EditMenuComponentProps {
    internalMenu?: any
    onSpecificChange?: any
    setInternalMenu: any
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

const MenuValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
    reference: yup.string().required('Reference is required'),
    value: yup.string().required('Value is required'),
})

const EditMenuComponent: React.FC<EditMenuComponentProps> = ({internalMenu, onSpecificChange, setInternalMenu}) => {
    const [modal, setModal] = React.useState(false)
    const [editmenu, setEditmenu] = React.useState(null)
    const classes = useStyles();

    interface MenuModalProps {
        onSubmit: any,
        menuprop: any
    }

    const MenuModal: React.FC<MenuModalProps> = ({onSubmit, menuprop}) => {
        return (
            <div >
                <Modal isOpen={true} style={{marginTop: 100}}>
                    <ModalHeader >{!!menuprop.name ? 'Edit' : 'Add'} Menu Item</ModalHeader>
                    <ModalBody>
                            <Form
                                onSubmit={onSubmit}
                                initialValues={{
                                    ...menuprop
                                }}
                                validate={async values => {
                                    try {
                                        await MenuValidationSchema.validate(values, {
                                            abortEarly: false,
                                        })
                                    } catch (err) {
                                        const errors = err.inner.reduce(
                                            (formError, innerError) => ({
                                                ...formError,
                                                [innerError.path]: innerError.message,
                                            }),
                                            {}
                                        )

                                        return errors
                                    }
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
                                        <Button className="mr-2" variant={"contained"} color={"primary"} type={"submit"}>Save</Button>
                                        <Button variant={"contained"} color={"secondary"} onClick={() => {
                                            setModal(false)
                                            setEditmenu(null)
                                        }}>Cancel</Button>

                                    </form>
                                )}


                            />
                    </ModalBody>
                </Modal>
            </div>
        )
    }

    const replaceMenuItem = (rootMenu: any, item) => {
        let _items = rootMenu.children || []

        // Remove item in root
        _items = _items.map((b: any) => (b.id === item.id ? item : b))

        // Recurse
        _items = _items.map((b: any) => replaceMenuItem(b, item))
        return _.extend({}, rootMenu, { children: _items })
    }

    const removeMenuItem = (rootMenu: any, item) => {
        let _items = rootMenu.children || []

        // Remove item in root
        _items = _items.filter((b: any) => b.id !== item.id)

        // Recurse
        _items = _items.map((b: any) => removeMenuItem(b, item))
        return _.extend({}, rootMenu, { children: _items })
    }

    const renderItem = ({ item, collapseIcon }) => {
        return (
            <div style={{
                display: 'flex',
                position: "relative",
                padding: 4,
                fontSize: "18px",
                border: "1px solid #526b6b",
                borderRadius: 5,
                background: "#e7ecec",
                cursor: "pointer",
                justifyContent: "space-between"
            }}>
                <div style={{display:"flex"}}>
                    <span style={{display: 'flex', paddingLeft: 10, marginTop: 3}}>{collapseIcon} {item.name}</span>
                </div>
                <div>
                    <Button variant={"text"} color={"inherit"} onClick={() => {setEditmenu(item)}} size={"medium"}><EditIcon fontSize={"medium"} /></Button>
                    <Button variant={"text"} size={"medium"} color={"secondary"} onClick={() => {
                        const newMenu = removeMenuItem({children: internalMenu.design}, item )
                        setInternalMenu({...internalMenu, design: newMenu.children})
                        setModal(false)
                        setEditmenu(null)
                    }}><DeleteForeverIcon fontSize={"medium"}/></Button>
                </div>
            </div>
        )
    };

    const Collapser = ({ isCollapsed }) => {
        return (
            <div style={{display: 'flex', alignItems: "center", padding:4, justifyContent: "center"}}>
                {isCollapsed ? <ArrowRightIcon fontSize={"small"} /> : <ArrowDropDownIcon fontSize={"small"} />}
            </div>
        );
    };

    return (
       <div>
           <Field name={'design'}>
               {({ input, meta }) => (
                   <div>
                       <div style={{display: 'flex', justifyContent: "right" , marginBottom: 30}}>
                           <Button variant={"contained"} onClick={() => setModal(!modal)}>Add item</Button>
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
           {!!editmenu && <MenuModal onSubmit={(item) => {
              const newMenu = replaceMenuItem({children: internalMenu.design}, item )
               setInternalMenu({...internalMenu, design: newMenu.children})
               setModal(false)
               setEditmenu(null)
           }} menuprop={{...editmenu}}/>}
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
