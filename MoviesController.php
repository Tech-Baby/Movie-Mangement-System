<?php
include_once "Crud.php";
include_once "Paginator.php";

class MoviesController{

    private $crud;

    public $pagination_links;

    public function __construct(){

       $this->crud = new Crud(); 
     
    }
    
   public function addMovie(){

        $movie_data = [
            'mv_title' => $_POST['mv_title'],
            'mv_year_released' => $_POST['mv_year_released'],
        ];

        
        $movie_genres = isset($_POST['genres']) ? $_POST['genres'] : "";

        $validation_rules = [
            'mv_title' => 'required',
            'mv_year_released' => 'date',
            'genres'=>'required'
        ];

       // var_dump($movie_genres); die();
        $validation_data = $movie_data + ['genres' => $movie_genres];
        
        $validator = new Validator($validation_data,$validation_rules);
        $validator->validate();

        if($validator->passes()){

            $movie_id = $this->crud->create($movie_data,'movies');
            $this->createMovieGenres($movie_genres,$movie_id);  
        
            $this->saveAndUploadCoverImage($movie_id);  
            
            Session::set('success-message', 'Movie Added Successfully!');        
            
    
            header('Location: list-movies.php');
        }
     

   }

   public function createMovieGenres($movie_genres,$movie_id){
   
        foreach($movie_genres as $key => $genre_id){

            $movie_genres = $this->crud->read("SELECT * from mv_genres where mvg_ref_movie = $movie_id and mvg_ref_genre = $genre_id");
            if(empty($movie_genres)){
                $movie_genres_arr = [

                    'mvg_ref_genre' => $genre_id,
                    'mvg_ref_movie' => $movie_id
                ];

                $this->crud->create($movie_genres_arr,'mv_genres');
            }
            
        }
   }

   public function getMovies($per_page = 10,$search_condition = ''){

       $query = "SELECT mv_id, mv_title,img_path, gnr_name, GROUP_CONCAT(gnr_name) genres,mv_year_released
                    FROM movies
                    LEFT JOIN mv_genres on mvg_ref_movie = mv_id
                    LEFT JOIN genres on mvg_ref_genre = gnr_id
                    LEFT JOIN images on img_ref_movie = mv_id";

       if(!empty($search_condition)) $query .= " $search_condition";

       $query .=    " GROUP BY mv_id
                    ORDER BY mv_id DESC";

        $rows_found = count($this->crud->read($query));

        $paginator = new Paginator($rows_found,$per_page);

        $offset_and_limit =  $paginator->get_offset_and_limit();

        $query .= " ".$offset_and_limit;

        $results = $this->crud->read($query);

        $this->pagination_links = $paginator->get_pagination_links();

        return  $results;

   }

   public function searchMovies($per_page,$search_item){
     
      $search_condition = $this->constructSearchCondition($search_item);


       return $this->getMovies($per_page,$search_condition);
    


   }

   public function constructSearchCondition($search_item){

        $search_item_arr = explode(' ',$search_item);

        $j = 0;
        
        foreach($search_item_arr as $item){

            $j++;

            if($j == 1){
                $search_condition = " WHERE mv_title LIKE '%$item%'";
            }else if($item != ""){
                $search_condition .= " OR mv_title LIKE '%$item%'";
            }
        }
        
      return $search_condition;        
        

   }



   public function getMovie($mv_id){

        $query = "SELECT mv_id, mv_title,img_path, gnr_name, GROUP_CONCAT(gnr_name) genres,mv_year_released
                    FROM movies
                    LEFT JOIN mv_genres on mvg_ref_movie = mv_id
                    LEFT JOIN genres on mvg_ref_genre = gnr_id
                    LEFT JOIN images on img_ref_movie = mv_id
                    WHERE mv_id = $mv_id
                    GROUP BY mv_id
                    ORDER BY mv_id DESC";

    
        $results = $this->crud->read($query);
        return  $results;

}

   public function saveAndUploadCoverImage($movie_id){

        $dir = "../images/movie_covers/movie_$movie_id";
        if ( !file_exists($dir) ) {
            mkdir ($dir, 0777,true);
        }

        $dir = $dir."/".basename($_FILES["cover_image"]["name"]);

        move_uploaded_file($_FILES["cover_image"]["tmp_name"],$dir);

        $image_info = [
            'img_path' => str_replace('../','',$dir),
            'img_ref_movie' => $movie_id            
        ];

        $this->crud->create($image_info, 'images');

   }

    public function editMovie($movie_id){
            
        $year_released = $_POST['mv_year_released'];
        $mv_title = $_POST['mv_title'];

        $sql = "UPDATE movies 
                set mv_year_released = '$year_released', mv_title = '$mv_title'
                WHERE mv_id = $movie_id";
    

       $this->crud->update($sql);

       $this->createMovieGenres($_POST['genres'], $movie_id);

        //if the genres is deselected from the select box, remove it from the database.
        $this->deleteDeselectedGenres($movie_id);

        //update movie image       
        if(!empty($_FILES["cover_image"]['name'])){

            //delete previous image
            $this->crud->delete("delete from images where img_ref_movie = $movie_id");
            $this->saveAndUploadCoverImage($movie_id);           

        }

        Session::set('success-message', 'Movie updated Successfully!');        
        

        header('Location: list-movies.php');

    }

    public function deleteDeselectedGenres($movie_id){
     
        $movie_genres = $this->crud->read("SELECT * from mv_genres where mvg_ref_movie = $movie_id");
        
        //if the genres has been deselected from the select box, remove it from the database
        foreach($movie_genres as $key => $movie_genre){

                $genre_id = $movie_genre['mvg_ref_genre'];
                if(!in_array( $genre_id,$_POST['genres']))
                $this->crud->delete("delete from mv_genres where mvg_ref_genre =  $genre_id");
        }       

    }

    public function deleteMovie($movie_id){

        $this->crud->delete("DELETE FROM movies where mv_id = $movie_id");

        Session::set('success-message','Movie deleted successfully!');

        header('Location: list-movies.php');
        exit();
    }
}