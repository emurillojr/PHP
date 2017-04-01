<!-- 
Ernesto Murillo 
html form for search box to search within columns
UPDATED ADDED RESET BUTTON
-->

<form action="#" method="get">
    <fieldset>
        <label>Search Field</label>
        <input name="searchWord" type="search" placeholder="Search...." />
        <select name="column">
            <?php foreach (columns() as $key => $value): ?>   
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="action" value="Search" />
        <input type="submit" value="Submit" />
        <input type="reset" value="Reset"><br>
    </fieldset>            
</form>