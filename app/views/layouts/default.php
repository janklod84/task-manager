<!DOCTYPE html>
<?= HTML::lang('ru') ?>
<head>
    <?= HTML::renderMeta() ?>
    <link rel="icon" href="favicon.ico">
    <?= HTML::title() ?>
    <?= Asset::renderCss() ?>
</head>
<body>
  
   <?php partials('/partials/menu'); ?>
   
   <div class="container" style="margin-top: 30px;">
       <?= Flash::show('success', 'alert alert-success'); ?>
        <?= $content; ?>
   </div>

   <!-- scripts -->
   <?= Asset::renderJs() ?>
</body>
</html>