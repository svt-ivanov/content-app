<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page Not Available :(</title>
        <style>
            body {
                color: #444; 
                text-align: center;
            }

            h1 {
                font-size: 40px;
                text-align: center;
            }

            article {
                display: block;
                margin: 0 auto;
                width: 500px;
            }

            .btn-reload,
            .btn-info {
              font-size: 20px;
              padding: 10px 20px 10px 20px;
              text-decoration: none;
              margin: 50px 10px;
            }

            .btn-reload {
                background: #3498db;
                color: #fff;
            }

            .btn-reload:hover {
              background: #3cb0fd;
              text-decoration: none;
            }

            .btn-info {
                background: #dedede;
                color: #423f42;
            }

            .btn-info:hover {
                background: #e8e8e8;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <article>
            <h1>This page is not available</h1>
            <div>
                <p>We are sorry, but something went terribly wrong.</p>
                <a class="btn-reload" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">Reload</a>
                <a class="btn-info" href="#">More</a>
            </div>
        </article> 
    </body>
</html>