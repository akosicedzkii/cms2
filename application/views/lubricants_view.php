<section id="page-content">
        <section id="page-title" class="product">
            <h3>PRODUCTS</h3>
        </section>
        <section id="lubricants-container">
            <div class="container">
                <div class="row justify-content-center">
                    <?php if($lubricants_products != null){
                        $count = 0;
                        ?>
                        <?php foreach($lubricants_products as $row){
                                if($count == 1)
                                {
                                    $col = " offset-md-1";
                                    $count = 0;
                                }
                                else
                                {
                                    $col = "";
                                    $count++;
                                }
                            ?>
                            <div class="col-12 col-sm-6 col-md-5<?php echo  $col;?> lubricant-item animate fade-in" data-group="lubricants">
                                <img src="<?php echo base_url()."uploads/product_series/";?>/<?php echo $row->series_image;?>" alt="" class="img-fluid" />
                                <p style="text-align:justify;"><?php echo $row->series_description;?></p>
                                <div class="btn-spacer text-center">
                                    <?php 
                                        if($row->series_title_image != null)
                                        {
                                            $title = $row->series_title_image;
                                            $type = "img";
                                        }
                                        else
                                        {
                                            $title = strtoupper($row->series_name);
                                            $type = "text";
                                        }
                                    ?>
                                    <a data-toggle="modal" href="#" onclick="view_product_details(<?php echo $row->id?>,'<?php echo $title;?>','<?php echo $type;?>');return false;"class="ghost-btn blue">SEE PRODUCTS</a>
                                </div>
                            </div>
                        <?php }?>
                    <?php }?>
            </div>
        </section>
    </section>

    <div class="modal fade" id="lubricants-modal" tabindex="-1" role="dialog" aria-labelledby="lubricant-heading" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="lubricant-heading"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div id="carosel-content">
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                        <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function view_product_details(series_id,series_name,type)
        {
            var data = { "id" : series_id }
            $.ajax({
                    data: data,
                    type: "post",
                    url: "<?php echo base_url()."products/get_lubricants";?>",
                    success: function(data){
                        $("#carosel-content").html(data);
                        if(type == "img")
                        {
                            series_name = '<img src="<?php echo base_url()."uploads/product_series/";?>'+ series_name + '" alt="" class="img-fluid">';
                        }
                        $("#lubricant-heading").html(series_name);
                        $("#lubricants-modal").modal("show");
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
        }
    </script>