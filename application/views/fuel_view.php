<section id="page-content">
    <section id="page-title" class="product">
        <h3>PRODUCTS</h3>
    </section>
    <?php 
        echo $fuel_products;
    ?>
</section>

<div class="modal fade" id="diesel-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 my-auto">
                                <img class="product-logo img-fluid" src="<?php echo base_url()."assets_site/";?>images/unioil-euro5-diesel-logo.png" alt="" />
                                <p class="product-description">Euro 5 Diesel is the latest product diesel offering from Unioil that meets international Euro 5 standards. Considered as the cleanest and most advanced high performance fuel in the Philippines, Euro 5 Diesel guarantees a maximum sulfur content of 10 ppm (parts per million) compared to Euro IV compliant diesels with a sulfur content of 50 ppm. Euro 5 Diesel has a higher cetane number compared to regular diesels.</p>
                            </div>
                            <div class="col-12 col-md-6 my-auto">
                                <h4>CLEANER EMISSIONS</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    EuroDiesel 5 has up to 90% lower sulfur content compared to the usual diesel (Euro II or III) available in the market. This translates to a reduction in the emissions of sulfur oxides and sulfate particulate matter. In a study together with the DENR, smoke opacity reductions of up to 83% and 74% were observed for new and old model vehicles, respectively, with the use of EuroDiesel 5compared to that of a leading brand's diesel.
                                </p>
                                <h4>BETTER FUEL EFFICIENCY</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    EuroDiesel 5 has a higher cetane number compared to the usual diesel available in the Philippines.  Diesel with a higher cetane number burns faster and has a better ignition quality, giving better fuel efficiency.
                                </p>
                                <h4>FASTER COLD-START PREFORMANCE</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    EuroDiesel 5 can also provide a faster cold-start performance because of its higher cetane number.  It readily burns in a cold engine.  Its ignition delay is shorter compared to the usual diesel even in the low pressure and low temperature conditions of a long-idled engine. This in turn translates to easier start, smoother operations, less white smoke, and lower noise. 
                                </p>
                                <h4>QUIETER ENGINE</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    EuroDiesel 5 ignites before most of the fuel is injected into the combustion chamber.  This gives better controlled rates of heat release and pressure increase within the combustion chamber than lower cetane number diesel. This translates to a reduced knock intensity and smoother, quieter engine operations. In an independent study published in 2012, increase of cetane number gave up to 12.5% reduction in noise.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 my-auto">
                                <img class="product-logo img-fluid" src="" alt="" />
                                <p class="product-description"></p>
                            </div>
                            <div class="col-12 col-md-6 my-auto" id="prod-specs">
                                <h4>EURO 5 GASOLINE 97</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    Cleaner emissions<br>
                                    Protects the engine from ethanol's corrosive effect<br>
                                    Instantly improves fuel efficiency and power by enhancing engine lubrication<br>
                                    Restores maximum engine performance by removing deposits
                                </p>
                                <h4>EURO 5 GASOLINE 95</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    Cleaner emissions<br>
                                    Protects the engine from ethanol's corrosive effect<br>
                                    Prevents power loss by keeping the engine clean<br>
                                    Instantly improves fuel efficiency and power by enhancing engine lubrication
                                </p>
                                <h4>EURO 5 GASOLINE 91</h4>
                                <div class="modal-divider"></div>
                                <p>
                                    Cleaner emissions<br>
                                    Protects the engine from ethanol's corrosive effect<br>
                                    Prevents power loss by keeping the engine clean
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function view_product_details(product_id)
        {
            var data = { "id" : product_id }
            $.ajax({
                    data: data,
                    type: "post",
                    url: "<?php echo base_url()."products/get_product_details";?>",
                    success: function(data){
                        data = JSON.parse(data);
                        console.log(data);
                        $(".product-logo").attr("src","<?php echo base_url()."uploads/";?>products/"+data.product_sub_image);
                        $(".product-description").html(data.product_description);
                        $("#prod-specs").html(data.specification);
                        $("#product-modal").modal("show");
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
        }
    </script>