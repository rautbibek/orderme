import {Button, FormControlLabel, makeStyles, Checkbox, InputLabel} from '@material-ui/core'
import * as React from 'react'
import { Form } from 'react-final-form'
import CustomTextField from '../../Layout/CustomTextField'
import SelectTable from '../../Layout/SelectTable'
import SelectProductType from "./SelectProductType";
import ProductVariance from "./ProductVariance";
import SelectBrand from "./SelectBrand"
import arrayMutators from 'final-form-arrays'
import { Field } from 'react-final-form';
import ImageDropZone from "../../Layout/ImageDropZone";
import CustomCheckBox from "../../Layout/CustomCheckBox";
import {useHistory} from 'react-router-dom'
import * as yup from "yup";
import CkTextfield from "../../Layout/CkTextfield";
import TypeCondition from '../../Layout/TypeCondition'
import AddressSelect from '../../Layout/AddressSelect'

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

const ProductValidationSchema = yup.object().shape({
    title: yup.string().required('Title is required'),
    category_id: yup.string().required('Category is required'),
    description: yup.string().required('Description is required'),
    short_description: yup.string().required('Category is required'),
    product_type_id: yup.string().required('Product Type is required'),
    variants: yup
        .array()
        .of(
            yup.object().shape({
                price: yup
                    .number()
                    .required(),
                code: yup.string().required('Code is required'),
                quantity: yup
                    .string()
                    .required(),
                old_price: yup
                    .number()
                    .nullable(true),
            })
        )
        .required('At least one variant is required'),

})

const ProductEditComponent: React.FC<ProductEditComponentProps> = ({ onSubmit, product }) => {
    const classes = useStyles();
    const [productType, setProductType] = React.useState([] as any)
    const history = useHistory()

    return (
        <Form
            onSubmit={onSubmit}
            mutators={{
                ...arrayMutators
            }}
            initialValues={
                ...product
            }
            validate={async values => {
                try {
                    await ProductValidationSchema.validate(values, {
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
                    <CustomTextField name="title" type={'text'} label={'Title'} />
                    <SelectTable name={'category_id'} label={'Select Category'} table={'categories'} />
                    <SelectTable name={'collections'} label={'Select Collection'} table={'collections'} isMultiple={true}/>
                    <CustomTextField name="short_description" type={'textarea'} rows={3} label={'Short Description'} />
                    <CkTextfield name="description" label="Description"/>
                    <Field name={'image'}>
                        {({ input, meta }) => (
                            <div>
                                <InputLabel>Product Images</InputLabel>
                                <ImageDropZone onChange={images => input.onChange(images)} media={input.value} multiple />
                            </div>
                        )}
                    </Field>
                    <SelectProductType disabled={!!product?.title} onSelect={(item) => {
                        setProductType(item[0])
                    }
                    } />
                    {(!!values.product_type_id || productType.length > 0)  && (
                        <>
                            <SelectBrand productType={values.product_type_id} value={values.brand}  />
                            <hr />
                            <br />
                            <ProductVariance values={values} productType={values.product_type_id} push={push} pop={pop} optionType={values.options} />
                        </>

                    )}                    
                    <CustomCheckBox color={'primary'} checked={values.active } name={'active'} label={'Active'}/>
                    <CustomCheckBox color={'secondary'} checked={values.out_of_stock} name={'out_of_stock'} label={'Out Of Stock'}/>
                    <CustomTextField name="meta_tag_title" type={'text'} rows={3} label={'Meta Tag Title'} />
                    <CustomTextField name="meta_tag_description" type={'textarea'} rows={3} label={'Meta Tag Description'} />
                    <CustomTextField name="meta_tag_keyword" type={'text'} rows={3} label={'Meta Tag Keyword'} />
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"} color="primary" type="button" onClick={handleSubmit} >Submit</Button>
                         <Button variant={"contained"}  color="secondary" onClick={() => history.push('/products')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default ProductEditComponent

