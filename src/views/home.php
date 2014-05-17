<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Content analysis application">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Content Analysis App</title>
        <link rel="stylesheet" href="css/default.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h3 class="text-muted">Content Analysis App</h3>
            </div> <!-- header -->
            <hr />

            <div class="jumbotron">
                <h2>The application uses Yahoo Content Analysis API.</h2>
                <p class="text-justify">The Content Analysis Web Service detects entities/concepts, categories, and relationships within unstructured content. It ranks those detected entities/concepts by their overall relevance, resolves those if possible into Wikipedia pages, and annotates tags with relevant meta-data.</p>

                <form action="analyze" method="post" role="form">
                    <div class="form-group">
                        <input type="hidden" id="_method" name="_method" value="post" />

                        <label for="content">Content input:</label>
                        <textarea name="content" class="form-control" id="content" rows="10"><?php echo (isset($content)) ? $content : $default_content; ?></textarea>
                        <span class="help-block">Place the text you want to be analyzed from Yahoo Content API.</span>
                    </div>
    
                    <button type="submit" name="analyze" class="btn btn-success btn-lg">Submit</button>
                </form>
            </div> <!-- jumbotron -->
 
            <div class="row" id="analysis">
                
            </div> <!-- analysis -->
            <hr />

            <div class="footer">
              <p>&copy; Svetoslav Ivanov 2014</p>
            </div> <!-- footer -->
        </div> <!-- container -->
        <script src="js/json2.min.js"></script>
        <script src="js/Toolkit.min.js"></script>
        <script src="js/main.min.js"></script>
    </body>
</html>