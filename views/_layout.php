<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">Albums Menu</div>
                <div class="panel-body">
                    <?php
                    $this->widget('zii.widgets.CMenu',array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array(
                            'class'=>'nav nav-pills nav-stacked'
                        )
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
    </div>
</div>