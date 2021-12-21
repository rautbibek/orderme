import React from 'react'
import Textfield from "../components/Textfield";
import {Button, InputLabel, makeStyles} from "@material-ui/core";
import {Field, Form} from "react-final-form";
import Imagefield from "../components/Imagefield";
import HttpClient from "../HttpClient";
import useSWR, {mutate} from "swr";
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

const ProfileValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
    email: yup.string().required('Email is required'),
    phone: yup.number().integer().required().label('Phone is required'),
    password: yup.string().required('Password is required'),
    confirm_password: yup.string()
        .oneOf([yup.ref('password'), null], 'Passwords must match')
})

const Profile = () => {
    const classes = useStyles();
    const url = `user-profile`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }
    const onSubmit = async(values) => {
        const res = await HttpClient.post('/user-profile', values)
        if(res.status === 201){
            await mutate('user-profile')
        }
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })

    if(!data){
        return (
            <div></div>
        )
    }
    const initialValue = {...data.data, image: data.data.config?.image || null, phone: data.data.phone_number}

    return (
        <div className={'row'}>
            <div className={'col-md-12 d-flex justify-content-center'} >
                <div style={{height: 100, width: 100, border: '1px solid black', borderRadius: '50%', display: 'inline-block', overflow: 'hidden'}}>
                    <img src={!initialValue.image ? '/no-image.jpg' : initialValue.image} alt=""  style={{ width: '100%', objectFit: 'contain'}} />
                </div>
            </div>
            <div className="col-md-12">
                <Form
                    onSubmit={onSubmit}
                    initialValues={
                        initialValue
                    }
                    validate={async values => {
                        try {
                            await ProfileValidationSchema.validate(values, {
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
                            <Textfield name={'name'} label={'Full Name'}/>
                            <Textfield name={'email'} label={'Email'}/>
                            <Textfield name={'phone'} label={'Phone Number'}/>
                            <Field name={'image'}>
                                {({ input, meta }) => (
                                    <div>
                                        <InputLabel>Profile Picture</InputLabel>
                                        <Imagefield onChange={images => input.onChange(images)} media={input.value}  />
                                    </div>
                                )}
                            </Field>
                            <Textfield name={'password'} label={'Password'}/>
                            <Textfield name={'confirm_password'} label={'Confirm Password'}/>
                            <div className="col-md-6">
                                <Button variant={"outlined"} type={'submit'}>Submit</Button>
                            </div>
                        </form>
                    )}
                />
            </div>
        </div>
    )
}

export default Profile
