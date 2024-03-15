<?php
        $dbaction = $_POST['dbaction'];


        //user
        $user_id = $_POST['user_id'];
        $user_name =$_POST['user_name'];
        $user_acc = $_POST['user_acc'];
        $user_pass =$_POST['user_pass'];
        $user_pic = $_POST['user_pic'];
        $user_status =$_POST['user_status'];

        //movie
        $m_id =$_POST['m_id'];
        $m_name =$_POST['m_name'];
        $m_intro =$_POST['m_intro'];
        $m_date =$_POST['m_date'];
        $m_pic =$_POST['m_pic'];

        //drama
        $d_id =$_POST['d_id'];
        $d_name =$_POST['d_name'];
        $d_intro =$_POST['d_intro'];
        $d_date =$_POST['d_date'];
        $d_pic =$_POST['d_pic'];

        //spot
        $s_id =$_POST['s_id'];
        $s_name =$_POST['s_name'];
        $s_intro =$_POST['s_intro'];
        $s_info =$_POST['s_info'];
        $s_pic =$_POST['s_pic'];
        $s_photo =$_POST['s_photo'];
        $s_add =$_POST['s_add'];

        //event
        $e_id =$_POST['e_id'];
        $e_name =$_POST['e_name'];
        $e_start =$_POST['e_start'];
        $e_end =$_POST['e_end'];
        $e_pic =$_POST['e_pic'];
        $e_info =$_POST['e_info'];
        $e_rule =$_POST['e_rule'];
        
        //actor
        $a_id =$_POST['a_id'];
        $a_name =$_POST['a_name'];
        $a_pic =$_POST['a_pic'];

        //genre
        $g_id =$_POST['g_id'];
        $g_name =$_POST['g_name'];

        //record
        $r_id =$_POST['r_id'];
        $r_date =$_POST['r_date'];

        //spotm
        $sm_id =$_POST['sm_id'];

        //spotd
        $sd_id =$_POST['sd_id'];

        //actorm
        $am_id =$_POST['am_id'];

        //actord
        $ad_id =$_POST['ad_id'];

        //genrem
        $gm_id =$_POST['gm_id'];

        //genred
        $gd_id =$_POST['gd_id'];

        
        $link=mysqli_connect('localhost','root','fjuim110','test');


        //新增分類
        if($dbaction=="genre-insert"){
	        $sql  = "insert into genre (g_id, g_name) values ('$g_id','$g_name')";
            if(mysqli_query($link,$sql))
	            {   
                    header("");
	            }
	        else
	            {
	                header("");
	            }
        }
        //新增...
        elseif ($dbaction=="-insert"){
            $sql  = "insert into  values ";
            if(mysqli_query($link,$sql))
	            {
		            header("Location:.php");
	            }
	        else
	            {
	                header(".php?");
	            }
        }
    ?>
