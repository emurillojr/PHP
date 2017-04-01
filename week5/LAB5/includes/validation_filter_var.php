<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $email = 'test@test.com';
           $url = 'site';
        ?>
        
        
            
         <?php if ( filter_var($url, FILTER_VALIDATE_URL) !== false  ): ?>
            <h2>Site URL is valid</h2>
        <?php else: ?>
            <h2>Site URL is NOT valid</h2>
        <?php endif; ?>   
           
            
    </body>
</html>
