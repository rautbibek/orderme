import { Button, makeStyles } from '@material-ui/core'
import * as React from 'react'
import { Form } from 'react-final-form'
import CustomTextField from '../../Layout/CustomTextField'
import SelectTable from '../../Layout/SelectTable'

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

const ProductEditComponent = ({onSubmit}) => {
    const classes = useStyles();

    return (
        <Form
            onSubmit={onSubmit}
            render={({ handleSubmit }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="title" type={'text'} label={'Title'}/>
                    <SelectTable name={'parentId'} label={'Select Category'} table={'categories'}/>
                    <CustomTextField name="short_description" type={'textarea'} rows={3} label={'Short Description'}/>
                    <CustomTextField name="description" type={'textarea'} label={'Description'} rows={5}/>
                    <SelectTable name={'product_type'} label={'Select Product Type'} table={'product-types'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        {/* <Button variant={"contained"}  color="secondary" onClick={() => history.push('/categories')}>Back</Button> */}
                    </div>
                </form>
            )}
        />
    )
}

export default ProductEditComponent

