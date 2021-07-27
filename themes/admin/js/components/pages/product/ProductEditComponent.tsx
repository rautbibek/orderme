import {Button, FormControlLabel, makeStyles, Checkbox, InputLabel} from '@material-ui/core'
import * as React from 'react'
import { Form } from 'react-final-form'
import CustomTextField from '../../Layout/CustomTextField'
import SelectTable from '../../Layout/SelectTable'
import SelectProductType from "./SelectProductType";
import ProductVariance from "./ProductVariance";
import arrayMutators from 'final-form-arrays'
import { Field } from 'react-final-form';
import ImageDropZone from "../../Layout/ImageDropZone";

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

interface ProductEditComponentProps {
    onSubmit: any,
    product?: any
}

const ProductEditComponent: React.FC<ProductEditComponentProps> = ({ onSubmit, product }) => {
    const classes = useStyles();
    const [productType, setProductType] = React.useState([] as any)
    const [variance, setVariance] = React.useState(product?.variants.length > 0 ? true : false)

    return (
        <Form
            onSubmit={onSubmit}
            mutators={{
                ...arrayMutators
            }}
            initialValues={
                ...product
            }
            render={({
                handleSubmit,
                form: {
                    mutators: { push, pop, unshift }
                },
                values
            }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="title" type={'text'} label={'Title'} />
                    <SelectTable name={'category_id'} label={'Select Category'} table={'categories'} />
                    <CustomTextField name="short_description" type={'textarea'} rows={3} label={'Short Description'} />
                    <CustomTextField name="description" type={'textarea'} label={'Description'} rows={5} />
                    <Field name={'image'}>
                        {({ input, meta }) => (
                            <div>
                                <InputLabel>Product Images</InputLabel>
                                <ImageDropZone onChange={images => input.onChange(images)} media={input.value} />
                            </div>
                        )}
                    </Field>
                    <SelectProductType onSelect={(item) => {
                        setProductType(item[0])
                        setVariance(false)
                    }
                    } />
                    <hr />
                    <br />
                    {!!values.options  && (
                        <ProductVariance variance={variance} productType={values.product_type_id} optionType={values.options} />
                    )}
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"} color="primary" type="submit">Submit</Button>
                        {/* <Button variant={"contained"}  color="secondary" onClick={() => history.push('/categories')}>Back</Button> */}
                    </div>
                </form>
            )}
        />
    )
}

export default ProductEditComponent

