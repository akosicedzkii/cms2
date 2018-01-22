<section id="page-content">
    <section id="company-profile">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-4 my-auto animate fade-in" data-group="profile">
                    <h2 class="align-middle">WHO<br>WE ARE</h2>
                </div>
                <div class="col-12 col-sm-7 col-md-7 col-lg-6 col-xl-5 my-auto animate fade-in from-left" data-group="profile">
                    <p>Since 1966, Unioil has led the way in innovative petroleum solutions, establishing itself as a highly innovative business partner for specialty oils, fuels and lubricants.</p>
                </div>
                <div class="col-12 my-3 my-md-4 my-lg-5"></div>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-4 push-sm-7 push-md-7 push-lg-6 push-xl-5 my-auto animate fade-in" data-group="profile">
                    <h2 class="align-middle">WHAT<br>WE DO</h2>
                </div>
                <div class="col-12 col-sm-7 col-md-7 col-lg-6 col-xl-5 pull-sm-5 pull-md-5 pull-lg-4 pull-xl-4 my-auto animate fade-in from-right" data-group="profile">
                    <ul dir="rtl">
                        <li><span>Retail station operations</span></li>
                        <li><span>Lubricants blending and marketing</span></li>
                        <li><span>Fuels trading</span></li>
                        <li><span>Specialty oils trading</span></li>
                        <li><span>Bitumen (asphalt) distribution</span></li>
                    </ul>
                </div>
                <div class="col-12 my-3 my-md-4 my-lg-5"></div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-4 my-auto animate fade-in" data-group="profile">
                    <h2 class="align-middle">WHY<br>UNIOIL</h2>
                </div>
                <div class="col-12 col-sm-7 col-md-7 col-lg-6 col-xl-5 my-auto animate fade-in from-left" data-group="profile">
                    <ul>
                        <li><span>Pioneer of European standard fuels in the Philippines</span></li>
                        <li><span>Fosters strategic global alliances with various oil and petroleum companies throughout the world.</span></li>
                        <li><span>Licensed blender and distributor of Idemitsu lubricants</span></li>
                        <li><span>Supplies the petroleum and power needs of various market segments.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="company-history">
        <div class="container">

            <?php if($achievements != null){
                $counter = 0;
                foreach($achievements as $row)
                {
                    if($counter == 0)
                    {
                        ?>
                            <div class="row justify-content-center">
                                <div class="col-1 col-sm-1 push-sm-4 push-md-4 push-lg-4 push-xl-4">
                                    <div class="timeline">
                                        <div class="dot animate zoom zoom-small" data-group="history-<?php echo $row->year;?>"></div>
                                    </div>
                                </div>
                                <div class="col-10 col-sm-4 col-md-4 col-lg-4 col-xl-4 pull-sm-1 pull-md-1 pull-lg-1 pull-xl-1 milestone animate fade-in from-right" data-group="history-<?php echo $row->year;?>">
                                    <h4><?php echo $row->year;?></h4>
                                    <p><?php echo ucfirst($row->achievement);?></p>
                                </div>
                                <div class="col-0 col-sm-4 col-md-4 col-lg-4 col-xl-4 hidden-xs-down"></div>
                            </div>
                        <?php
                        $counter++;
                    }
                    else if($counter == 1)
                    {
                        ?>
                            <div class="row justify-content-center">
                                <div class="col-0 col-sm-4 col-md-4 col-lg-4 col-xl-4 hidden-xs-down"></div>
                                <div class="col-1 col-sm-1">
                                    <div class="timeline">
                                        <div class="dot animate zoom zoom-small" data-group="history-<?php echo $row->year;?>"></div>
                                    </div>
                                </div>
                                <div class="col-10 col-sm-4 col-md-4 col-lg-4 col-xl-4 milestone animate fade-in from-left" data-group="history-<?php echo $row->year;?>">
                                <h4><?php echo $row->year;?></h4>
                                <p><?php echo ucfirst($row->achievement);?></p>
                                </div>
                            </div>
                        <?php
                        $counter = 0;
                    }
                }
            }?>
        </div>
    </section>
</section>
