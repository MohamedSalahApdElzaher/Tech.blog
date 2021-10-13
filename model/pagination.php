<?php

class Pagination {

    private $curr_page;
    private $prev_page;
    private $total_count;

    function __construct($page=1, $perv_page=20, $total_count=0){
        $this->curr_page=$page;
        $this->prev_page=$perv_page;
        $this->total_count=$total_count;
    }

    function offest(){
        return $this->prev_page * ($this->curr_page-1);
    }
    
    function total_pages(){
        return ceil($this->total_count / $this->prev_page);
    }

    function next_page(){
        $next = $this->curr_page+1;
        return $next <= $this->total_pages() ? $next : false;
    }

    function prev_page(){
        $prev = $this->prev_page-1;
        return $prev > 0 ? $prev : false;
    }

    function prev_link($url=""){
        $link="";
        if($this->prev_page()!=false){
            $link .= "<>a href=\"{$url}?page={$this->prev_page()}\">";
            $link .= "&laquo; previous<\a>";
        }
        return $link;
    }

    function next_link($url=""){
        $link="";
        if($this->next_page()!=false){
            $link .= "<>a href=\"{$url}?page={$this->next_page()}\">";
            $link .= "Next &laquo;<\a>";
        }
        return $link;
    }


}