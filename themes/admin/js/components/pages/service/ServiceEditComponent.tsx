import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory} from 'react-router-dom'
import * as yup from 'yup'


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

interface ServiceEditComponentProps {
    onSubmit: any,
    service?: any
}
const ServiceValidationSchema = yup.object().shape({
    title: yup.string().required('Title is required'),
})

const ServiceEditComponent: React.FC<ServiceEditComponentProps> = ({onSubmit, service}) => {
    const classes = useStyles();
    const history = useHistory()
    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...service
            }
            validate={async values => {
                try {
                    await ServiceValidationSchema.validate(values, {
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
            render={({ handleSubmit }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="title" type={'text'} label={'Title'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/services')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default ServiceEditComponent
