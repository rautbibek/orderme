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
import CustomCheckBox from "../../Layout/CustomCheckBox";
import {useHistory} from 'react-router-dom'

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
                    <SelectProductType disabled={!!product?.title} onSelect={(item) => {
                        setProductType(item[0])
                    }
                    } />
                    <hr />
                    <br />
                    {(!!values.options || productType.length > 0)  && (
                        <ProductVariance productType={values.product_type_id} push={push} optionType={values.options} />
                    )}
                    <CustomCheckBox color={'primary'} checked={values.featured} name={'featured'} label={'Featured'}/>
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

