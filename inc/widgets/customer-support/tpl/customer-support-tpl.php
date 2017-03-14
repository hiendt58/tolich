<?php $heading = !empty($instance['heading']) ? $instance['heading'] : 'Hỗ trợ trực tuyến'; ?>

<div id="customer-support">
    <h3 class="heading widget-title"><?php echo $heading ?></h3>
    <?php
    if (!empty($instance['hotline'])) {
        $hotline = $instance['hotline'];
        ?>

        <div class="hotline">
            Hotline: <span class="phone-hotline"> <?php echo $hotline ?></span>
        </div>


    <?php }
    // Ensure that the repeater is available and not empty.
    if (!empty($instance['list_infor'])) {
        ?>
        <div class="customer-support">
            <?php
            $repeater_items = $instance['list_infor'];
            foreach ($repeater_items as $index => $repeater_item) {
                $department = $repeater_item['department'];
                ?>
                <div class="department-section">
                    <div class="department">
                        <?php echo $department ?>
                    </div>
                    <?php
                    $repeater_ems = $repeater_item['employee'];
                    foreach ($repeater_ems as $index => $em) {
                        $department = $repeater_item['department'];
                        $em_name = $em['em_name'];
                        $em_phone = $em['em_phone'];
                        $em_skype = $em['em_skype'];
                        ?>
                        <div class="row employee">
                            <div class="col-lg-5 col-sm-12 em_name">
                                <?php echo $em_name ?>
                            </div>
                            <div class="col-lg-5 col-sm-8 em_phone">
                                <a href="tel:<?php echo $em_phone ?>"><?php echo $em_phone ?> </a>
                            </div>
                            <div class="col-lg-2 col-sm-4 em_skype">
                                <a href="skype:<?php echo $em_skype ?>?call">
                                    <i class="fa fa-skype"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>
