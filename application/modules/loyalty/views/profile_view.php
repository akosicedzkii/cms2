<section id="page-content">
        <section id="profile-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4 col-lg-3">
                        <?php if($checked->image != null){
                            
                           ?>  
                            <img src="<?php echo base_url();?>/uploads/card_profile_images/<?php echo $checked->image;?>" class="profile-img">
                           <?php
                        }else{?>
                            <img src="<?php echo base_url();?>/assets_loyalty/images/sample-profile-img.png" class="profile-img">
                         <?php
                        }?>
                        <label class="upload-img-label">
                            UPLOAD IMAGE
                            <input type="file" class="upload-img-btn" id="image" accept = ".png, .jpg"/>
                        </label>
                    </div>
                    <div class="col-12 col-md-auto profile-info-container">
                        <p class="profile-info" id="profile-name"><?php echo ucwords($this->session->userdata("first_name")." ".$this->session->userdata("middle_innitial").". ".$this->session->userdata("last_name") );?></p>
                        <p class="profile-info"><span id="profile-card-label">Card #:</span> <span id="profile-card-number"><?php echo $this->session->userdata("card_number");?></span></p>
                        <a class="ghost-btn white profile-edit-btn" data-toggle="modal" href="#edit-modal">EDIT PROFILE</a>
                        <input type="text" id="profile-points" readonly value="000000000" />
                        <p class="profile-points-label">CURRENT POINTS</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="transaction-container">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center">TRANSACTION HISTORY</h4>
                        <div class="table-responsive">
                            <table id="transaction-table" class="table">
                                <thead>
                                    <tr>
                                        <th>BRANCH</th>
                                        <th>DATE &amp; TIME</th>
                                        <th>SI#</th>
                                        <th>PRODUCT DESCRIPTION</th>
                                        <th>AMOUNT</th>
                                        <th>POINTS EARNED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>TEST</td>
                                        <td>TEST</td>
                                        <td>000</td>
                                        <td>TEST</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>EDIT PROFILE</h4>
                    <form action="" id="edit-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <p class="text-center"><span class="primary-label">Card No.:</span> <span id="edit-card-number" class="primary-value"><?php echo $this->session->userdata("card_number");?></span></p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <p class="text-center"><span class="primary-label">Name:</span> <span id="edit-card-number" class="primary-value"><?php echo ucwords($this->session->userdata("first_name")." ".$this->session->userdata("middle_innitial").". ".$this->session->userdata("last_name") );?></span></p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <p class="text-center"><span class="primary-label">Birthday:</span> <span id="edit-card-bday" class="primary-value"><?php echo date("F d, Y",strtotime($this->session->userdata("bday_long")));?></span></p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-contact-number">Contact No.:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-contact-number" class="text-field" data-fieldtype="number" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-email-address">Email Address:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-email-address" class="text-field" data-fieldtype="email" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-gender">Gender:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input id="gender-male" class="radio-btn" type="radio" value="male" name="edit-gender" checked />
                                        <label for="gender-male">Male</label>
                                        <input id="gender-female" class="radio-btn" type="radio" value="female" name="edit-gender" />
                                        <label for="gender-female">Female</label>
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-gender">Civil Status:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input id="gender-male" class="radio-btn" type="radio" value="single" name="edit-status" checked />
                                        <label for="status-single">Single</label>
                                        <input id="gender-female" class="radio-btn" type="radio" value="married" name="edit-status" />
                                        <label for="status-married">Married</label>
                                        <br>
                                        <input id="gender-male" class="radio-btn" type="radio" value="widow" name="edit-status" />
                                        <label for="status-widow">Widow</label>
                                        <input id="gender-female" class="radio-btn" type="radio" value="separated" name="edit-status" />
                                        <label for="status-separated">Separated</label>
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-occupation">Occupation:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-occupation" class="text-field" data-fieldtype="text" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-car-number">No. of Cars:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="number" id="edit-car-number" class="text-field" data-fieldtype="number" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-2 label-container">
                                    <label for="edit-occupation">Address:</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-house-number" class="text-field" data-fieldtype="text" placeholder="House/Floor/Unit no., Building Name" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-street" class="text-field" data-fieldtype="text" placeholder="Street" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-0 col-md-2">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-0 col-md-2">
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-village" class="text-field" data-fieldtype="text" placeholder="Village/Subdivision" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-barangay" class="text-field" data-fieldtype="text" placeholder="Barangay" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-0 col-md-2">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-0 col-md-2">
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-city" class="text-field" data-fieldtype="text" placeholder="City/Municipality" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="edit-field-group">
                                        <input type="text" id="edit-province" class="text-field" data-fieldtype="text" placeholder="Province" />
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="col-0 col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="question-label">Which other gas stations do you gas up?</p>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-petron" data-fieldtype="checkbox" />
                                        <label for="edit-petron" class="form-label">Petron</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-shell" data-fieldtype="checkbox" />
                                        <label for="edit-shell" class="form-label">Shell</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-caltex" data-fieldtype="checkbox" />
                                        <label for="edit-caltex" class="form-label">Caltex</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-total" data-fieldtype="checkbox" />
                                        <label for="edit-total" class="form-label">Total</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-seaoil" data-fieldtype="checkbox" />
                                        <label for="edit-seaoil" class="form-label">SeaOil</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-phoenix" data-fieldtype="checkbox" />
                                        <label for="edit-phoenix" class="form-label">Phoenix</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-flyingv" data-fieldtype="checkbox" />
                                        <label for="edit-flyingv" class="form-label">Flying V</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-ptt" data-fieldtype="checkbox" />
                                        <label for="edit-ptt" class="form-label">PTT</label>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-jetti" data-fieldtype="checkbox" />
                                        <label for="edit-jetti" class="form-label">Jetti</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="question-label">Which other gas stations do you gas up?</p>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-smadv" data-fieldtype="checkbox" />
                                        <label for="edit-smadv" class="form-label">SM Advantage</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-bdore" data-fieldtype="checkbox" />
                                        <label for="edit-bdore" class="form-label">BDO Rewards</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-natio" data-fieldtype="checkbox" />
                                        <label for="edit-natio" class="form-label">Laking National Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-robin" data-fieldtype="checkbox" />
                                        <label for="edit-robin" class="form-label">Robinson's Reward Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-mabuh" data-fieldtype="checkbox" />
                                        <label for="edit-mabuh" class="form-label">Mabuhay Miles</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-happy" data-fieldtype="checkbox" />
                                        <label for="edit-happy" class="form-label">Happy Plus Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-cebup" data-fieldtype="checkbox" />
                                        <label for="edit-cebup" class="form-label">Cebu Pacific GetGo Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-starb" data-fieldtype="checkbox" />
                                        <label for="edit-starb" class="form-label">Starbucks Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-mercu" data-fieldtype="checkbox" />
                                        <label for="edit-mercu" class="form-label">Mercury Suki Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-petro" data-fieldtype="checkbox" />
                                        <label for="edit-petro" class="form-label">Petron Value Card</label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="edit-field-group">
                                        <input type="checkbox" class="edit-field not-required" id="edit-snr" data-fieldtype="checkbox" />
                                        <label for="edit-snr" class="form-label">S&amp;R</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="button" data-dismiss="modal" id="edit-cancel" value="CANCEL" />
                            <input type="submit" id="edit-submit" value="SAVE" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="terms-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>TERMS AND CONDITIONS</h4>
                    <div class="terms-container">
                        <?php echo $loyalty_settings->loyalty_terms_and_conditions; ?>
                    </div>
                    <form action="" id="terms-form">
                        <div class="terms-field-group text-center">
                            <input type="checkbox" class="terms-field" id="terms-agree" data-fieldtype="checkbox" />
                            <label for="terms-agree" class="form-label">I have read the terms and conditions stated and accept the stipulations included therein.</label>
                            <p class="error-msg"></p>
                        </div>
                        <div class="text-center">
                            <input type="button" data-dismiss="modal" id="terms-cancel" value="CANCEL" />
                            <input type="submit" id="terms-submit" value="SUBMIT" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>