<?php

class HomepageView
{
    use View;


    public function show_diaporama($diaporama = [])
    { ?>
        <div class="slider">
            <div class="diaporama">
                <?php foreach ($diaporama as $item) : ?>
                    <div class="slide">
                        <img src="<?= ROOTIMG . "/brands/" . $item ?>" alt="news" width="100%" height="400px">
                        <a href="#"><button> Read More </button></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
