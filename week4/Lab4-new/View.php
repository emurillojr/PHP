<!--
Ernesto Murillo Lab 4 php assignment
View php page updated to show all 
this page will show the user all the corporations listed / data
added drop box with selection and search box.

-->
 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <h1>Corporation Data</h1>
    <body>
       
        <?php
        // include dbconnect, function, variables.
        include './functions/dbconnect.php';
        include './functions/functions.php';
        $results = getAllData();
       



        // linking action to action
        $action = filter_input(INPUT_GET, 'action');

        // if to pull for Sort submit button
        // if to pull for Search submit button
        if ($action === 'Search') {

            $searchWord = filter_input(INPUT_GET, 'searchWord');
            $column = filter_input(INPUT_GET, 'column');

            $results = searchAllbySelect($column, $searchWord);
           // ADDED COUNT AND DISPLAY RESULTS
            if (Count($results)>=1){
                echo Count($results) . "   Results Found";
                }
            else{
                echo "  No results found";
            
            }
        }
        
 
    ?>
        
        <?php
        // if to pull for Sort submit button
        if ($action === 'Sort') {
            // get and  link name and value of ASC button 
            
            
         // UPDATED
                if (filter_input(INPUT_GET,'sort') == 'ASC') {
                    // function to get columns, order by ASC, and produce results
                    $column = filter_input(INPUT_GET, 'column');
                    $order = 'ASC';
                    $results = sortorder($column, $order);
                    // get and  link name and value of DESC button     
                } elseif (filter_input(INPUT_GET,'sort') == 'DESC') {
                    // function to get columns, order by DESC, and produce results
                    $column = filter_input(INPUT_GET, 'column');
                    $order = 'DESC';
                    $results = sortorder($column, $order);
                   
                }
              // ADDED COUNT AND DISPLAY RESULTS
                if (Count($results)>=1){
                echo Count($results) . "   Results Found";
                }
                else{
                echo "  No results found";
            
            }
                 
            
            
        }
      
        

        // include the forms 
        include './includes/searchDropbox.php';
        include './includes/SortADradio.php';
        ?>
       
        <!-- link button to go back to beginning original display page / order -->
        <br>
        <br>
        <a class="btn btn-info" href="View.php">Home</a>
        <!-- Created table to display all the data by title -->
        <table class="table table-striped"><!-- Created table to display all the data by title -->

            <thead>
                <tr>
                    <th>ID Number: </th>
                    <th>Corporation Name: </th>
                    <th>Date:  </th>
                    <th>Email:  </th>
                    <th>Zip Code: </th>
                    <th>Owner Name: </th>
                    <th>Phone #:  </th>
                </tr>
            <br>
            <br>
            </thead>

            <!-- /* loop through each result to get back an array with values */  -->
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>            
                    <td><?php echo $row['corp']; ?></td>
                    <td><?php echo date("M d, Y", strtotime($row['incorp_dt'])) ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['zipcode']; ?></td>
                    <td><?php echo $row['owner']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
