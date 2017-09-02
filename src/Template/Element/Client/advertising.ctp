<div id="advertising-wrap">
    <section id="advertising">
        <div class="ad-box clearfix">
            <?= $this->Html->image($ads[0]['url'],[
                'alt' => $ads[0]['alt'],
                'url' => '#'
            ]) ?>
            <?= $this->Html->image($ads[1]['url'],[
                'alt' => $ads[1]['alt'],
                'url' => '#'
            ]) ?>
        </div>  
        <?= $this->Html->image($ads[2]['url'],[
            'alt' => $ads[2]['alt'],
            'url' => '#'
        ]) ?>
    </section>
</div>