import {Button, FormControlLabel, makeStyles, Checkbox, InputLabel} from '@material-ui/core'
import * as React from 'react'
import { Form } from 'react-final-form'
import CustomTextField from '../../Layout/CustomTextField'
import arrayMutators from 'final-form-arrays'
import {useHistory} from 'react-router-dom'
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

interface CustomerEditComponentProps {
    onSubmit: any,
    customer?: any
}

const CustomerValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
    email: yup.string().required('Email is required'),
    phone_number: yup.string().required('Phone Number is required'),

})

const CustomerEditComponent: React.FC<CustomerEditComponentProps> = ({ onSubmit, customer }) => {
    const classes = useStyles();
    // const [productType, setProductType] = React.useState([] as any)
    const history = useHistory()

    return (
        <Form
            onSubmit={onSubmit}
            mutators={{
                ...arrayMutators
            }}
            initialValues={
                ...customer
            }
            validate={async values => {
                try {
                    await CustomerValidationSchema.validate(values, {
                        abortEarly: false,
                    })
                } catch (err) {
                    return err.inner.reduce(
                        (formError, innerError) => ({
                            ...formError,
                            [innerError.path]: innerError.message,
                        }),
                        {}
                    )

                }
            }}
            render={({
                handleSubmit,
                form: {
                    mutators: { push, pop, unshift }
                },
                values
            }) => (
                <form className={classes.form}>
                    <CustomTextField name="name" type={'text'} label={'Name'} />
                    <CustomTextField name="email" type={'text'} label={'Name'} />
                    <CustomTextField name="phone_number" type={'text'} label={'Phone Number'} />
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"} color="primary" type="button" onClick={handleSubmit} >Submit</Button>
                         <Button variant={"contained"}  color="secondary" onClick={() => history.push('/customers')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default CustomerEditComponent

