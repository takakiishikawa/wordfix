import {useEffect, useState} from 'react';


export default function WordFixedCount(){
    const [wordFixed,setWordFixed]=useState({wordFixed:[]});

    useEffect(()=>{
    const url="http://127.0.0.1:8000/wordFixedCount";
    fetch(url).then(response=>response.json()).then(data=>setWordFixed(data));
    },[]);

    return (
        <>
            {wordFixed.wordTotalCount}&nbsp;fixed&nbsp; /
            &nbsp;{wordFixed.newWordFixedCount}&nbsp;new fixed&nbsp; /
            &nbsp;{wordFixed.wordUnfixedCount}&nbsp;unfixed<br></br>
            &nbsp;{wordFixed.wordAnswerCountTotal}&nbsp;total answer&nbsp; /
            &nbsp;{wordFixed.wordAnswerCountCorrect}&nbsp;total correct&nbsp; /
            &nbsp;{wordFixed.wordWeekState}&nbsp; /
        </>
    );
}
