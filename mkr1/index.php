

<?php
// ) На сервері зберігається список Предметів (Id, Назва, Викладач,
//Кількість балів). Розробити Web сторінку, для редагування даних
//предмету із вказаним Id та сторінку для перегляду всього списку
//предметів.
$message = null;
$subject = [
    'id' => null,
    'name' => null,
    'teacher' => null,
    'number' => null,


];
$subject_1 =[
    [ 'id' => 1,
        'name' => 'it',
        'number' => 16,
        'teacher' => 'teacher1',
        ],
    [ 'id' => 2,
        'name' => 'math',
        'number' => 10,
        'teacher' => 'teacher2',
    ],
    [ 'id' => 3,
        'name' => 'math',
        'number' => 11,
        'teacher' => 'teacher3',
    ],
];




//--------------------------------------------------------------------------
if(isset($_POST['eid'])){
    $eKey =null;
    foreach ($subject_1 as $key=>$value){
        if($value['id']==$_POST['eid']){
            $eKey=$key;
            break;
        }
    }
    if(!is_null($eKey)&&!empty($_POST['ename'])&&!empty($_POST['eteacher'])&&!empty($_POST['enumber'])&&($_POST['enumber'])>0){
        $subject_1[$eKey]=array_merge($subject_1[$eKey], [
            'name'=>$_POST['ename'] ??'',
            'teacher'=>$_POST['eteacher'] ??'',
            'number'=>$_POST['enumber'] ??'',]);
    }
    else {
        $message=" Not found or something is empty";
    }
}



//----------------------------------------------------------------------------------
if(isset($_POST['id'])){
    $subject_1[]=[
        'id'=>$_POST['id'] ?? '',
        'name'=>$_POST['name'] ??'',
        'teacher'=>$_POST['teacher'] ??'',
        'number'=>$_POST['number'] ??'',
    ];
}





include '/xampp/htdocs/mkr1/subject_table.phtml';
include '/xampp/htdocs/mkr1/subject_form.phtml';
include '/xampp/htdocs/mkr1/edit_form.phtml';

if($message){
    print $message;
}

///////
$file = fopen('file1.csv','w');
$array = serialize($subject_1);
fwrite($file,$array);
fclose($file);

$file2=fopen("file1.csv","r");
$downloaded =file_get_contents("file1.csv",true);
$array2 =unserialize($downloaded);
fclose($file2);
$subject_1 = $array2;





?>


