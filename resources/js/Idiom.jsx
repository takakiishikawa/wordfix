import {Link} from 'react-router-dom';
import {useEffect, useState,useRef} from 'react';
import { countBy } from 'lodash';
import IdiomFixedCount from './IdiomFixedCount';
import Button from '@mui/material/Button';
import Box from '@mui/material/Box';
import SendIcon from '@mui/icons-material/Send';
import AlarmIcon from '@mui/icons-material/Alarm';
import TextField from '@mui/material/TextField';
import Alert from "@mui/material/Alert";
import Stack from "@mui/material/Stack";

//navigation
import BottomNavigation from "@mui/material/BottomNavigation";
import BottomNavigationAction from "@mui/material/BottomNavigationAction";
import QuizIcon from '@mui/icons-material/Quiz';
import AddIcon from '@mui/icons-material/Add';
import ListAltIcon from '@mui/icons-material/ListAlt';

import Typography from '@mui/material/Typography';

import "../css/top.css";


//グローバル変数。関数内では初期化してしまう。一旦の処置
let answerList=[];
let count=0;
let clearCount=0;
let questionKey=0;


// 発言を設定
const webSpeech = new SpeechSynthesisUtterance();

// 音声各種設定
webSpeech.lang = 'en-US';
webSpeech.pitch = 1;

speechSynthesis.cancel();




export default function Word(){
    const [questionArray,setQuestionArray]=useState({idiomQuestionList:[]});
    const [navigation,setNavigation]=useState(1);

    const [answer,setAnswer]=useState('');
    const [question,setQuestion]=useState('');
    const [id,setId]=useState('');
    const [parse,setParse]=useState('');

    const [correctCount,setCorrectCount]=useState('');
    const [incorrectMessage,setIncorrectMessage]=useState('');
    const [jpn,setJpn]=useState('');

    const [culClearCount,setCulClearCount]=useState('');
    const [sentence,setSentence]=useState('');
    const [root,setRoot]=useState('');

    const inputElm=useRef('');

    const voice = speechSynthesis.getVoices().find(function(voice){
        return voice.name === 'Google US English';
    });

    // 取得できた場合のみ適用する
    if(voice){
        webSpeech.voice = voice;
    }

    //question & WordFixedCount表示
    useEffect(()=>{
        const url="http://127.0.0.1:8000/questionList";
        fetch(url).then(response=>response.json()).then(data=>setQuestionArray(data));
    },[]);

    //開始(ランダムに問題を表示)
    const onClickStart=(()=>{
        setQuestion(questionArray.idiomQuestionList[questionKey].eng);
        setParse("("+questionArray.idiomQuestionList[questionKey].parse+")");
        setId(questionArray.idiomQuestionList[questionKey].id);
        setCorrectCount(questionArray.idiomQuestionList[questionKey].correctCount+"/3");
        setJpn(questionArray.idiomQuestionList[questionKey].jpn);
        setRoot(questionArray.idiomQuestionList[questionKey].root);
        setSentence(questionArray.idiomQuestionList[questionKey].sentence);

        //word pronounce
        webSpeech.text=questionArray.idiomQuestionList[questionKey].eng;
        window.speechSynthesis.speak(webSpeech);

        //sentence  pronounce
            webSpeech.text=questionArray.idiomQuestionList[questionKey].sentence;
            window.speechSynthesis.speak(webSpeech);

        //フォームへ自動カーソル
        inputElm.current.focus();
        questionKey++;
    });

    //Answerステート変更 & 送信
    const onChangeAnswer=((event)=>{
        setAnswer(event.target.value);
    });

    const onClickAnswer=(()=>{
        //不正解時にメッセージ表示
        if(jpn.includes(answer) && answer!==""){

            setIncorrectMessage(
                <Alert severity="success">
                    Exactly!<br></br>
                    Correct&nbsp;:&nbsp;{jpn}
                </Alert>
            );
            //正答率計算
            clearCount++;
            setCulClearCount("Correct Rate : "+Math.floor(clearCount/count*100)+"%");

        }else{
            setIncorrectMessage(
                <Alert severity="error">
                    Correct&nbsp;:&nbsp;{jpn}<br></br>
                    Incorrect&nbsp;:&nbsp;{answer}
                </Alert>
                );
            //正答率計算
            setCulClearCount("Correct Rate : "+Math.floor(clearCount/count*100)+"%");
        }

        //回答のたびにanswerList作成
        answerList.push({
            'id':id,
            'answer':answer,
        });
        count++;

        //answer初期化
        setAnswer("");

        if(count===questionArray.idiomQuestionList.length){
            const url3="http://127.0.0.1:8000/answerList";
            fetch(url3,{
                method:'POST',
                body:JSON.stringify(answerList),
            }).then(response=>console.log(response)).then(error=>console.log(error));

            count='';
            questionKey=0;
            answerList=[];

            //新規の問題を取得
            const url="http://127.0.0.1:8000/questionList";
            fetch(url).then(response=>response.json()).then(data=>setQuestionArray(data));
        }

        //回答後、自動でランダムに問題を表示
        if(count < 11){
            onClickStart();
            inputElm.current.value="";
        }
    });


    return (
        <>
        <div id="navigation">
        <Box sx={{ width: 1000 }}>
            <BottomNavigation
                showLabels
                value={navigation}
                onChange={(e,navigationCount) => {
                setNavigation(navigationCount);
                }}
            >
                <BottomNavigationAction label="Word" icon={<QuizIcon />} component={Link} to=".." />
                <BottomNavigationAction label="Idiom" icon={<QuizIcon />} component={Link} to="/idiom"   />
                <BottomNavigationAction label="Add" icon={<AddIcon />} component={Link} to="/add" />
                <BottomNavigationAction label="List" icon={<ListAltIcon />}  component={Link} to="/list" />

            </BottomNavigation>
        </Box>
        </div>

        <Typography align="center">
            <IdiomFixedCount />
        </Typography>
        <Typography align="center">

        {/*<img src={"/img/instagram_profile_image.png"} size="small" className="logo" />*/}

        <div>
            <span>Question&nbsp;{count+1} / {questionArray.idiomQuestionList.length} <AlarmIcon /></span><br></br>
            <span>{culClearCount}</span>
        </div><br></br>
        <div>
            <Button type="button" onClick={onClickStart} variant="contained" size="large">Start</Button>
        </div><br></br>
        </Typography>
        <div id='question'>
        <Typography variant="h5" gutterBottom align="center">
        {question}&nbsp;{parse} {correctCount}&nbsp;{root}<br></br>
        {sentence}
        </Typography>
        </div>
        <Typography align="center">

        <Box sx={{'& > :not(style)': { m: 1, width: '20ch' },}}>
        <TextField id="answerOutlined" label="Eng" variant="outlined" onChange={onChangeAnswer} inputRef={inputElm} autoFocus inputProps={{autocomplete:"off"}} />
        </Box><p></p>
        <Button type='button' onClick={onClickAnswer} variant="contained" size="large" endIcon={<SendIcon />} align="center" >Send</Button>
        </Typography>
        <br></br>
        <div>{incorrectMessage}</div>
        </>
    );
}



