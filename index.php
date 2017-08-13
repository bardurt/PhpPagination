<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            ul.pagination {
                display: inline-block;
                padding: 0;
                margin: 0;
            }

            ul.pagination li {display: inline;}

            ul.pagination li a {
                color: #fff;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                    background-color: #444453;
                    box-shadow: 0px 2px 2px #888888;
            }
            .pagination li:first-child a {
                border-top-left-radius: 30px;
                border-bottom-left-radius: 30px;
            }

            .pagination li:last-child a {
                border-top-right-radius: 30px;
                border-bottom-right-radius: 30px;
            }

            ul.pagination li a.active {
                background-color: #c4d8e1;
                color: #000;
                    border-top-left-radius: 0px;
                border-bottom-left-radius: 10px;
                    border-top-right-radius: 10px;
                border-bottom-right-radius: 0px;
                    box-shadow: 0px 5px 5px #888888;
            }

            ul.pagination li a:hover:not(.active) {
                    background-color: #fff;
                    color: #000;
                    padding: 10px 20px;
                    box-shadow: 0px 4px 4px #888888;
            }

            div.center {
                text-align: center;
            }
        </style>
        <title></title>
    </head>
    <body>
       <?php
            require_once 'model.php';
            $models = array();
            
            // fill up an array with test data
            for($i = 0; $i < 100; $i++){
                $model = new Model('fname '. $i, "lname " . $i, "28");
                array_push($models, $model);
            }
       
       
	    $numRows = count($models); // total number of items in array

	    $perPage = 10; // how many elements per page;
			
	    $total_pages = ceil($numRows / $perPage); 
			
            // check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
            if (isset($_GET['page']) && is_numeric($_GET['page'])){
			
		$show_page = $_GET['page'];

		// make sure the $show_page value is valid
		if ($show_page > 0 && $show_page <= $total_pages){
				
                    $start = ($show_page -1) * $perPage;
                    $end = $start + $perPage;
                }else{
				
                    // error - show first set of results
                    $start = 0;
                    $end = $perPage;
		}
            }else{
			
		// if page isn't set, show first set of results
		$start = 0;
		$end = $perPage;
            }
	
            $from = 0;
            
            if($numRows > 0) {
		$from = ($end+1) - ($perPage);
            }
			
            echo "<br>";

            echo '<div class="center"><ul class="pagination">';
					
            $first = 1;
            $firstSet = false;
	
            for ($i = 1; $i <= $total_pages; $i++){
		// makes sure first page is selected at start up
		if($start === 0 && !$firstSet){
                    echo '<li><a class="active" href="index.php?page='.$first.'">'.$first.'</a></li>';
                    $firstSet = true;
                    $i = 2;
		
                    if($i > $total_pages){
			break;
                    }
		}
		
                // echo paging buttons
                if (isset($_GET['page']) && $_GET['page'] == $i){
				
                    echo '<li><a class="active" href="index.php?page='.$i.'">'.$i.'</a></li>';
                }else{
			
                    echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
		}
            }
            
            echo '</ul></div>';
            echo "</p>";

            // create table header
            echo "<center><table>
                    <thead>
			<tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
			</tr>
                    </thead>";

            $counter = 0;
			
            // loop through array and display them in the table
            for ($i = $start; $i < $end; $i++){
			
                // make sure that PHP doesn't try to show results that don't exist
		if ($i == $numRows) { 
                    break; 
                }

                // vary the row color
		if($counter % 2 == 0){
                    echo "<tr bgcolor='#c4d8e1'>";
		}else{
                    echo "<tr bgcolor='#ffffff'>";
		}
                 
                // add content to table body
		echo"<td>";
                echo $models[$i]->getFirstName() . "</td><td>";
                echo $models[$i]->getLastName() . "</td><td>";
                echo $models[$i]->getAge() . "</td><td>";
                  
                $counter++;
            }
            
            echo "</table></center>"; //Close the table in HTML
			
            echo "<br>";
            echo "<center>";
	
            if($end < $numRows){
		echo '<p style="margin-left:10px;">Result: '.$from.' to '.$end.' </p>';
            }else{
		echo '<p style="margin-left:10px;">Result: '.$from. ' to '.$numRows.' </p>';
            }
            
            echo "</center>";
            echo "<br>";
            echo '<div class="center"><ul class="pagination">';
					
            $first = 1;
            $firstSet = false;
			
            for ($i = 1; $i <= $total_pages; $i++){
		// makes sure first page is selected at start up
		if($start === 0 && !$firstSet){
                    echo '<li><a class="active" href="index.php?page='.$first.'">'.$first.'</a></li>';
                    $firstSet = true;
                    $i = 2;
                    
                    if($i > $total_pages){
                        break;
                    }
		}
		
                // echo paging buttons
                if (isset($_GET['page']) && $_GET['page'] == $i){
				
                    echo '<li><a class="active" href="index.php?page='.$i.'">'.$i.'</a></li>';
		}else{	
                    echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
		}
            }
	
            echo '</ul></div>';
            echo "</p>";

	?>
    </body>
</html>
