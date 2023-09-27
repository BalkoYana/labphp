
<?php
// Асоціативний масив “Підприємство” (Код, назва підприємства;
// кількість співробітників; галузь; адреса). Запит підприємств
// із вказаної галузі, де кількість співробітників в заданих межах [X;Y].
$message = null;
$factory = [
    'code' => null,
    'name' => null,
    'number' => null,
    'branch' => null,
    'address' => null,


];

$factory_1 = [
        [
        'code' => 1,
        'name' => 'P&b',
        'number' => 16,
        'branch' => 'IT',
        'address' => 'street',

        ],
        [
            'code' => 2,
            'name' => 'company',
            'number' => 19,
            'branch' => 'pharmaceutics',
            'address' => null,


],
    [
        'code' => 3,
        'name' => 'P',
        'number' => 168,
        'branch' => 'IT',
        'address' => 'street1',

    ],
    [
        'code' => 4,
        'name' => 'ABC',
        'number' => 17,
        'branch' => 'IT',
        'address' => 'street5',

    ],
    [
        'code' => 5,
        'name' => 'Name of company',
        'number' => 76,
        'branch' => 'pharmaceutics',
        'address' => 'street89',

    ],
];
//--------------------------------------------------------------------------
if(isset($_POST['ecode'])){
    $eKey =null;
    foreach ($factory_1 as $key=>$value){
        if($value['code']==$_POST['ecode']){
            $eKey=$key;
            break;
        }
    }
    if(!is_null($eKey)&&!empty($_POST['ename'])&&!empty($_POST['enumber'])&&!empty($_POST['ebranch'])&&!empty($_POST['eaddress'])&&($_POST['enumber'])>0){
        $factory_1[$eKey]=array_merge($factory_1[$eKey], [
            'name'=>$_POST['ename'] ??'',
            'number'=>$_POST['enumber'] ??'',
            'branch'=>$_POST['ebranch'] ??'',
            'address'=>$_POST['eaddress'] ??'',]);
    }
    else {
        $message=" Not found or something is empty";
    }
}



//----------------------------------------------------------------------------------
if(isset($_POST['code'])){
    $factory_1[]=[
        'code'=>$_POST['code'] ?? '',
        'name'=>$_POST['name'] ??'',
        'number'=>$_POST['number'] ??'',
        'branch'=>$_POST['branch'] ??'',
        'address'=>$_POST['address'] ??'',
    ];
}



$factory_1 =array_filter($factory_1,function ($element){
    $return_flag =true;
    if(isset($_GET['branch'])&& $element!==$_GET['branch']){
        $return_flag=false;
    }
    if($return_flag && isset($_GET['number'])&&$_GET['number']<$element['number']&& $element['number'] <$_GET['number']){
        $return_flag=false;
    }
    return $return_flag;
});
include '/xampp/htdocs/lab1/factory_table.phtml';
include '/xampp/htdocs/lab1/factory_form.phtml';
include '/xampp/htdocs/lab1/edit_form.phtml';

if($message){
    print $message;
}