<?php
    $con= mysqli_connect("localhost","root","","march17");
    date_default_timezone_set('Asia/Dhaka');
    
    if(isset($_GET['ym'])){
        $ym=$_GET['ym'];
    }else{
        $ym=date('Y-m');
    }

    $timestamp=strtotime($ym,"-01");
    if($timestamp==false){
    $timestamp = time();
    }
    $today=date('Y-m-d',time());
    $calendartitle=date('Y/m',$timestamp);
    


    $prev=date('Y-m',mktime(0,0,0,date('m',$timestamp)-1,1,date('Y',$timestamp)));
    $next=date('Y-m',mktime(0,0,0,date('m',$timestamp)+1,1,date('Y',$timestamp)));
    $day_count=date('t',$timestamp);

    $str=date('w',mktime(0,0,0,date('m',$timestamp),1,date('Y',$timestamp)));

    $weeks=array();
    $week="";
    $week.=str_repeat('<td></td>',$str);
    
    //todays date
    $todays=date('d', strtotime($today));



    


  

    for($day=1 ; $day <=$day_count ; $day++,$str++){
        
            //if($day==$mydate[2]){
            
          // $week.='<td class="today">'.$day;  
              
            //}else if($day==$mydate[3]){
           //$week.='<td class="today">'.$day;  
              
            //}else{
                 $week.='<td>'.$day.'</td>';
            //}

			
        if($str % 7==6 || $day==$day_count){
            if($day==$day_count){
                $week.=str_repeat('<td class="empty"></td>',6-($str % 7));
            }
        $weeks[]='<tr>'.$week.'</tr>';
       $week='';
        }
    }

 

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
    <style>
        font-family: 'Noto Serif', serif;
        th{
            text-align: center;
            margin: 30px;
            font-weight: 700
        }
        td:nth-of-type(6){
            color: firebrick;
        }
        td{
            height: 100px
        }
        .today{
            background-color: cornflowerblue
        }
        
        td:hover{
            background-color: dimgray;
            color: aliceblue
        }
        
        
    </style>
</head>
<body>
<!--    <div class="container">-->
        <table class="table table-bordered">
            <h3><a href="?ym=<?php echo $prev;?>">&lt;</a> <?php echo $calendartitle;?> <a href="?ym=<?php echo $next;?>">&gt;</a></h3>
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            
                 <?php 
                foreach($weeks as $week){
                    echo $week;
                }
            ?>
            
        </table>
        
<!--    </div>-->
</body>
</html>


