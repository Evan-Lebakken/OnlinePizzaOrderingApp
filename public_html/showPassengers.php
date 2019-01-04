<!DOCTYPE html>
<html>
<body>
<h2>List of all passengers</h2>
<p>
    <?php

        if($_GET['status'] == 'success!'){
            echo "success!!!";
        }
        //path to the SQLite database file
        $db_file = './myDB/airport.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);
            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all passengers, and store the result set
            $query_str = "select * from passengers ;";
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            foreach($result_set as $tuple) {
                 echo "
                 <form action='passengerForm.php' method='post'>
                 <input type='text' name='old_ssn' value='$tuple[ssn]' readonly>
                 <input type='text' name='old_fName' value='$tuple[f_name]' readonly>
                 <input type='text' name='old_mName' value='$tuple[m_name]' readonly>
                 <input type='text' name='old_lName' value='$tuple[l_name]' readonly>
                 <input type='submit' name='update' value='update!' onclick='document.location.href=\"passengerForm.php\"'>
                 </form>
                 <br/>\n";
            }

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>

</p>
</body>
</html>