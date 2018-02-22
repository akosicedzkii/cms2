<section id="page-content">
    <section id="page-title" class="product">
        <h3>PRODUCTS</h3>
    </section>
    <?php 
        echo $fuel_products;
    ?>
</section>

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
                                
                            </div>
                        </div>
                        <div class="row"  id="dl">
                            <div class="col-12 col-md-6 my-auto">
                            </div>
                            <div class="col-12 col-md-6 my-auto" id="">
                                <div class='btn-spacer' style='padding-left: 14px;padding-bottom: 14px;cursor:pointer;'><a style='font-size: 13px;' id="dl_link" class='ghost-btn blue' href='' target=_blank>Download PDF</a></div>
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
                        if(data.pdf != null)
                        {
                            $("#dl").show();
                            $("#dl_link").attr("href","<?php echo base_url()."uploads/";?>products/" +data.pdf);
                        }
                        else
                        {
                            $("#dl").hide();
                        }
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
        }
    </script>