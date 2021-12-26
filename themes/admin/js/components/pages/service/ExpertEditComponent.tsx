import {TextField, makeStyles, Grid, Button, InputLabel} from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory} from 'react-router-dom'
import * as yup from 'yup'
import AddressSelect from "../../Layout/AddressSelect";
import SelectTable from "../../Layout/SelectTable";
import CustomCheckBox from "../../Layout/CustomCheckBox";
import SingleImageDropZone from "../../Layout/SingleImageDropZone";
import CkTextfield from "../../Layout/CkTextfield";


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

interface ExpertEditComponentProps {
    onSubmit: any,
    expert?: any
}
const ExpertValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
    email: yup.string().required('Email is required'),
    phone: yup.string().required('Phone is required'),
    description: yup.string().required('Description is required'),
    province: yup.string().required('Province is required'),
    city: yup.string().required('City is required'),
    image: yup.string().required('Image is required'),
    address: yup.string().required('Address is required'),
    service_id: yup.string().required('Service is required'),
})

const ExpertEditComponent: React.FC<ExpertEditComponentProps> = ({onSubmit, expert}) => {
    const classes = useStyles();
    const history = useHistory()
    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...expert
            }
            validate={async values => {
                try {
                    await ExpertValidationSchema.validate(values, {
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
            render={({ handleSubmit, form, values }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="name" type={'text'} label={'Full Name'}/>
                    <CustomTextField name="phone" type={'text'} label={'Phone'}/>
                    <CustomTextField name="email" type={'text'} label={'Email'}/>
                    <CkTextfield name="description" label="Description"/>
                    <Field name={'image'}>
                        {({ input, meta }) => (
                            <div style={{width: '100%'}}>
                                <InputLabel>Photo</InputLabel>
                                <SingleImageDropZone onChange={images => input.onChange(images)} media={input.value} multiple={false} />
                            </div>
                        )}
                    </Field>
                    <AddressSelect values={values}/>
                    <CustomTextField name="address" type={'text'} label={'Address'}/>
                    <SelectTable label={'Services'} name={'service_id'} table={'service'} />
                    <CustomTextField name="experience" type={'text'} label={'Experience'}/>
                    <CustomCheckBox color={'primary'} checked={values.active } name={'active'} label={'Active'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/experts')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default ExpertEditComponent
