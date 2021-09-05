import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory, useRouteMatch} from 'react-router-dom'
import SelectTable from "../../Layout/SelectTable";
import EditMenuComponent from './EditMenuComponent';

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


const MenuEditComponent: React.FC<MenuEditComponentProp> = ({onSubmit, menu}) => {
    const classes = useStyles();
    const history = useHistory()
    const match = useRouteMatch()

    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...menu
            }
            render={({ handleSubmit, values }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="name" type={'text'} label={'Name'}/>
                    {!!match.params.id && (<EditMenuComponent design={values.design}/>)}
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
