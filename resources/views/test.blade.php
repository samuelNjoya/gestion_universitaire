<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        h1{
            text-align: center
        }
        .all-div{
            display: flex;
            justify-content: space-between
        }

        .all-div > div{
            width: 150px;
            height: 100px;
            border: 2px solid black;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 10px;
        }
    </style>
    <h1>Statistique </h1>
    <div class="all-div">
        <div class="">
            <p>nomber of teacher</p> 
            <b> {{$getNumberAllTeacher}}</b>
        </div>
        <div class="">
            <p>nomber of student</p> 
            <b> {{$getNumberAllStudent}}</b>
        </div>
        <div class="">
            <p>nomber of Department</p> 
            <b> {{$getNumberAllDepartment}}</b>
        </div>
        <div class="">
            <p>nomber of Subject</p> 
            <b> {{$getNumberOfSubject}}</b>
                <div class="part">
                    <span>pratical: {{$getNumberOfSubjectPratical}}</span>
                    <span>Theory: {{$getNumberOfSubjectTheory}}</span>
                </div>                                
        </div>
    </div>
</body>
</html>