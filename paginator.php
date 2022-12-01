<?php

require_once 'functions.php';

class Paginator {
  
     private $_conn;
        private $_limit;
        private $_page;
        private $_query;
        private $_total;
  

    public function __construct( $conn, $query ) {
    
        $this->_conn = $conn;
        $this->_query = $query;
        
        $rs= $this->_conn->query( $this->_query );
        $this->_total = $rs->num_rows;
            
    }
    
    public function getData( $limit = 10, $page = 1 ) {
      
        $this->_limit   = $limit;
        $this->_page    = $page;
      
        if ( $this->_limit == 'all' ) {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
        $rs             = $this->_conn->query( $query );
        
        if ($rs->num_rows) {
            while ( $row = $rs->fetch_assoc() ) {
                $results[]  = $row;
            }
        } else {
            echo $rs->num_rows;
            return false;
        }
        
      
        $result         = new stdClass();
        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $results;
      
        return $result;
    }
    
    public function createLinks( $links, $list_class, $user_id , $users, $user_token) {
        if ( $this->_limit == 'all' ) {
            return '';
        }
        $last       = ceil( $this->_total / $this->_limit );
        
        $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
       
        $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
        
        $class      = ( $this->_page == 1 ) ? "disabled" : "";
        
        $html   = '<li class="page-link"><a class="'.$class.'" href="?limit=' . $this->_limit . '&page=1'. '&user_id=' . $user_id . '&users=' . $users .  '&user_token='.$user_token.' aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
        
        if ( $start > 1 ) {
            $html  .= '<li class="page-link"><a class="" href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '&user_id=' . $user_id . '&users=' . $users . '&user_token=' . $user_token . ' aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';        
        }
      
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $this->_page == $i ) ? "active" : "";
            $html   .= '<li class="page-link"><a class="'.$class.'" href="?limit=' . $this->_limit . '&page=' . $i . '&user_id=' . $user_id . '&users=' . $users .  '&user_token=' . $user_token . ' ">' . $i . '</a></li>';
            
        }
      
        if ( $end < $last ) {
            $html   .= '<li><a class='.$class.' href="?limit=' . $this->_limit . '&page=' . $last . '&user_id=' . $user_id . '&users=' . $users . '&user_token=' . $user_token . '">' . $last . '</a></li>';
        }
      
        $class      = ( $this->_page == $last ) ? "disabled" : "";
        $html      .= '<li class="page-link"><a class="'.$class.'" href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '&user_id=' . $user_id . '&users=' . $users . '&user_token=' . $user_token . ' aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
        
      
        return $html;
    }
}


?>