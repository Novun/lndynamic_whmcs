<!DOCTYPE html>
<html>
<head>
        <title>VNC</title>
        <style type="text/css">
                body, html
                {
                        margin: 0; padding: 0; height: 100%; overflow: hidden;
                }

                #content
                {
                        position:absolute; left: 0; right: 0; bottom: 0; top: 0px;
                }
        </style>
</head>
<body><iframe width="100%" height="100%" frameborder="0" src="<?php echo $vnc_url; ?>"></iframe></body>
</html>