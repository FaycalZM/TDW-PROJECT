<?php

class ContactView
{
    use View;

    public function contact_page($contacInfos)
    { ?>
        <div class="container mt-5">
            <h2 class="mt-4 mb-4">Contact Information</h2>
            <?php
            foreach ($contacInfos as $info) { ?>
                <!-- Contact Cards -->
                <div class="card contact-card">
                    <div class="card-body">
                        <h5 class="card-title">Email: <?= $info['contactEmail'] ?></h5>
                        <p class="card-text">Phone: <?= $info['contactPhone'] ?></p>
                    </div>
                </div>
            <?php }
            ?>
        </div>
<?php }
}
