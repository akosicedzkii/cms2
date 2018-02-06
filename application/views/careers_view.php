<section id="page-content">
        <section id="page-title">
            <h3>CAREERS</h3>
        </section>
        <section id="careers-form-container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                        <p>Please fill up the form to apply. Fields with asterisk (*) are required.</p>
                        <form action="" id="careers-form" novalidate >
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-fname" class="form-label">First name *</label>
                                    <input type="text" id="careers-fname" class="careers-textbox" data-fieldtype="text" />
                                    <p class="error-msg"></p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-lname" class="form-label">Last name *</label>
                                    <input type="text" id="careers-lname" class="careers-textbox" data-fieldtype="text" />
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="careers-address" class="form-label">Address *</label>
                                    <input type="text" id="careers-address" class="careers-textbox" data-fieldtype="text" />
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-city" class="form-label">City *</label>
                                    <input type="text" id="careers-city" class="careers-textbox" data-fieldtype="text" />
                                    <p class="error-msg"></p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-zipcode" class="form-label">Zip Code *</label>
                                    <input type="text" id="careers-zipcode" class="careers-textbox" data-fieldtype="number" />
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-birthday" class="form-label">Birthday *</label>
                                    <input type="text" id="careers-birthday" class="careers-date" readonly data-fieldtype="date" />
                                    <p class="error-msg"></p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-number" class="form-label">Contact number *</label>
                                    <input type="tel" id="careers-number" class="careers-textbox" data-fieldtype="number" />
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-email" class="form-label">Email Address *</label>
                                    <input type="email" id="careers-email" class="careers-textbox" data-fieldtype="email" />
                                    <p class="error-msg"></p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="careers-opening" class="form-label">I'm applying for: *</label>
                                    <select id="careers-opening" class="careers-select" data-fieldtype="select">
                                        <option selected disabled>Select position</option>
                                        <?php
                                            if($jobs != null)
                                            {
                                                foreach($jobs as $row)
                                                {
                                                    echo '<option value="'.ucfirst($row->id).'">'.ucfirst($row->job_title).'</option>';
                                                }
                                            } 
                                        ?>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 push-sm-6 col-md-6 push-md-6 col-lg-6 push-lg-6 col-xl-6 push-xl-6">
                                    <p class="form-label">Job Description:</p>
                                    <p id="job-description">
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-6 pull-sm-6 col-md-6 pull-md-6 col-lg-6 pull-lg-6 col-xl-6 pull-xl-6">
                                    <label for="careers-letter" class="form-label">Upload Resume *</label>
                                    <input type="file" id="careers-letter" class="careers-btn" data-fieldtype="file"  accept=".txt,.pdf,.docs,.docx" />
                                    <p class="error-msg"></p>
                                    <div class="submit-btn-container">
                                    <input type="submit" id="careers-submit" value="SUBMIT APPLICATION" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
