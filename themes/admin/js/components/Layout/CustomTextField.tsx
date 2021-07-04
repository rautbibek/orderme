import * as React from 'react'
import {Grid, TextField} from "@material-ui/core";
import {Field} from "react-final-form";

interface CustomTextFieldProps {
label: String;
type: String;
name: String;
}

const CustomTextField: React.FC<CustomTextFieldProps> = ({label, type, name}) => {
    return (
        <Field name={`${name}`}>
            {({ input, meta }) => (
                <Grid container spacing={3}>
                    <Grid item xs={12}>
                        <TextField size={'small'} type={`${type}`} {...input} id="outlined-basic" label={`${label}`} variant="outlined" fullWidth />
                        {meta.touched && meta.error && <span>{meta.error}</span>}
                    </Grid>
                </Grid>
            )}
        </Field>
    )
}

export default CustomTextField
