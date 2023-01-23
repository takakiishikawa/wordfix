import {Link} from "react-router-dom";
import {useState,useEffect,useRef} from 'react';
import axios from 'axios';
import SendIcon from '@mui/icons-material/Send';

//parse select
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';
import TextField from '@mui/material/TextField';

//navigation
import BottomNavigation from "@mui/material/BottomNavigation";
import BottomNavigationAction from "@mui/material/BottomNavigationAction";
import RestoreIcon from "@mui/icons-material/Restore";
import FavoriteIcon from "@mui/icons-material/Favorite";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import Button from '@mui/material/Button';
import Box from '@mui/material/Box';
import QuizIcon from '@mui/icons-material/Quiz';
import AddIcon from '@mui/icons-material/Add';
import ListAltIcon from '@mui/icons-material/ListAlt';

import Typography from '@mui/material/Typography';

//tab
import Tab from '@mui/material/Tab';
import TabContext from '@mui/lab/TabContext';
import TabList from '@mui/lab/TabList';
import TabPanel from '@mui/lab/TabPanel';
import { countBy } from 'lodash';


export default function Add(){

    const serverUrl=import.meta.env.VITE_SERVER_API_ADDRESS;

    const [count,setCount]=useState('');
    const [countMemo,setCountMemo]=useState('');

    const [parse,setParse]=useState('');
    const [type,setType]=useState('word');
    const [eng,setEng]=useState('');
    const [jpn,setJpn]=useState('');

    const [navigation]=useState(2);
    const [tabValue, setTabValue] = useState("1");
    const [sentence,setSentence]=useState('');
    const [root,setRoot]=useState('');
    const [prefix,setPrefix]=useState('');
    const [suffix,setSuffix]=useState('');
    const [origin,setOrigin]=useState('');
    const [wordOrigin,setWordOrigin]=useState('');



    const [select,setSelect]=useState({suffixArray:[],rootArray:[],prefixArray:[],originArray:[],wordOriginArray:[]});

    //textfield初期化
    const inputCountElm=useRef('');
    const inputCountMemoElm=useRef('');
    const inputEngElm=useRef('');
    const inputJpnElm=useRef('');

    const inputSentenceElm=useRef('');
    const inputRootElm=useRef('');
    const inputPrefixElm=useRef('');
    const inputSuffixElm=useRef('');
    const inputOriginElm=useRef('');
    const inputWordOriginElm=useRef('');



    useEffect(()=>{
        const url=serverUrl+"/add/select";
        fetch(url)
            .then(response=>response.json())
            .then(data=>{
                setSelect(data);
            });
    },[]);


    //Count
    const onChangeCount=(event)=>{
        setCount(event.target.value);
    }
    const onChangeCountMemo=(event)=>{
        setCountMemo(event.target.value);
    }

    const onClickPastFixed=()=>{
        const url=serverUrl+"/add/pastFixed";
        fetch(url,{
            method:'POST',
            body:JSON.stringify({
                'count':count,
                'type':type,
                'countMemo':countMemo,
            }),
        }).then(response=>console.log(response)).then(error=>console.log(error));

        inputCountElm.current.value="";
        inputCountMemoElm.current.value="";
    }

    //////new word
    //type
    const onChangeType = (event) => {
        setType(event.target.value);
    };

    //parse
    const onChangeParse = (event) => {
        setParse(event.target.value);
    };

    //eng
    const onChangeEng=(event)=>{
        setEng(event.target.value);

    }

    const onChangeJpn=(event)=>{
        setJpn(event.target.value);
    }

    const onChangeSentence=(event)=>{
        setSentence(event.target.value);
    }

    const onChangeRoot=(event)=>{
        setRoot(event.target.value);
    }

    const onChangePrefix=(event)=>{
        setPrefix(event.target.value);
    }

    const onChangeSuffix=(event)=>{
        setSuffix(event.target.value);
    }

    const onChangeOrigin=(event)=>{
        setOrigin(event.target.value);
    }

    const onChangeWordOrigin=(event)=>{
        setWordOrigin(event.target.value);
    }

    const onClickNewWord=()=>{
        const url=serverUrl+"/add/newWord";
        fetch(url,{
            method:'POST',
            body:JSON.stringify({
                'type':type,
                'parse':parse,
                'eng':eng,
                'jpn':jpn,
                'sentence':sentence,
                'prefix':prefix,
                'suffix':suffix,
                'root':root,
                'origin':origin,
                'wordOrigin':wordOrigin,
            }),
        }).then(response=>console.log(response)).then(error=>console.log(error));
        inputEngElm.current.value="";
        inputJpnElm.current.value="";
        inputSentenceElm.current.value="";
        inputRootElm.current.value="";
        inputPrefixElm.current.value="";
        inputSuffixElm.current.value="";
        inputOriginElm.current.value="";
        inputWordOriginElm.current.value="";

        setEng('');
        setJpn('');
        setSentence('');
        setRoot('');
        setSuffix('');
        setPrefix('');
        setOrigin('');
        setWordOrigin('');
    }

    //タブ切り替え
    const onChangeTab = (event, newValue) => {
        setTabValue(newValue);
    };


    return (
        <>
        <div id="navigation">
        <Box sx={{ width: 1000 }}>
            <BottomNavigation
                showLabels
                value={navigation}
            >
                <BottomNavigationAction label="Word" icon={<QuizIcon />} component={Link} to=".." />
                <BottomNavigationAction label="Idiom" icon={<QuizIcon />} component={Link} to="/idiom"   />
                <BottomNavigationAction label="Add" icon={<AddIcon />}  component={Link} to="/add" />
                <BottomNavigationAction label="List" icon={<ListAltIcon />}  component={Link} to="/list" />
            </BottomNavigation>
        </Box>
        </div>

        <div id="tab">
            <Box sx={{ width: '100%', typography: 'body1' }}>
            <TabContext value={tabValue}>
                <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
                <TabList onChange={onChangeTab} aria-label="lab API tabs example" centered>
                    <Tab label="Add new word" value="1" />
                    <Tab label="Add fixed count" value="2" />
                </TabList>
                </Box>
                <TabPanel value="1">
                    <Typography align="center">
                    <div id="addNewWord">
                        <FormControl sx={{ m: 1, minWidth: 120 }}>
                        <InputLabel id="currentLabel">Type</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={type}
                            label="Type"
                            onChange={onChangeType}
                            >
                            <MenuItem value={"word"}>word</MenuItem>
                            <MenuItem value={'idiom'}>idiom</MenuItem>
                            </Select>
                        </FormControl>

                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">Parse</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={parse}
                            label="Parse"
                            onChange={onChangeParse}
                            >
                            <MenuItem value={"n"}>n</MenuItem>
                            <MenuItem value={'pron'}>pron</MenuItem>
                            <MenuItem value={'v'}>v</MenuItem>
                            <MenuItem value={'adj'}>adj</MenuItem>
                            <MenuItem value={'adv'}>adv</MenuItem>
                            <MenuItem value={'aux'}>aux</MenuItem>
                            <MenuItem value={'prep'}>prep</MenuItem>
                            <MenuItem value={'art'}>art</MenuItem>
                            <MenuItem value={'con'}>con</MenuItem>
                            <MenuItem value={'int'}>int</MenuItem>
                            <MenuItem value={'-'}>-</MenuItem>
                            </Select>
                        </FormControl>

                        <Box sx={{'& > :not(style)': { m: 1, width: '40ch' },}}>
                        <TextField id="countOutlined" label="Eng" variant="outlined" onChange={onChangeEng} inputRef={inputEngElm} inputProps={{autocomplete:"off"}}  />
                        <TextField id="countOutlined" label="Jpn" variant="outlined" onChange={onChangeJpn} inputRef={inputJpnElm} inputProps={{autocomplete:"off"}}  /><br></br>

                        <TextField id="countOutlined" label="sentence" variant="outlined" onChange={onChangeSentence} inputRef={inputSentenceElm} sx={{ m: 1, minWidth: 730 }} inputProps={{autocomplete:"off"}}  /><br></br>



                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">Root</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={root}
                            label="root"
                            onChange={onChangeRoot}
                            inputRef={inputRootElm}
                            >
                            {console.log(select.root)}
                            {select.rootArray.map((item,i)=>{
                                return (
                                <MenuItem key={i} value={item}>{item}</MenuItem>
                                )
                            })}
                            </Select>
                        </FormControl>

                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">wordOrigin</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={wordOrigin}
                            label="wordOrigin"
                            onChange={onChangeWordOrigin}
                            inputRef={inputWordOriginElm}
                            >
                            {select.wordOriginArray.map((item,i)=>{
                                return (
                                <MenuItem key={i} value={item}>{item}</MenuItem>
                                )
                            })}
                            </Select>
                        </FormControl>

                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">Prefix</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={prefix}
                            label="prefix"
                            onChange={onChangePrefix}
                            inputRef={inputPrefixElm}
                            >
                            {select.prefixArray.map((item,i)=>{
                                return (
                                <MenuItem key={i} value={item}>{item}</MenuItem>
                                )
                            })}
                            </Select>
                        </FormControl>

                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">Suffix</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={suffix}
                            label="suffix"
                            onChange={onChangeSuffix}
                            inputRef={inputSuffixElm}
                            >
                            {select.suffixArray.map((item,i)=>{
                                return (
                                <MenuItem key={i} value={item}>{item}</MenuItem>
                                )
                            })}
                            </Select>
                        </FormControl>

                        <FormControl sx={{ m: 1, minWidth: 120 }} >
                        <InputLabel id="currentLabel">derivedOrigin</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={origin}
                            label="origin"
                            onChange={onChangeOrigin}
                            inputRef={inputOriginElm}
                            >
                            {select.originArray.map((item,i)=>{
                                return (
                                <MenuItem key={i} value={item}>{item}</MenuItem>
                                )
                            })}
                            </Select>
                        </FormControl>



                        </Box>

                        <Button type="button" onClick={onClickNewWord} variant="contained" endIcon={<SendIcon />}>Send</Button>
                    </div>
                    </Typography>
                </TabPanel>
                <TabPanel value="2">
                <Typography align="center">
                <div id="addPastFixed">
                    {/*部分未理解*/}
                    <Box sx={{'& > :not(style)': { m: 1, width: '33ch' },}}>
                    <TextField id="countOutlined"  label="WordCount" variant="outlined" onChange={onChangeCount} inputRef={inputCountElm} inputProps={{autocomplete:"off"}}  />
                    <br></br>
                    <TextField id="countOutlined" label="countMemo" variant="outlined" onChange={onChangeCountMemo} inputRef={inputCountMemoElm} inputProps={{autocomplete:"off"}}  />
                    <br></br>
                    <FormControl sx={{ m: 1, minWidth: 120 }}>
                        <InputLabel id="currentLabel">Type</InputLabel>
                            <Select
                            labelId="currentLabel"
                            id="label"
                            value={type}
                            label="Type"
                            onChange={onChangeType}
                            >
                            <MenuItem value={"word"}>word</MenuItem>
                            <MenuItem value={'idiom'}>idiom</MenuItem>
                            </Select>
                        </FormControl>
                    </Box><br></br>
                    <Button type="button" onClick={onClickPastFixed} variant="contained" endIcon={<SendIcon />}>Send</Button>
                </div>
                </Typography>
                </TabPanel>
            </TabContext>
            </Box>
        </div>
        </>
    );
}





