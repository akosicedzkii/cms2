
    <section id="page-content">
        <a class="anchor" id="home"></a>
        <header id="header-carousel-container">
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php if($banners != null)
                {
                    $increment = 0;
                    foreach($banners as $row)
                    {?>
                        <li data-target="#main-carousel" data-slide-to="<?php echo $increment;?>" <?php if($increment==0){ echo 'class="active"';}?>></li>
                    <?php 
                        $increment++;
                    }
                }?>
                </ol>
                <div class="carousel-inner">
                    <?php if($banners != null)
                    {
                        $increment = 0;
                        foreach($banners as $row)
                        {?>
                            <div class="carousel-item<?php if($increment==0){ echo ' active';}?>">
                            <a <?php if($row->link != ""){ echo "href='".$row->link."' target='_blank'";}else{ echo "href='#' onclick='return false;'";}?>><img class="carousel-bg" src="<?php echo base_url()."uploads/"?>loyalty_banners/<?php echo $row->banner_image;?>"></a>
                            </div>
                    <?php 
                        $increment++;   }
                    }?>
                </div>
                <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
            </div>
        </header>
        <section id="loyalty-info">
            <div class="container">
                <div class="row">
                    <?php if($loyalty_contents != null){
                        foreach($loyalty_contents as $row){?>
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <div class="info-header">
                                <h4><?php echo strtoupper($row->title);?></h4>
                            </div>
                            <div>
                                <?php echo $row->content;?>
                            </div>
                        </div>
                    <?php 
                        }
                    }?>
                </div>
            </div>
        </section>
    </section>