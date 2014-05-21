<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-md-3">
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Components',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items' => $this->menu,
            'htmlOptions' => array('class' => 'nav nav-pills nav-stacked'),
        ));
        $this->endWidget();
        ?>
    </div><!-- sidebar -->
</div>
<div class="col-md-9 last">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->

</div>
<?php $this->endContent(); ?>