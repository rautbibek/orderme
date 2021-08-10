import { TextField, makeStyles, Grid, Button } from '@material-ui/core'
import * as React from 'react'
import { Form, Field } from 'react-final-form'
import CustomTextField from "../../Layout/CustomTextField";
import {useHistory} from 'react-router-dom'
import SelectTable from "../../Layout/SelectTable";
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

interface CategoryEditComponentProps {
    onSubmit: any,
    category?: any
}
const CategoryValidationSchema = yup.object().shape({
    name: yup.string().required('Name is required'),
})

const CategoryEditComponent: React.FC<CategoryEditComponentProps> = ({onSubmit, category}) => {
    const classes = useStyles();
    const history = useHistory()

    return (
        <Form
            onSubmit={onSubmit}
            initialValues={
                ...category
            }
            validate={async values => {
                try {
                    await CategoryValidationSchema.validate(values, {
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
                    <CustomTextField name="name" type={'text'} label={'Name'}/>
                    <SelectTable name={'parentId'} label={'Select Parent Collection'} table={'categories'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/categories')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default CategoryEditComponent
