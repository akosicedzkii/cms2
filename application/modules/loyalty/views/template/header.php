<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Unioil Loyalty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/scroll-events.css">
    <?php if($page == "main" || $page == "faq"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/index.css">
    <?php }?>
    <?php if($page == "profile"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/profile.css">
    <?php }?>
    <?php if($page == "faq"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/faq.css">
    <?php }?>
</head>

<body id="index">
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>LOG IN</h4>
                    <form action="" id="login-form">
                        <div class="login-field-group">
                            <label for="login-birthday" class="form-label">Card No.</label>
                            <input type="text" class="login-field" id="login-card-number" data-fieldtype="number" />
                            <p class="error-msg"></p>
                        </div>
                        <div class="login-field-group date-autofill">
                            <label for="login-birthday" class="form-label">Birthday</label>
                            <select name="" id="login-birthday-year" class="login-birthday date-year" data-fieldtype="select-date" >
                                <option disabled selected value="default">YYYY</option>
                            </select>
                            <select name="" id="login-birthday-month" class="login-birthday date-month" disabled data-fieldtype="select-date" >
                                <option disabled selected value="default">MM</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="" id="login-birthday-day" class="login-birthday date-day" disabled data-fieldtype="select-date" >
                                <option disabled selected value="default">DD</option>
                            </select>
                            <p class="error-msg"></p>
                        </div>
                        <input type="submit" id="login-submit" value="SUBMIT" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="privacy-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>PRIVACY​ ​POLICY</h4>
                    <div class="privacy-container">
                        <ol>
                                <p>Unioil Petroleum Philippines, Inc. is committed to protecting your privacy and as such, complies with the Philippine Data Privacy Act of 2012 regarding the collection, use, and retention of personal information in the Philippines. As a sign of its commitment to provide a high level of protection for the personally-identifiable information it collects and uses, Unioil Petroleum Philippines, Inc. has certified that it adheres to the Data Privacy Act Principles of notice, choice, onward transfer, security, data integrity, access, and enforcement.</p>

                                <p>The purpose of this Privacy Policy is to inform you as to what information may be collected from you when you visit our website (“the Site”) or when you become a Distributor or customer, how such information will be used by Unioil and/or other persons or entities, with whom such information may be shared, your choices regarding the collection, use and distribution of such information, your ability to edit, update, correct or delete such information and the security procedures that we have implemented to protect your privacy.</p>

                                <p>By continuing to use the Site and our services, you signify that you have read, understood, and consent to the collection and use of your Customer Data, particularly your Sensitive and/or Personal Information, in accordance with this Privacy Policy.</p>

                                <p>Please be informed that by submitting your personal data to us, you will be treated as having given your permission for disclosures referred to in this policy, where necessary and appropriate.</p>

                                <p>To learn more about the Data Privacy Act of 2012, please visit http://www.gov.ph/2012/08/15/republic-act-no-10173/</p>

                            <li>
                                <p class="bold-text">Collection​ ​of​ ​Information</p>
                                At different occasions you may be asked for certain types of personally-identifiable information (e.g., your first and last name, mailing address, city, state, zip code, telephone number, email address, credit card number, bank information in connection with automatic deposit/debits, etc.). We collect, access, and use only the minimum Sensitive and/or Personal Information necessary to meet legitimate business purposes and if the purpose of the processing could not reasonably be fulfilled by other means.
                                <br><br>
                            	Your personal data is controlled ultimately byUnioil Petroleum Philippines, Inc., a company registered in the Philippines and whose registered office is at Pres. Sergio Osmena Highway Corner Cuangco Street, Pio Del Pilar, Makati City.
                            	<br><br>
                            	You are entitled to the following rights under the Data Privacy Act:
                            	<br><br>
                            	<ol>
                            		<li>Be informed;</li>
                            		<li>Object, refuse or withdraw consent;</li>
                            		<li>Access;</li>
                            		<li>Rectification;</li>
                            		<li>Erasure or blocking;</li>
                            		<li>Be notified of any data breach, complain and damages;</li>
                            		<li>Transmissibility; and,</li>
                            		<li>Data portability.</li>
                            	</ol>
                            	<br>
                            	If you want to exercise your right to access your personal information and to have incorrect information corrected, please contact Customer Services or send an email to loyalty@unioil.com.
                            	<br><br>
                            </li>
                            <li>
                                <p class="bold-text">Purpose</p>
                                We limit the access, collection, sharing, disclosure, and further use of your Personal Information to meeting legitimate business purposes. You will be informed about these purposes at the time of collection.
                                <br>
                                We would therefore use your personal information in order to:
                                <br><br>
                                ▪ respond to queries or requests submitted by you<br>
								▪ process orders or applications submitted by you<br>
								▪ administer or otherwise carry out our obligations in relation to any agreement you have with us<br>
								▪ anticipate and resolve problems with any goods or services supplied to you<br>
								▪ create products or services that may meet your needs.<br>
								<br>
								To optimize our services we may wish to use your personal data for direct marketing.<br><br>
                            </li>
                            <li>
                                <p class="bold-text">Data​ ​Storage​ ​and​ ​Security</p>
                                Personally-identifiable information will be kept in active files or systems as long as needed to meet the purposes for which it was collected or as required. We will make reasonable efforts to ensure that the information is accurate and complete.<br><br>
                                We take reasonable steps to ensure that the personal information collected remains accurate, timely and secure.<br><br>
                                In case any breach occurs involving sensitive personal information or any other information that may, under the circumstances, be used to enable identity fraud are reasonably believed to have been acquired by an unauthorized person, and we believe that such unauthorized acquisition is likely to give rise to a real risk of serious harm to any affected data subject, we shall inform the affected persons as soon as possible upon knowledge thereof.<br><br>
                            </li>
                            <li>
                                <p class="bold-text">Complaints</p>
                                Unioil takes privacy concerns seriously. If you believe that Unioil has not complied with this Privacy Policy, you may write to the address below or call us. Please describe in as much detail as possible the ways in which you believe that the Privacy Policy has not been complied with. We will investigate your complaint promptly.<br><br>
								Address: Ex-Yamaha Bldg., Lot 8 Blk 8, ADB Avenue, Ortigas, San Antonio, Pasig City<br><br>
    							Contact Number: 687-8877<br><br>
                            </li>
                            <li>
                                <p class="bold-text">Website​ ​Specific</p>
                                Go to any participating store and present your Unioil Loyalty Card to the service attendant. Inform them of the equivalent amount of points to be redeemed. Points may only be redeemed for undiscounted cash and credit card transactions. Members should check their points balance before redeeming at the stations<br><br>
                                
                                <b>a.​ ​Protection​ ​of​ ​Children</b><br><br>
								The Site is a general audience web site that is not specifically designed or targeted at children. We do not knowingly collect, use or disseminate any personally-identifiable information from children under the age of 13. If, however, we become aware that personally-identifiable information regarding a child under the age of 13 has been collected at the Site, we will use such information for the sole purpose of contacting a parent or guardian of the child to obtain verifiable parental consent. If we cannot obtain consent after a reasonable period of time, or if when contacted a parent or guardian requests that we do not use or maintain such information, we will make reasonable efforts to delete it from our records. Upon request by a parent or guardian, we will provide a description of the specific types of personal information collected from a child who is under the age of 13.
								<br><br>
								<b>b.​ ​Cookies</b><br><br>
								Cookies are small pieces of information that are stored on computer hard drives. We may use cookies to recognize you when you return to the Site in order to provide you with a better user experience. Our cookies do not contain any personally-identifying information, such as your name, or sensitive information, such as your credit card number. We may allow third parties to use cookies on the Site. We do not control the use or contents of third party cookies. Web browsers often allow you to erase existing cookies from your hard drive, block the use of cookies and/or be notified when cookies are encountered. If you elect to block cookies, please note that you may not be able to take full advantage of the features and functions of the Site.
								<br><br>
								<b>c.​ ​Third-Party​ ​Links</b><br><br>
								The Site may contain links to web sites operated and maintained by third parties over which we have absolutely no control. Any information you provide to third party websites will be governed under the terms of each websites’ privacy policy and we encourage you to investigate and ask questions before disclosing any information to the operators of third party websites. We have no responsibility or liability whatsoever for the content, actions or policies of third party websites. The inclusion of third party websites on our Site in no way constitutes an endorsement of such websites’ content, actions or policies.
								<br><br>
                            </li>
                            <li>
                                <p class="bold-text">Modifications​ ​To​ ​Policy</p>
                                Unioil reserves the right to change this Privacy Policy at any time. Any changes to this Policy will be effective immediately upon notice, which may be provided to you via e-mail or by posting the latest version on our Site. Your subsequent use of the Site be deemed acceptance of such changes. Be sure to review this Privacy Policy periodically to ensure familiarity with its most current version. You can easily confirm whether any revisions have been posted since your last visit by checking the date on which the Policy was last revised, which is set forth at the bottom of this Policy. If you object to such changes, we will honor our prior privacy policies as to any data previously collected. If you disagree with the changes in our policy, however, please do not use the Site after the posting of such changes online. By using the Site following the posting of changes to this Privacy Policy, you agree to all such changes.
                                <br><br>
                            </li>
                            <li>
                                <p class="bold-text">Questions​ ​or​ ​Comments​ ​or​ ​to​ ​Contact​ ​Us</p>
                                <p>If you have questions or comments about this Privacy Policy, or you wish to access or make changes to information we have about you, please contact us at: 687-8877 or e-mail us at loyalty@unioil.com.</p>
                            </li>
                        </ol>
                    </div>
                    <form action="" id="privacy-form">
                        <div class="privacy-field-group text-center">
                            <input type="checkbox" class="privacy-field" id="privacy-agree" data-fieldtype="checkbox" />
                            <label for="privacy-agree" class="form-label">I have read the privacy and conditions stated and accept the stipulations included therein.</label>
                            <p class="error-msg"></p>
                        </div>
                        <div class="text-center">
                            <input type="button" data-dismiss="modal" id="privacy-cancel" value="CANCEL" />
                            <input type="submit" id="privacy-submit" value="SUBMIT" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav id="page-navbar" class="navbar navbar-toggleable-sm navbar-light bg-faded fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url()."loyalty";?>"><img src="<?php echo base_url();?>/assets_loyalty/images/unioil-loyalty-header-logo.png" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li id="home-link" class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url()."loyalty";?>">HOME</a>
                </li>
                 <li id="privlink" class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()."loyalty/profile";?>">PROFILE</a>
                </li>
                <li id="about-link" class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()."loyalty/faq";?>">FAQs</a>
                </li>
                <li id="account-control-link" class="nav-item">
                    <div class="login-button-container">
                        <a class="nav-link" data-toggle="modal" href="#privacy-modal">LOG IN</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>