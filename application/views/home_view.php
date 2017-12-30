
    <section id="page-content">
        <a class="anchor" id="home"></a>
        <header id="header-carousel-container">
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#main-carousel" data-slide-to="1"></li>
                    <li data-target="#main-carousel" data-slide-to="2"></li>
                    <li data-target="#main-carousel" data-slide-to="3"></li>
                    <li data-target="#main-carousel" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 1a.png">
                        <img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."assets_site/"?>images/unioil-index-doing-our-part-copy.png">
                    </div>
                    <div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 1b.png">
                        <img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."assets_site/"?>images/unioil-index-doing-our-part-copy.png">
                    </div>
                    <div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 1c.png">
                        <img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."assets_site/"?>images/unioil-index-doing-our-part-copy.png">
                    </div>
                    <div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 1d.png">
                         <img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."assets_site/"?>images/unioil-index-doing-our-part-copy.png">
                    </div>
                    <div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 1e.png">
                         <img id="doing-your-part-copy" class="carousel-content animate fade-in" src="<?php echo base_url()."assets_site/"?>images/unioil-index-doing-our-part-copy.png">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
            </div>
        </header>
        <section id="store-locator">
            <div id="step-1" class="step active display animate fade-in">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 my-auto">
                            <img src="<?php echo base_url()."assets_site/"?>images/unioil-store-locator.png" alt="">
                            <div class="input-wrapper">
                                <div class="input-container">
                                    <input type="text" id="store-area">
                                    <div class="next-btn">&rsaquo;</div>
                                </div>
                                <div class="suggestion-wrapper">
                                    <div class="suggestion-container">
                                        <div class="store-list-btn">
                                            See all branches
                                        </div>
                                        <div class="suggestion-list">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="error-container">
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="step">
                <div class="locator-back">
                    &lsaquo;
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 my-auto">
                            <img src="<?php echo base_url()."assets_site/"?>images/unioil-store-locator.png" alt="">
                            <p class="selected-area"></p>
                            <div class="input-wrapper">
                                <div class="input-container">
                                    <input type="text" id="store-branch">
                                    <div class="next-btn">&rsaquo;</div>
                                </div>
                                <div class="suggestion-wrapper">
                                    <div class="suggestion-container">
                                        <div class="store-list-btn">
                                            See all branches
                                        </div>
                                        <div class="suggestion-list">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="error-container">
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-3" class="step">
                <div class="locator-back">
                    &lsaquo;
                </div>
                <div class="container">
                    <div class="row justify-content-center my-auto">
                        <div class="col-12 col-md-6">
                            <p class="selected-area"></p>
                            <p class="selected-branch"></p>
                            <div class="embed-responsive embed-responsive-1by1">
                                <iframe class="embed-responsive-item branch-map" src=""></iframe>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 my-auto">
                            <table class="price-grid mx-auto">
                                <tbody>
                                    <tr>
                                        <td>EuroIV Gasoline</td>
                                        <td>
                                            <div id="gasoline-price" class="price-container" data-price="41.00"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EuroIV Diesel</td>
                                        <td>
                                            <div id="diesel-price" class="price-container" data-price="31.55"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>AutoGAS</td>
                                        <td>
                                            <div id="autogas-price" class="price-container" data-price="00.00"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="store-list">
                <div class="locator-back">
                    &lsaquo;
                </div>
                <div class="container">
                    <div class="row ">
                        <div class="col-12">ALL BRANCHES</div>
                        <div class="col-12 list-segment">
                        </div>
                        <div class="col-12 store-pagination">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="promo-carousel-container">
            <div id="promo-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <!--  <li data-target="#promo-carousel" data-slide-to="0" class="active"><img src="<?php echo base_url()."assets_site/"?>images/unioil-thumbnail-inactive.png" /></li>
                    <li data-target="#promo-carousel" data-slide-to="1"><img src="<?php echo base_url()."assets_site/"?>images/unioil-thumbnail-inactive.png" /></li>
                    <li data-target="#promo-carousel" data-slide-to="2"><img src="<?php echo base_url()."assets_site/"?>images/unioil-thumbnail-inactive.png" /></li>-->
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 2.png">
                        <div class="carousel-content-container">
                            <h3 class="animate fade-in" data-group="fb-banner">Instantly see updates and promos!</h3>
                            <a href="https://www.facebook.com/unioil/"><img class="fb-img-btn animate fade-in" data-group="fb-banner" src="<?php echo base_url()."assets_site/"?>images/unioil-fb-button.png" alt="" /></a>
                        </div>
                    </div>
                    <!--<div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 2.png">
                    </div>-->
                    <!--<div class="carousel-item">
                        <img class="carousel-bg" src="<?php echo base_url()."assets_site/"?>images/banner 2.png">
                    </div>-->
                </div>
                <!--<a class="carousel-control-prev" href="#promo-carousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                <a class="carousel-control-next" href="#promo-carousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>-->
            </div>
        </section>
        <section id="news-updates-ribbon" class="animate fade-in">
            <a href="<?php echo base_url()."assets_site/"?>news.html">
                <div class="ribbon-container">
                    <p>SEE ALL NEWS &amp; UPDATES</p>
                </div>
            </a>
        </section>
        <section id="unioil-loyalty-cta">
            <a class="anchor" id="loyalty"></a>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <img src="<?php echo base_url()."assets_site/"?>images/unioil-index-img-loyalty.png" alt="Unioil Loyalty" class="img-fluid img-stacked mx-auto animate fade-in" data-group="loyalty">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 animate fade-in" data-group="loyalty">
                        <p>
                           Your support of Unioil’s complete line of Euro 5-compliant products allows you to be a partner in #DoingOurPart. We consider your patronage a gift and a privilege, so allow us to give something back in return. Sign up for a Unioil Loyalty Card today, and be on the road to the top deals and the best discounts. This is our way of saying thanks for the ride, and may we continue being on the same journey together!
                        </p>
                        <div class="btn-spacer text-center text-md-left animate fade-in" data-group="loyalty">
                            <a href="#" class="ghost-btn white">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section id="unioil-loyalty-cards">
            <div class="card-btn-container">
                <div class="card-btn animate fade-in from-top-right" data-url="#" data-group="loyalty">
                    <div class="card-hover-container">
                        <div class="hover-line"></div>
                        <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                    <p class="card-name"><span class="emphasis">LOYALTY</span>
                        <br>CARD</p>
                </div>
                <div class="card-btn animate fade-in from-bottom-left" data-url="#" data-group="loyalty">
                    <div class="card-hover-container">
                        <div class="hover-line"></div>
                        <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                    <div class="card-name-container">
                        <p class="card-name"><span class="emphasis">ALLIANCE</span>
                            <br>CARD</p>
                    </div>
                </div>
                <div class="card-btn animate fade-in from-top-right" data-url="#" data-group="loyalty">
                    <div class="card-hover-container">
                        <div class="hover-line"></div>
                        <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                    <div class="card-name-container">
                        <p class="card-name"><span class="emphasis">WEEKEND</span>
                            <br>WARRIOR CARD</p>
                    </div>
                </div>
                <div class="card-btn animate fade-in from-bottom-left" data-url="#" data-group="loyalty">
                    <div class="card-hover-container">
                        <div class="hover-line"></div>
                        <p class="card-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                    <div class="card-name-container">
                        <p class="card-name"><span class="emphasis">FLEET</span>
                            <br> CARD
                        </p>
                    </div>
                </div>
            </div>
        </section> -->
    </section>
		