import $ from "jquery"
import { render } from 'react-dom';

$(function () {
    console.log('hello')
    const Simple = () => {
        return (<div></div>)
    }
    render(<Simple />)
})



