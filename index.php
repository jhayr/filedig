<?php
ob_start(); 
/**
  * Software information
  * Software name: filedig
  * Version: 1.1
  * Author: jhay eng
  * email: sprongky2@gmail.com
  * License Type : GNU
*/
function create_slug1($string){
 $cat1=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
return $cat1;
  }
?>
<html>
<head>
	
	<?php include_once('templates/stylesheets.php'); ?>
   <title><?php echo $sitename; ?></title>
</head>
<body>
		<div class="container clearfix">
			<!--header-->
				<?php include_once('templates/header.php'); ?>
					<!--header-->
					<div class="main-body">

							<div id="leftContent">

												<div class="widget white_box"><h3 class="widget_title">Recent Updates</h3>
                                                           <ul>
                                                            <?php 
                                                           
                                                            	$popular="SELECT * FROM softwares ORDER BY date DESC LIMIT 5";
                                                            	$spopular=mysql_query($popular);
                                                            	while ($row=mysql_fetch_array($spopular)) {

                                                            		$softid=$row['id'];
                                                            		$title=$row['title'];
                                                                  $slug=$row['slug'];
                                                            		   $check_pic = "admin/images/icons/".$softid."/image01.jpg";
                  
                                                                   if (file_exists($check_pic)) {
                                                                        $icon = "<img src=\"$check_pic\" class=\"home_icon\"    />"; 
                                                                      } else {
                                                                      $icon = "<i class=\"icon-archive\"></i>"; 
                                                                      }



                                                                                 if($seourls==1){
                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/'.$softid.'/'.$slug.'\'>'.$title.'</a></li>';
                                                                                   }else{

                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/software-profile.php?pid='.$softid.'\'>'.$title.'</a></li>';
                                                                            }    

                                                                }


                                                            ?>
                                                        </ul>
												</div>

												<div class="widget white_box">
													<h3 class="widget_title">Popular Softwares</h3>
													
                                                            <ul>
                                                              <?php 
                                                            	
                                                            	$popular="SELECT * FROM softwares ORDER BY views DESC LIMIT 5";
                                                            	$spopular=mysql_query($popular);
                                                            	while ($row=mysql_fetch_array($spopular)) {

                                                            	$softid=$row['id'];
                                                            		$title=$row['title'];
                                                                  $slug=$row['slug'];
                                                                     $check_pic = "admin/images/icons/".$softid."/image01.jpg";
                  
                                                                      if (file_exists($check_pic)) {
                                                                        $icon = "<img src=\"$check_pic\" class=\"home_icon\"    />"; 
                                                                      } else {
                                                                      $icon = "<i class=\"icon-archive\"></i>"; 
                                                                      }


                                                                                 if($seourls==1){
                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/'.$softid.'/'.$slug.'\'>'.$title.'</a></li>';
                                                                                   }else{

                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/software-profile.php?pid='.$softid.'\'>'.$title.'</a></li>';
                                                                            }
                                                            		    	}

                                                            ?>
                                                        </ul>
                                                	</div>
<?php

/*Inpage Ad*/
    $query = "SELECT *
            FROM ads
            WHERE id = 1 AND status= 1";
$result = mysql_query($query);

while($data = mysql_fetch_assoc($result)){

     
      $code=$data['code'];
      $code = base64_decode($code);
 echo $code;
    

}

?>
<br><br>

                                                        <?php 
                                                        
                                                                $cateq="SELECT * FROM softwares A INNER JOIN categories B ON A.catid=B.cID ORDER BY name"; 
                                                                $cateresult=mysql_query($cateq);



                                                                    define('MAX_TITLES_PER_CAT',5);

                                                                        $cat='';
                                                                        $tcount=0;

                                                                while ($row =mysql_fetch_array($cateresult)){
                                                                       $title=$row['title'];
                                                                       $softid=$row['id'];
                                                                       $cateid=$row['cid'];
                                                                       $slug=$row['slug'];

                                                                            $check_pic = "admin/images/icons/".$softid."/image01.jpg";
                  
                                                                      if (file_exists($check_pic)) {
                                                                        $icon = "<img src=\"$check_pic\" class=\"home_icon\"    />"; 
                                                                      } else {
                                                                      $icon = "<i class=\"icon-archive\"></i>"; 
                                                                      }
                                                                    
                                                                   if ($row['name']!=$cat) {
                                                                              

                                                                              if ($cat!='') echo '</div>';
                                                                              $cat=$row['name'];
                                                                              
                                                                              $tcount=MAX_TITLES_PER_CAT;

                                                                                     if($seourls==1){
                                                                                        
                                                                                        $cat1=create_slug1($cat);
                                                                                        echo "<div class=\"widget white_box\"><h3 class=\"widget_title\"><a href=\"$baseUrl/1/$cateid/$cat1\">".$cat." <i class=\"icon-chevron-right\"></i></a></h3><ul>";

                                                                                      }else{
                                                                                        echo "<div class=\"widget white_box\"><h3 class=\"widget_title\"><a href=\"$baseUrl/browse.php?page=1&bid=$cateid&cat=$cat\">".$cat." <i class=\"icon-chevron-right\"></i></a></h3><ul>";
                                                                                      }
                                                                            }
                  
                                                                          
                                                            if ($tcount--<=0) continue;

                                                                                 if($seourls==1){
                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/'.$softid.'/'.$slug.'\'>'.$title.'</a></li>';
                                                                                   }else{

                                                                             echo '<li>'.$icon.' <a href=\''.$baseUrl.'/software-profile.php?pid='.$softid.'\'>'.$title.'</a></li>';
                                                                            }

                                                                }  
                                                                  if ($cat!='') echo '</ul></div>';


 




                                                         ?>



												<div class="clear"></div>
							</div>
							<div id="sidebar">
                <?php include_once('templates/sidebar.php') ?>
<div class="clear"></div>
							</div>
							<div class="clear"></div>
					</div>
					<?php include_once('templates/footer.php') ?>
		</div>


</body>
</html>
