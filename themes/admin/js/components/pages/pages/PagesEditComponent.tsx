import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory} from 'react-router-dom'
import SelectTable from "../../Layout/SelectTable";
import CkTextfield from "../../Layout/CkTextfield";
import CustomCheckBox from "../../Layout/CustomCheckBox";

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

interface PagesEditComponentProps {
    onSubmit: any,
    page?: any,
}


const PagesEditComponent: React.FC<PagesEditComponentProps> = ({onSubmit, page}) => {
    const classes = useStyles();
    const history = useHistory()

    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...page
            }
            render={({ handleSubmit, values }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="title" type={'text'} label={'Title'}/>
                    <CkTextfield name={'description'} label={'Description'} />
                    <CustomCheckBox color={'secondary'} checked={values.active} name={'active'} label={'Active'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/pages')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default PagesEditComponent
