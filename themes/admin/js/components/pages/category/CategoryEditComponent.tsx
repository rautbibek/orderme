import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory} from 'react-router-dom'
import SelectTable from "../../Layout/SelectTable";

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


const Category = () => {
    const classes = useStyles();
    const history = useHistory()

    return (
        <Form
            onSubmit={console.log}
            render={({ handleSubmit }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="title" type={'text'} label={'Title'}/>
                    <SelectTable/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/categories')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default Category
