import React, {useState} from 'react'
import HttpClient from "../HttpClient";
import useSWR from "swr";
import {CheckCircle, FileCopy} from "@material-ui/icons";
import {CopyToClipboard} from "react-copy-to-clipboard/lib/Component";
import {Badge} from "reactstrap";

const Reference = () => {
    const url = `reference-code`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const [copy , setCopy] = useState({link: false, code: false})

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })
    if(!data){
        return (
            <div>Loading...</div>
        )
    }

    const copyToClipBoard = async (text) => {
        await window.navigator.clipboard.writeText(text);
        setCopy({...copy, code: true})
    }

    return (
        <div>
            <p>Reference Code:  <span className="border shadow py-1 px-3 ml-2 mr-5" >{data.data.reference}</span>
                {!copy.code ?
                    <CopyToClipboard text={data.data.reference}
                                     onCopy={() => setCopy({link: false, code: true})}>
                        <FileCopy fontSize={"large"} />
                    </CopyToClipboard>
                    : <CheckCircle fontSize={"large"} className={"text-success"} />}
            </p>
            <br/>
            <p>Reference Link:  <span className="border shadow py-1 px-3 ml-2 mr-5" >{`https://tradekunj.com/login?reference=${data.data.reference}`}</span>
                {!copy.link ?
                    <CopyToClipboard text={`https://tradekunj.com/login?reference=${data.data.reference}`}
                                     onCopy={() => setCopy({link: true, code: false})}>
                        <FileCopy fontSize={"large"} />
                    </CopyToClipboard>
                    : <CheckCircle fontSize={"large"} className={"text-success"} />}
            </p>

            <br/>
            <p>Member Refered: <Badge >{data.data.member}</Badge></p>
            <br/>
            <p>Point Value:  <Badge>{data.data.point_value}</Badge> </p>
        </div>
    )
}

export default Reference;
