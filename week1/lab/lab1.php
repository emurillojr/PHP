<!DOCTYPE html>

<!-- 
Ernesto Murillo Lab 1 Assignment 07/20/2016
php script 10x10 grid of randomly generated colors, displaying the RGB color code 
inside the grid in both white and black
-->

<?php if (isset($randColor)): ?> 
    <span style="background-color: <?php echo $randColor; ?>;"> 
        <?php echo $randColor; ?>
    </span> 

<?php endif; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1">
            <?php for ($tr = 1; $tr <= 10; $tr++): ?>
                <tr>
                    <?php for ($td = 1; $td <= 10; $td++): ?>
                        <?php $randColor = '#' . strtoupper(dechex(rand(0x000000, 0xFFFFFF))); ?>
                        <td style="background-color: <?php echo $randColor; ?>;" > <?php echo $randColor; ?> <br/>
                            <span style="color: white;"> <?php echo $randColor; ?> </span></td>
                        <?php endfor; ?>   
                </tr>
            <?php endfor; ?>
        </table>
    </body>
</html>
