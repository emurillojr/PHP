<!-- 
Ernesto Murillo 
html form for sort radio buttons ASC DESC and submit
UPDATED ADDED RESET BUTTON to go back to checked ASC
added preselected ASC order button
-->

<form action="#" method="get">
    <fieldset>

        <label>Ascending Order</label>  
        <input type="radio" name="sort" checked="checked" value="ASC" /> 

        <label>Descending Order</label>  
        <input type="radio" name="sort" value="DESC" />

        <select name="column">
            <?php foreach (columns() as $key => $value): ?>   
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

            <?php endforeach; ?>
        </select>

        <input type="hidden" name="action" value="Sort" />
        <input type="submit" value="Submit" />
        <input type="reset" value="Reset"><br>
    </fieldset>    
</form>
