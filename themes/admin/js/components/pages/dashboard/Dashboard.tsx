import * as React from 'react'
import Card from "../../Layout/Card";
import HttpClient from "../../../HttpClient";
import useSWR from "swr";
import {Grid} from "@material-ui/core";
import {GroupAdd, LocalAtm, LocalAtmRounded} from "@material-ui/icons";
export default function Dashboard() {
    const url = `dashboard-chart`

    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: true })
    console.log(data)
    if(!data){
        return (
            <div>loading...</div>
        )
    }

  return (

      <Grid container spacing={2}>
               <Card title={'Customers'} count={data.data.customers} progress={50} Icon={<GroupAdd/>}/>
                <Card title={"Today's Point"} count={data.data.todayPoint} progress={50} Icon={<LocalAtm/>} />
                <Card title={'Total Point'} count={data.data.totalPoint} progress={50} Icon={<LocalAtmRounded/>} />
        </Grid>

  );
}
