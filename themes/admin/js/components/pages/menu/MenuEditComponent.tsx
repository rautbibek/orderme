import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory, useRouteMatch} from 'react-router-dom'
import EditMenuComponent from './EditMenuComponent';
import * as yup from "yup";

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

interface MenuEditComponentProp {
    onSubmit: any,
    menu?: any
}

const MenuValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
})
const MenuEditComponent: React.FC<MenuEditComponentProp> = ({onSubmit, menu}) => {
    const classes = useStyles();
    const history = useHistory()
    const match = useRouteMatch()
    const [internalMenu, setInternalMenu] = React.useState({...menu})

    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...internalMenu
            }
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
                    {!!match.params.id && (<EditMenuComponent internalMenu={internalMenu} onSpecificChange={(value) => {
                        const newMenu = { ...internalMenu }
                        newMenu.design.push(value)
                    }} setInternalMenu={(value) => setInternalMenu(value)}/>)}
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/menus')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default MenuEditComponent
