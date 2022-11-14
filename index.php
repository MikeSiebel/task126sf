<?php

//Задание №1.1
//Принимает как аргумент три строки — фамилию, имя и отчество. 
//Возвращает как результат их же, но склеенные через пробел
$str1 = 'Иванов';
$str2 = 'Иван';
$str3 = 'Иванович';

function getFullnameFromParts ($str1, $str2, $str3) {
    $sum = $str1 ." ". $str2 ." ". $str3;
    return $sum;
}
echo 'Задание №1.'.'</br>'.'</br>'.'1.1 Функция принимает как аргумент три строки — фамилию, имя и отчество.'.'</br>'.'Возвращает как результат их же, но склеенные через пробел:' .'</br>'.'</br>';
echo getFullnameFromParts($str1, $str2, $str3).'</br>'.'</br>'.'</br>';


//Задание №1.2
//Принимает как аргумент одну строку — склеенное ФИО. 
//Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’
$str4 = 'Иванов Иван Иванович';
function getPartsFromFullname ($str4) {
    $arr1 = explode(' ', $str4);
    $keys = ['surname', 'name', 'patronomyc'];
    $arr2 = array_combine ($keys, $arr1);
    return $arr2;
}

echo '1.2 Функция принимает как аргумент одну строку — склеенное ФИО.'.'</br>'.'Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’:' .'</br>'.'</br>';
echo '<pre>';
print_r(getPartsFromFullname($str4));
echo '</pre>.'."<hr>";


//Задание №2
//Принимает как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», 
//где сокращается фамилия и отбрасывается отчество
$fullName = 'Иванов Иван Иванович';
function getShortName($fullName){
    $nameParts = getPartsFromFullname($fullName);
    return $nameParts['surname']." ".mb_substr($nameParts['name'], 0, 1).".";
}
echo 'Задание №2.'.'</br>'.'</br>'.' Функция принимает как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович»'.'</br>'.'Возвращает как результат строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество:' .'</br>'.'</br>';
echo getShortName($fullName)."<hr>".'</br>';


//Задание №3
//Принимает как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович») и возвращает пол
$fullName = 'Иванов Иван Иванович';
function getGenderFromName ($fullName) {
    $arr3 = explode(' ',$fullName);
    $postpos1 = mb_substr($arr3[0], -2);
    $postpos2 = mb_substr($arr3[1], -1);
    $postpos3 = mb_substr($arr3[2], -3);
    $gender = 0;
    $genFemalePat = 'вна';
    $genFemaleNam = 'а';
    $genFemaleSur = 'ва';
    $genMalePat = 'ич';
    $genMaleNam = 'й'||'н';
    $genMaleSur = 'в'; 
    if ($genMaleSur == $postpos1) $gender++;
    if ($genMaleNam == $postpos2) $gender++;
    if ($genMalePat == $postpos3) $gender++;
    if ($genFemaleSur == $postpos1) $gender--;
    if ($genFemaleNam == $postpos2) $gender--;
    if ($genFemalePat == $postpos3) $gender--;
    $result = ($gender <=> 0);
    if ($result == 1){
        return "мужской пол";
    }elseif ($result == -1){
        return "женский пол";
    }elseif ($result == 0){
        return "пол не определен";
    }
}
echo 'Задание №3.'.'</br>'.'</br>'.' Функция принимает как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович») и возвращает пол:'.'</br>'.'</br>'.'</br>';
echo getGenderFromName ($fullName)."<hr>".'</br>';

//Задание №4
/*Определение полового состава аудитории. Как аргумент в функцию передается массив.Как результат функции возвращается информация в следующем виде
Гендерный состав аудитории:
---------------------------
Мужчины - 55.5%
Женщины - 35.5%
Не удалось определить - 10.0% */
include 'array.php';
function getGenderDescription ($example_persons_array){
   $arr = array_column($example_persons_array, 'fullname');
   $arr2 = array_map('getGenderFromName', $arr);
   $count = count($arr2);
   $man = 0;
   $wooman = 0;
   $undefined = 0;
   $manStr = "мужской пол";
   $woomanStr = "женский пол";
   $undefinedStr = "пол не определен";
   foreach ($arr2 as $val) { 
    if ($manStr == $val) $man ++;
    if ($woomanStr == $val) $wooman ++;
    if ($undefinedStr == $val) $undefined ++;
   }
   $percMan = (round (($man / $count) * 100));
   $percWooman = (round (($wooman / $count) * 100));
   $percuUdefined = (round (($undefined / $count) * 100));
   
   echo "Гендерный состав аудитории:".'</br>';
   echo '</br>';
   echo "Мужчины - $percMan %".'</br>';
   echo "Женщины - $percWooman %".'</br>';
   echo "Не удалось определить - $percuUdefined %".'</br>';
}

echo 'Задание №4.'.'</br>'.'</br>'.'Определение полового состава аудитории' .'</br>'. 'Как аргумент в функцию передается массив. Как результат функции возвращается информация о гендерном составе:'.'</br>'.'</br>'.'</br>';
echo getGenderDescription ($example_persons_array)."<hr>".'</br>';

//Задание №5
//Определение «идеальной» пары. Как первые три аргумента в функцию передаются строки с фамилией, именем и отчеством (именно в этом порядке). При этом регистр может быть любым: ИВАНОВ ИВАН ИВАНОВИЧ, ИваНов Иван иванович. Как четвертый аргумент в функцию передается массив
include 'array.php';
function  getPerfectPartner($surname, $name, $middlename, $auditory){
    $normalisedName =  getFullnameFromParts(mb_convert_case($surname, MB_CASE_TITLE),mb_convert_case($name, MB_CASE_TITLE),mb_convert_case($middlename, MB_CASE_TITLE)); 
    $curGender=getGenderFromName($normalisedName);
    $pairPerson=null;
    do{
        $pairPerson = $auditory[rand(0,count($auditory)-1)];
        if(getGenderFromName($pairPerson['fullname'])==$curGender) $pairPerson=null;
    } while($pairPerson==null);
    echo getShortName($normalisedName).'+'.getShortName($pairPerson['fullname']).'='.'<br>';
    echo "♡ Идеально на ".rand(50,100)."% ♡"."<hr>".'<br>';;
}
echo 'Задание №5.'.'</br>'.'</br>'.'Определение «идеальной» пары' .'</br>'. 'Как первые три аргумента в функцию передаются строки с фамилией, именем и отчеством, при этом регистр может быть любым. Как четвертый аргумент в функцию передается массив'.'</br>'.'</br>'.'</br>';
getPerfectPartner("СИдороВ","пеТр","ивановИЧ",$example_persons_array);

?>