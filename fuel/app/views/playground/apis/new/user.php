<?php

use Fuel\Core\Form;
?>
<html>
    <head>
        <title><?= $page_title; ?></title>
    </head>
    <body>
        <table>
            <?php if(1){?>
            <?=  Form::open(); ?>
            <tr>
                <td><?= Form::label('First Name'); ?></td>
                <td><?= Form::input('first_name'); ?></td>
            </tr>
            <tr>
                <td><?= Form::label('Last Name');?></td>
                <td><?= Form::input('last_name');?></td>
            </tr>
            <tr>
                <td><?= Form::label('Password');?></td>
                <td><?= Form::password('password')?></td>
            </tr>
            <tr>
                <td><?= Form::label('Verify');?></td>
                <td><?= Form::password('verify_password')?></td>
            </tr>
            <tr>
                <td><?= Form::label('Email');?></td>
                <td><?= Form::input('email');?></td>
            </tr>
            <tr>
                <td><?= Form::label('Verify');?></td>
                <td><?= Form::input('verify_email');?></td>
            </tr>
            <tr>
                <td><?= Form::submit();?></td>
            </tr>
            <?= Form::close();} ?>
        </table>
        <?php //echo $form; ?>
    </body>
</html>