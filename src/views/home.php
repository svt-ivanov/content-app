<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
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

                <form action="analyze" id="form-analyze" method="post" role="form">
                    <div class="form-group">
                        <input type="hidden" id="_method" name="_method" value="post" />

                        <label for="content">Content input:</label>
                        <textarea name="content" class="form-control" rows="10"><?php echo (isset($content)) ? $content : $default_content; ?></textarea>
                        <span class="help-block">Place the text you want to be analyzed from Yahoo Content API.</span>
                    </div>
    
                    <button type="submit" name="analyze" class="btn btn-success btn-lg">Submit</button>
                </form>
            </div> <!-- jumbotron -->
     
            <div class="row">
            <?php if (isset($analysis)): ?>
            <h3>
                <span class="label label-success">Content analysis:</span>
            </h3>

            <dl>
                <?php foreach ($analysis as $term): ?>
                <div class="panel panel-success">
                    <dt class="panel-heading">
                        <?php echo "Analyzed term/s: "; ?>
                        <br />
                        <i><?php echo $term->text->content; ?></i>
                    </dt>

                    <dd class="panel-body">
                        <p><?php echo "Score: <span class='badge'>{$term->score}</span>"; ?></p>

                        <p><?php echo "Characters length: <span class='badge'>" .($term->text->end - $term->text->start). "</span>"; ?></p>

                        <?php if (isset($term->wiki_url)): ?>
                        <p>Reference link:
                        <a href="<?php echo $term->wiki_url; ?>" class="alert-link">
                            <?php echo $term->wiki_url; ?>
                        </a>
                        </p>
                        <?php endif; ?>
                    </dd>
                </div>
                <?php endforeach; ?>
            </dl>
            <?php endif; ?>
            </div> <!-- row -->
            <hr />

            <div class="footer">
              <p>&copy; Svetoslav Ivanov 2014</p>
            </div> <!-- footer -->

        </div> <!-- container -->
    </body>
</html>