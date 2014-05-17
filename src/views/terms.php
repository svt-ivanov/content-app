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