import { useEffect, useState } from "react";


export default function Insert(){
    const [words,setWords]=useState('');


    useEffect(()=>{
        fetch(wordsListUrl).then(response=>response.json()).then(data=>setWords(data));
        console.log(words);
    })

    const wordsListUrl="https://wordsapiv1.p.mashape.com/words?random=true"
    const headers = {
        'X-RapidAPI-Key': 'SIGN-UP-FOR-KEY',
        'X-RapidAPI-Host': 'wordsapiv1.p.rapidapi.com'
      };

    fetch(url, { method: 'GET', headers: headers })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));




const insert1 = () => {
    fetch("http://127.0.0.1:8000/api/insert1", {
        method: "POST",
        body:JSON.stringify({
            'words_list':words,
        }),
        headers: {
        "Content-Type": "application/json",
        },
    })
        .then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
        })
        .then((data) => setResult(data))
        .catch((error) => console.error(error));
    };
  const insert2 = () => {
    fetch('/api/insert2',{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    })
      .then(response => response.json())
      .then(data => setResult(data))
      .catch(error => console.error(error));
  }
  const insert3 = () => {
    fetch('/api/insert3',{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    })
      .then(response => response.json())
      .then(data => setResult(data))
      .catch(error => console.error(error));
  }
  const insert4 = () => {
    fetch('/api/insert4',{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    })
      .then(response => response.json())
      .then(data => setResult(data))
      .catch(error => console.error(error));
  }
  const insert5 = () => {
    fetch('/api/insert5',{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    })
      .then(response => response.json())
      .then(data => setResult(data))
      .catch(error => console.error(error));
  }


    return (
        <>

        <ol>
            <li>
            <button onClick={insert1}>get words by WordsAPI</button>
            </li><br></br>
            <li>
            <button onClick={insert2}>get a data associated with word by WordsAPI</button>
            </li><br></br>
            <li>
            <button onClick={insert3}>get a jp's data by scraping</button>
            </li><br></br>
            <li>
            <button onClick={insert4}>get a image by Open AI API</button>
            </li><br></br>
            <li>
            <button onClick={insert5}>get the data associated with word by ChatGPT API</button>
            </li><br></br>
        </ol>


        </>
    );
}
