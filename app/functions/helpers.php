<?php
use Illuminate\Support\Str;


function checker_slug($name, $results, $old_slug = null){
        // To check whether  
      $q_count = count($results);
      $count=1;

      if($q_count > 0){
        
            foreach ($results as $key => $result) {

            if($q_count > 0  && $key == 0 &&  $old_slug != null ){

                $name;

            }else{

                $slug_name = $name."-".$count++;
            }
            // convert to slug
            $new_slug = Str::slug($slug_name,'-');

            if($new_slug == $old_slug){
                
                break;
            }

            }

            return $new_slug;

      }else{

            $new_slug =  Str::slug($name);
            return $new_slug;

      }

    }


    function checker_slug_job_title($name, $results, $old_slug = null){
        // To check whether  
      $q_count = count($results);
      $count=1;

      if($q_count > 0){
        
            foreach ($results as $key => $result) {

            if($q_count > 0  && $key == 0 &&  $old_slug != null ){

                $slug_name = $result['job_title'];

            }else{

                $slug_name = $result['job_title']."-".$count++;
            }
            // convert to slug
            $new_slug = Str::slug($slug_name,'-');

            if($new_slug == $old_slug){
                break;
            }

            }

            return $new_slug;

      }else{

            $new_slug =  Str::slug($name);
            return $new_slug;

      }

    }


    function strip_html_tags($words){

        $str = trim(strip_tags(html_entity_decode($words)));
        return $str;
    
    }

    function filterIdsObj($obj, $sub){

        $ids = [];
    
        $ids[] = $obj->id;
    
        foreach($obj->$sub as $row){
            $ids[] = $row->id;
        }
    
        return $ids;
    }

    function strwords($words, $limt){

        $str = trim(strip_tags(html_entity_decode($words)));
    
        if(strlen($str) > $limt){
    
          $str = substr($str,0,$limt)." ...";
    
        }
    
        return $str;
    
    }
    
    
    function blog_date_format($date){
    
      return date("F d Y", strtotime($date));
    
    }

    function filterIds($obj, $sub)
    {

        $ids = [];

        foreach ($obj as $id) {
            $ids[] = $id->id;
            foreach ($id->$sub as $row) {
                $ids[] = $row->id;
            }
        }

        return $ids;
    }