import * as React from 'react'
import HttpClient from "../../../HttpClient";
import useSWR, {mutate} from "swr";
import { useHistory, useRouteMatch } from 'react-router-dom'
import * as PropTypes from 'prop-types';
import { makeStyles } from '@material-ui/core/styles';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import CustomTextField from "../../Layout/CustomTextField";
import SelectTable from "../../Layout/SelectTable";
import {Accordion, AccordionDetails, AccordionSummary, Button, Divider, Grid} from "@material-ui/core";
import {Form} from "react-final-form";
import ThemeFieldEditor from "../../Layout/ThemeFieldEditor";
import { FieldArray } from 'react-final-form-arrays';
import arrayMutators from 'final-form-arrays'
import {listProduct} from "../../../createUrls";
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import {Delete} from "@material-ui/icons";

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`vertical-tabpanel-${index}`}
            aria-labelledby={`vertical-tab-${index}`}
            {...other}
            style={{flex: 4}}
        >
            {value === index && (
                <Box p={7}>
                    {children}
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired,
};

function a11yProps(index) {
    return {
        id: `vertical-tab-${index}`,
        'aria-controls': `vertical-tabpanel-${index}`,
    };
}


const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
        backgroundColor: theme.palette.background.paper,
        display: 'flex',
        height: '800px',
    },
    tabs: {
        borderRight: `1px solid ${theme.palette.divider}`,
        maxWidth: '300px',
        minWidth: '300px'
    },
    buttonWrapper: {
        display: 'flex',
        padding: 20,
        '& Button': {
            marginRight: 10
        }
    },
    heading: {
        fontSize: theme.typography.pxToRem(15),
        fontWeight: theme.typography.fontWeightRegular,
        flex: 4
    },
}));


const ThemeConfig = () => {
    const history = useHistory()
    const match = useRouteMatch()
    const url = `themes/${match.params.id}/config`
    const fetchData = async () => {
        return await HttpClient.get(url)
    }

    const { data: data, error } = useSWR(`${url}`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: false })
    const config = data?.data.config.tnzerox.config
    const classes = useStyles();
    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const onSubmit = async (values: any) => {
        const res = await HttpClient.put(url, values)
        if(res.status === 200){
            await mutate(url)
            history.push('/themes')
        }
    }
    if(!data){
        return <div>loading...</div>
    }
   const configData = data.data.theme.config

    return (
        <div className={classes.root}>
            <Tabs
                orientation="vertical"
                variant="scrollable"
                value={value}
                onChange={handleChange}
                aria-label="Vertical tabs example"
                className={classes.tabs}
            >
                {config.map((item:any, index:number) => {
                    return (
                        <Tab key={index} label={item.name} {...a11yProps(index)} />
                    )
                })}

            </Tabs>
            <Form
                onSubmit={onSubmit}
                mutators={{
                    ...arrayMutators
                }}
                initialValues={{
                    ...configData
                }}
                render={({
                             handleSubmit,
                             form: {
                                 mutators: { push, pop, unshift }
                             },
                }) => (
                    <form onSubmit={handleSubmit} >
                        <div style={{height: '700px'}}>

                            {config.map((item:any, index:number) => {
                                return (
                                    <TabPanel key={index} value={value} index={index} >
                                        <h2 style={{textDecoration: "underline"}}>{item.name}</h2>
                                        <br/>
                                        <div style={{overflowY:"auto", overflowX: "hidden", height: '600px', padding: 30}}>
                                            <Grid container spacing={3}>
                                                {item.items.map((i: any, index: number) => {
                                                    if(i.type === 'bootstrap_collection'){
                                                        return (
                                                            <Grid key={index} item xs={12}>
                                                            <Grid container spacing={3}>
                                                                <Grid item xs={12}>
                                                                    <h3 style={{color: "#c35858"}}>{i.name}</h3>
                                                                </Grid>
                                                                <Grid item xs={12}>
                                                                    <FieldArray name={i.id}>
                                                                        {({ fields }) => (
                                                                            fields.map((fie, ind: number)=> {
                                                                                return (
                                                                                    <Accordion key={ind} style={{marginBottom: 10}}>
                                                                                        <AccordionSummary
                                                                                            expandIcon={<ExpandMoreIcon />}
                                                                                            aria-controls="panel1bh-content"
                                                                                            id="panel1bh-header"
                                                                                        >
                                                                                            <div className={classes.heading}>
                                                                                                <h4>{i.name}</h4>
                                                                                            </div>
                                                                                            <div >
                                                                                                <Button onClick={(event) => {
                                                                                                    event.stopPropagation();
                                                                                                    fields.remove(ind)
                                                                                                }} variant={"text"} color={"inherit"} size={"small"}><Delete /></Button>
                                                                                            </div>
                                                                                        </AccordionSummary>
                                                                                        <AccordionDetails>
                                                                                            <Grid container spacing={3}>
                                                                                                {
                                                                                                    i.options.template.map((ite: any, index: number) => {
                                                                                                            return (
                                                                                                                <Grid key={index} item xs={12}>
                                                                                                                    <ThemeFieldEditor name={`${i.id}[${ind}].${ite.id}`} type={ite.type} label={ite.name} options={ite.options || null}/>
                                                                                                                </Grid>
                                                                                                            )
                                                                                                        }
                                                                                                    )
                                                                                                }
                                                                                            </Grid>
                                                                                        </AccordionDetails>
                                                                                    </Accordion>

                                                                                )
                                                                            })
                                                                        )}
                                                                    </FieldArray>
                                                                </Grid>
                                                               <Grid item xs={12}>
                                                                   <Button variant={"outlined"} color={"inherit"} onClick={() => push(i.id, {})}  size={"small"} >Add</Button>
                                                               </Grid>
                                                            </Grid>
                                                            </Grid>
                                                        )
                                                    }
                                                    return (
                                                        <Grid key={index} item xs={12}>
                                                            <ThemeFieldEditor name={i.id} type={i.type} label={i.name}/>
                                                        </Grid>
                                                    )
                                                })}
                                            </Grid>
                                        </div>

                                    </TabPanel>
                                )
                            })}
                        </div>
                        <div className={classes.buttonWrapper}>
                            <Button variant={"contained"}  color="primary" type="button" onClick={handleSubmit}>Save</Button>
                            <Button variant={"contained"}  color="secondary" onClick={() => history.push('/themes')}>Back</Button>
                        </div>
                    </form>
                )}
            />

        </div>
    );
}

export default ThemeConfig
