## Who's it for?
me !

## Why build it?
It is a strong need for me as an English word-learning tool.

## What is it?
This is English word learning tool.
rapidly increase English word counts in one's brain database.

## where is document?
| where is | content |
| --- | --- | --- |
|gss|Screen Transition Diagram|
|gss|UI design|
|gss|Function List|
|md|1.Database Design|
|md|2.Class Diagram|
|md|3.Component Diagram|
|md|4.State transition Diagram|

## GitHub rule
#### Branch
・main
・develop

#### commit命名ルール	
[feat]：機能追加
[fix]：不具合修正
[remove]：機能削除
[refactor]：機能再構築
[style]：css修正
[other]：その他

	

## 1.Database Design
```mermaid
erDiagram
Level ||--o{ Word: ""
Level ||--o{ UserLevel: ""
User ||--o{ UserWord: ""
User ||--o{ UserLevel: ""
UserLevel ||--o{ UserWord: ""
Word ||--o{ UserWord: ""


User {
    integer id PK
    string name
    string email
    string password
    string image
}

Word {
    integer id PK
    integer level_id FK
    string word_idiom
    integer frequency
    string parse
    string en
    string jp
    string image
    string typical_sentence
    string sentence
    string pronunciation
    string prefix
    string prefix_jp
    string suffix
    string suffix_jp
    string suffix_parse
    string word_root
    string word_usage
}

Level {
    integer id PK
    string level
    string sub_level
    string word_idiom
}

UserWord{
    integer id PK
    integer user_id FK
    integer word_id FK
    integer user_level_id FK
    strig word_lap
    string correct_count
    string practice_count
    string question_mode
}

UserLevel{
    integer id PK
    integer user_id FK
    integer level_id FK
    string level_lap
    string level_status
    string question_mode
    integer question_count
}
```


## 2.Class Diagram(pre)
```mermaid
classDiagram
    class Add {
        addPastFixed()
        addNewWord()
        select()
    }
    class Question {
        fixList()
        wordFixedCount()
        questionList()
        answerList()
    }
```




## 3.Component Diagram (pre)
```mermaid
graph LR
style API_GET_QUESTION_LIST fill:#f9d3a3
style API_GET_ANSWER_LIST fill:#f9d3a3
style API_ADD_PAST_FIXED fill:#f9d3a3
style API_ADD_SELECT fill:#f9d3a3
style API_ADD_NEW_WORD fill:#f9d3a3

style API_GET_FIX_LIST fill:#f9d3a3
style API_GET_WORD_FIXED_LIST fill:#f9d3a3



A[Index] --> B[Word]
A --> C[Idiom]
A --> D[Add]
A --> E[List]
B --> F[WordFixedCount]
C --> G[IdiomFixedCount]

API_GET_QUESTION_LIST[API: /questionList] --> B
API_GET_QUESTION_LIST[API: /questionList] --> C
B --> API_GET_ANSWER_LIST[API: /answerList]
C --> API_GET_ANSWER_LIST[API: /answerList]
API_ADD_PAST_FIXED[API: /addPastFixed] --> D
API_ADD_SELECT[API: /select] --> D
D --> API_ADD_NEW_WORD[API: /addNewWord]
API_GET_FIX_LIST[API: /fixList] --> E
API_GET_WORD_FIXED_LIST[API: /wordFixedCount] --> F
API_GET_WORD_FIXED_LIST[API: /wordFixedCount] --> G
```
## Class Diagram
```mermaid
classDiagram
    class DashBoard {
        getUserWordStats(mode)
        getUserLevelStats(mode)
    }
    class Level{
        getLevelList(mode)
        getUserLevelList(mode)
        getLevelProgress(mode)
        getLevelQuestionCount(mode)
    }
    class Word{
        getWordDetail(mode)
        getInitialKnowledgeCheckList(mode)
    }
    class Question{
        getQuestionList(mode)
        playCorrectIncorrectSound()
    }
    class Answer{
        getAnswerList(mode)
    }
    class Practice{
        getPracticeList(mode)
    }
    class User{
        getUserProfile()
    }


```
## Component Diagram
```mermaid
graph LR
style API_WORD_LEVELS fill:#f9d3a3
style API_USER_WORD_STATS fill:#f9d3a3
style API_USER_LEVEL_STATS fill:#f9d3a3
style API_USER_PROFILE fill:#f9d3a3
style API_USER_WORD_LEVELS fill:#f9d3a3
style API_WORD_LEVEL_PROGRESS fill:#f9d3a3
style API_WORD_DETAIL fill:#f9d3a3
style API_WORD_QUESTIONS fill:#f9d3a3
style API_WORD_ANSWERS fill:#f9d3a3
style API_PLAY_CORRECT_INCORRECT_SOUND fill:#f9d3a3
style API_WORD_PRACTICES fill:#f9d3a3
style API_INITIAL_KNOWLEDGE_CHECK_WORDS fill:#f9d3a3
style API_WORD_LEVEL_QUESTION_COUNT fill:#f9d3a3

A[Index] --> B[Home]
B --> C[WordLevel]
C --> D[WordSubLevel]
B --> E[IdiomLevel]
E --> F[IdiomSubLevel]
B --> G[DashBoardUserWord]
B --> H[DashBoardUserLevel]
B --> I[USAGE]
B --> J[PROFILE]
D --> K[Play]
K --> L[QuestionHeader]
K --> M[QuestionProgressBar]
K --> N[QuestionAndAnswer]
N --> O[Incorrect]
D --> P[Practice]
D --> Q[InitialKnowledgeCheck]
D --> R[LevelProgress]
D --> S[LevelQuestionCount]
F --> K[Play]
F --> P[Practice]
F --> R[LevelProgress]

API_WORD_LEVELS[API: /api/word-levels] --> C
API_WORD_LEVELS[API: /api/word-levels] --> D
API_USER_WORD_STATS[API: /api/user-word-stats] --> G
API_USER_LEVEL_STATS[API: /api/user-level-stats] --> H
API_USER_PROFILE[API: /api/user-profile] --> J
API_USER_WORD_LEVELS[API: /api/user-word-levels] --> D
API_WORD_PRACTICES[API: /api/word-practices] --> P
API_WORD_LEVEL_PROGRESS[API: /api/word-level-progress] --> R
API_WORD_LEVEL_QUESTION_COUNT[API: /api/word-level-question-count] --> S
API_INITIAL_KNOWLEDGE_CHECK_WORDS[API: /api/initial-knowledge-check-words] --> Q
API_WORD_QUESTIONS[API: /api/word-questions] --> N
N --> API_WORD_ANSWERS[API: /api/word-answers]
API_PLAY_CORRECT_INCORRECT_SOUND[API: /api/play-correct-incorrect-sound] --> N
API_WORD_DETAIL[API: /api/word-detail] --> O

```


## 4.State transition Diagram
#### WordLapState
| s(state) |e1:correct|e2:incorrect|e3:clear|
| --- | --- | --- | --- |
|wls0|wls1|wls0||
|wls1|wls2|wls0||
|wls2|wls3|wls0||
|wls3|||wls0|

#### LevelLapState
| s(state) |e3:clear|e4:master|
| --- | --- | --- |
|lls0|lls1||
|lls1|lls2||
|lls2|lls3||
|lls3||ls1(open)|

#### LevelState
| s(state) |e3:clear|e4:open|after one week|
| --- | --- | --- | --- | 
|ls0||ls1||
|ls1|ls1'|||
|ls1'|||ls2|
|ls2|ls2'|||
|ls2'|||ls3|
|ls3|ls4|||


```mermaid
graph TD
  wls0["wls0"] -- e1:correct --> wls1["wls1"]
  wls0 -- e2:incorrect --> wls0
  wls1 -- e1:correct --> wls2["wls2"]
  wls1 -- e2:incorrect --> wls0
  wls2 -- e1:correct --> wls3["wls3"]
  wls2 -- e2:incorrect --> wls0
  wls3 -- e3:clear --> wls0

  lls0["lls0"] -- e3:clear --> lls1["lls1"]
  lls1 -- e3:clear --> lls2["lls2"]
  lls2 -- e3:clear --> lls3["lls3"]

  ls0["ls0"] -- e4:open --> ls1["ls1"]
  ls1["ls1"] -- e3:clear --> ls1'["ls1'"]
  ls1'["ls1'"] -- after one week --> ls2["ls2"]
  ls2["ls2"] -- e3:clear --> ls2'["ls2'"]
  ls2'["ls2'"] -- after one week --> ls3["ls3"]
  ls3["ls3"] -- e3:clear --> ls3'["ls4"]

```
