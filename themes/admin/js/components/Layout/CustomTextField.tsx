import * as React from 'react'
import { Grid, TextField, withStyles } from "@material-ui/core";
import { Field } from "react-final-form";

interface CustomTextFieldProps {
    label: string;
    type: string;
    name: string;
    rows?: number;
    defaultValue?: any;
    disabled?: boolean;
}

const CssTextField = withStyles({
    root: {
        '& label.Mui-focused': {
            color: 'grey',
        },
        '& .MuiInput-underline': {

        },
        '& .MuiInput-underline:after': {
            borderBottomColor: '#2684FF',
        },
        '& .MuiOutlinedInput-root': {
            '& fieldset': {
                borderColor: 'grey',
            },
            '&:hover fieldset': {
                borderColor: 'grey',
            },
            '&.Mui-focused fieldset': {
                borderColor: 'grey',
            },
        },
    },
})(TextField);

const CustomTextField: React.FC<CustomTextFieldProps> = ({ label, type, name, rows, defaultValue, disabled }) => {
    if (!!defaultValue) {
        return (
            <Field name={`${name}`} defaultValue={defaultValue} >
                {({ input, meta }) => {

                    return (
                        <Grid container spacing={3}>
                            <Grid item xs={12} style={{ marginBottom: 20 }}>
                                <CssTextField size={'small'} type={`${type}`} {...input} disabled={disabled} id="standard-basic" label={`${label}`} rows={rows} fullWidth />
                                {meta.touched && meta.error && <span>{meta.error}</span>}
                            </Grid>
                        </Grid>
                    )
                }}
            </Field>
        )
    }
    return (
        <Field name={`${name}`}  >
            {({ input, meta }) => (
                <Grid container spacing={3}>
                    <Grid item xs={12} style={{ marginBottom: 20 }}>
                        <CssTextField size={'small'} type={`${type}`} {...input} disabled={disabled} id="standard-basic" label={`${label}`} rows={rows} fullWidth />
                        {meta.touched && meta.error && <span>{meta.error}</span>}
                    </Grid>
                </Grid>
            )}
        </Field>
    )
}

export default CustomTextField
