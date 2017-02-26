<?php
    include 'simple_html_dom.php';
    $baseurl = "http://new.sunyconnect.suny.edu:4430/F";
    $uri = $_SERVER['REQUEST_URI'];
    $url = "$baseurl/$uri";
 

$html = file_get_html($url);

$rows = $html->find('[class="td1"]');
  foreach($rows as $row) {
   $rowo[] = $row->plaintext;
  
}

foreach($rowo as $row)
{   
    
    $autdor= array($rowo[3],$rowo[3+9],$rowo[3+2*9],$rowo[3+3*9],$rowo[3+4*9],$rowo[3+5*9],$rowo[3+6*9],$rowo[3+7*9],$rowo[3+8*9],$rowo[3+9*9]); 
    $book=array($rowo[4],$rowo[4+9],$rowo[4+2*9],$rowo[4+3*9],$rowo[4+4*9],$rowo[4+5*9],$rowo[4+6*9],$rowo[4+7*9],$rowo[4+8*9],$rowo[4+9*9]); 
    $year=array($rowo[5],$rowo[5+9],$rowo[5+2*9],$rowo[5+3*9],$rowo[5+4*9],$rowo[5+5*9],$rowo[5+6*9],$rowo[5+7*9],$rowo[5+8*9],$rowo[5+9*9]); 
    $callNo=array($rowo[6],$rowo[6+9],$rowo[6+2*9],$rowo[6+3*9],$rowo[6+4*9],$rowo[6+5*9],$rowo[6+6*9],$rowo[6+7*9],$rowo[6+8*9],$rowo[6+9*9]); 
    $copies=array($rowo[7],$rowo[7+9],$rowo[7+2*9],$rowo[7+3*9],$rowo[7+4*9],$rowo[7+5*9],$rowo[7+6*9],$rowo[7+7*9],$rowo[7+8*9],$rowo[7+9*9]); 
    
}


/* This loop only get the part of every slab in array before '/' */
foreach($book as $bk) {
     $trim=substr($bk, 0, strpos($bk, '/'));
     $temp[] = $trim;
     $book = array_replace($book,$temp);
}

?>

<html>
    <head>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h2>Search Results</h2>
            <p style= "width:100%;word-wrap: break-word;">This page get the result from <?=$url?></p> 
            <table class="table table-responsive table-bordered">
             <tr>
                    <th> # </th>
                    <th>book</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Call #</th>
                    <th>Copies Own/Out</th>
                    <th>Click to view </th>
            </tr>
            <tr>
                    <td> 1 </td>
                    <td><?=$book[0]?></td>
                    <td><?=$autdor[0]?></td>
                    <td><?=$year[0]?></td>
                    <td><?=$callNo[0]?></td>
                    <td><?=$copies[0]?></td>
                    <td><input type="radio" name="chooseBook" value="0"></td>
            </tr>
            
                        <tr>
                    <td> 2 </td>
                    <td><?=$book[1]?></td>
                    <td><?=$autdor[1]?></td>
                    <td><?=$year[1]?></td>
                    <td><?=$callNo[1]?></td>
                    <td><?=$copies[1]?></td>
                    <td><input type="radio" name="chooseBook" value="1"></td>
            </tr>
            
              <tr>
                    <td> 3 </td>
                    <td><?=$book[2]?></td>
                    <td><?=$autdor[2]?></td>
                    <td><?=$year[2]?></td>
                    <td><?=$callNo[2]?></td>
                    <td><?=$copies[2]?></td>
                    <td><input type="radio" name="chooseBook" value="2"></td>
            </tr>
            
            <tr>
                    <td> 4 </td>
                    <td><?=$book[3]?></td>
                    <td><?=$autdor[3]?></td>
                    <td><?=$year[3]?></td>
                    <td><?=$callNo[3]?></td>
                    <td><?=$copies[3]?></td>
                    <td><input type="radio" name="chooseBook" value="3"></td>
            </tr>
            
             <tr>
                    <td> 5 </td>
                    <td><?=$book[4]?></td>
                    <td><?=$autdor[4]?></td>
                    <td><?=$year[4]?></td>
                    <td><?=$callNo[4]?></td>
                    <td><?=$copies[4]?></td>
                    <td><input type="radio" name="chooseBook" value="4"></td>
            </tr>
            
              <tr>
                    <td> 6 </td>
                    <td><?=$book[5]?></td>
                    <td><?=$autdor[5]?></td>
                    <td><?=$year[5]?></td>
                    <td><?=$callNo[5]?></td>
                    <td><?=$copies[5]?></td>
                    <td><input type="radio" name="chooseBook" value="5"></td>
            </tr>
            
             <tr>
                    <td> 7 </td>
                    <td><?=$book[6]?></td>
                    <td><?=$autdor[6]?></td>
                    <td><?=$year[6]?></td>
                    <td><?=$callNo[6]?></td>
                    <td><?=$copies[6]?></td>
                    <td><input type="radio" name="chooseBook" value="6"></td>
            </tr>
            
            
              <tr>
                    <td> 8 </td>
                    <td><?=$book[7]?></td>
                    <td><?=$autdor[7]?></td>
                    <td><?=$year[7]?></td>
                    <td><?=$callNo[7]?></td>
                    <td><?=$copies[7]?></td>
                    <td><input type="radio" name="chooseBook" value="7"></td>
            </tr>
            
              <tr>
                    <td> 9 </td>
                    <td><?=$book[8]?></td>
                    <td><?=$autdor[8]?></td>
                    <td><?=$year[8]?></td>
                    <td><?=$callNo[8]?></td>
                    <td><?=$copies[8]?></td>
                    <td><input type="radio" name="chooseBook" value="8"></td>
            </tr>
          
             <tr>
                    <td> 10 </td>
                    <td><?=$book[9]?></td>
                    <td><?=$autdor[9]?></td>
                    <td><?=$year[9]?></td>
                    <td><?=$callNo[9]?></td>
                    <td><?=$copies[9]?></td>
                    <td><input type="radio" name="chooseBook" value="9"></td>
            </tr>
       

                
</table>

           <div style="text-align:right;" >
         <input type="button" name="submit" onclick="  " value="Submit">
     
    </body>
    
    
</html>


