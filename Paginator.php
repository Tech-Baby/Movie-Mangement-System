<?php

class Paginator{

    private $request_url;
    private $per_page; //limit or the number of results to display per page
    //the current page
    private $page; 
    
    //last page
    //culcuated based on the number of rows found & the number of rows to 
    //display per page: $rows_found/$per_page (number of results to display per page)
    private $last_page; 

    /*will be generated using a for loop
        while(i<$last){
            // 1 2 3
        }

        <a href="path_to_your_script.php&page=1>1</a>
        <a href="path_to_your_script.php&page=2>2</a>
        <a href="path_to_your_script.php&page=3>3</a>
    */

    private $row_found;     
    private $pagination_links; 

    
    public function __construct($rows_found,$per_page){

        $this->rows_found = $rows_found;
        $this->per_page = $per_page;
        $this->last_page = ceil($rows_found/$per_page);
        $this->page = isset($_GET['page']) ?  $_GET['page'] : 1;
        $this->request_url = $this->get_request_path();

    }

    public function get_request_path(){

        return parse_url($_SERVER['REQUEST_URI'])['path'];

    }

    public function create_pagination_links(){

        for($page = 1; $page <= $this->last_page; $page++){


            $is_link_active = "";
            if($this->page == $page){
                $is_link_active = "active";
            }

            $query_strings = $this->get_query_strings();
            unset($query_strings['page']);
            $request_url =  $this->get_request_path()."?".http_build_query($query_strings);;
        
            $this->pagination_links .= $this->create_html_for_pagination_links($page,$request_url,$page,$is_link_active);
        }

    }

    public function create_html_for_pagination_links($page_number,$request_url,$page_value,$is_link_active =''){
       
        return "<li class='page-item ". $is_link_active. "'>
                    <a class = 'page-link'  href='$request_url&page=$page_number' class = 'page-link'>$page_value                        
                    </a>
               </li>";

   } 

   public function get_query_strings(){

        parse_str($_SERVER['QUERY_STRING'],$query_strings);
        return $query_strings;

    }

    public function create_previous(){
        if ($this->page > 1) {
            //Show 'Previous' only if page number is greater than 1,
            $previous_page = $this->page - 1;
            $query_strings = $this->get_query_strings();
            unset($query_strings['page']);
            $request_url = $this->get_request_path()."?".http_build_query($query_strings);
            $this->pagination_links .= $this->create_html_for_pagination_links($previous_page,$request_url,"Previous");
        }
    }

    public function create_next(){

        if($this->last_page != 1){
            if($this->page != 1 && $this->page != $this->last_page){

                $next_page = $this->page + 1;
                $query_strings = $this->get_query_strings();
                unset($query_strings['page']);
                $request_url =  $this->get_request_path()."?".http_build_query($query_strings);
                $this->pagination_links .= $this->create_html_for_pagination_links($next_page,$request_url,"Next");

            }
        }
   }

   public function get_pagination_links(){
	   
        $this->create_previous();
        $this->create_pagination_links();
        $this->create_next();
        
        return $this->pagination_links;

    }

//==================================================================================================
   public function get_offset_and_limit(){

        return "LIMIT ".($this->page - 1) * $this->per_page.",". $this->per_page;

    }



}