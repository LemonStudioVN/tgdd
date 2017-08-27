<div id="banner-wrap">
    <section id="banner">
        <div class="main-promo">
            <h2><?= $banner['h2'] ?><br>
                <span><?= $banner['span'] ?></span>
            </h2>
            <p><?= $banner['description'] ?></p>
            <?= $this->Html->link($banner['link_name'],
                ['controller'=>'Pages','action'=>'index'],[
                'class'=>'button secondary'
            ]) ?>
        </div>
        <div id="banner-monster">
            <div class="speech-bubble">
                <h4><?= $banner['h4'] ?></h4>
            </div>
            <div class="moustache-shadow"></div>
            <div class="moustache-monster">
                <img src="img/moustache-monster.png" alt="monster">
            </div>
            <div id="stars">
                <div class="star small"></div>
                <div class="star medium"></div>
                <div class="star large"></div>
            </div>
        </div>
    </section>
</div>