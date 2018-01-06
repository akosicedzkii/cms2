<section id="page-content">
        <section id="page-title" class="product">
            <h3>PRODUCTS</h3>
        </section>
        <section id="asphalt-content">
            <div class="container">
            <?php if($asphalt_products != null){?>
                <?php foreach($asphalt_products as $row){?>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 my-auto copy animate fade-in">
                            <div class="animate fade-in from-left">
                                <h3><?php echo str_replace(" ","<br>",$row->product_name);?></h3>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 my-auto copy animate fade-in">
                            <div class="animate fade-in from-right">
                                <p><?php echo $row->product_description;?></p>
                                
                                <p><?php echo $row->specification;?></p>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            </div>
        </section>
    </section>