<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Medical Inquiry</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">


                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group-sm">

                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>
                    <a onclick="NewWindow('search_medical_inquiry.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                   

                    <a onclick="sess_chk('labform', 'crn');" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a>

                     <a onclick="cancel();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span> &nbsp; CANCEL
                    </a>

                    <a onclick="NewWindow('search_medical_print.php?stname=miq', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                 
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Ref No.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="refno_txt" class="form-control  input-sm" disabled="">
                        </div>

                         <label class="col-sm-1" for="c_code">Passport</label>
                        <div class="col-sm-2">
						   <input type="text" placeholder=""  id="pportno_txt" class="form-control  input-sm">
                           
                        </div>
                          <label class="col-sm-1" for="c_code">Country</label>

                        <div class="col-sm-2">
						   <input type="text" placeholder=""  id="cou_name_txt" class="form-control  input-sm">
                          
                        </div>

                        <div class="col-sm-2">
                            <a onfocus="this.blur()" onclick="NewWindow('search_country_dtls.php', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-danger">
                                    <span>...</span>
                                </button>
                            </a>
                        </div>

                         <div class="col-sm-2">
                            <input type="text" placeholder="Country" id="country_txt" class="form-control hidden  input-sm">
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                       
                        <label class="col-sm-1" for="c_code">GAMCA NO</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="gamca_txt" class="form-control  input-sm">
                        </div>

                        <label class="col-sm-1" for="c_code">E NO</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="eno_txt" class="form-control  input-sm">
                        </div>
                         <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-2">

                            <input type="date" placeholder="Date" name="date_txt" id="date_txt" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                       

                        <label class="col-sm-1" for="c_code">XRay No.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="xrayno_txt" class="form-control  input-sm">
                        </div>

                        <label class="col-sm-1" for="c_code">Sub Name</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="subname_txt" class="form-control  input-sm">
                        </div>
                         <label class="col-sm-1" for="c_code">Medical Name</label>
                        <div class="col-sm-2">
                            <?php
                            echo"<select id = \"name_txt\" class =\"form-control input-sm\">";
                            $sql = "select * from rege";
                            foreach ($conn->query($sql) as $row) {
                                echo "<b><option value='" . $row["medName"] . "'>" . $row["medName"] . "</option></b>";
                            }
                            echo"</select>";
                            ?>
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                       
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for='c_code'>Sex</label>
                        <div class='col-sm-2'>
                            <select id="sex_txt" class="form-control  input-sm">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <label class="col-sm-1" for='c_code'>Status</label>

                        <div class="col-sm-2">
                           <select id="status_txt" class="form-control  input-sm">
                                <option value="Married">Married</option>
                                <option value="UnMarried">UnMarried</option>
                            </select>
                        </div>
                        <label class="col-sm-1" for="invno">Agency</label>
                        <div class="col-sm-2">
                            <?php
                            echo"<select id = \"agency_txt\" class =\"form-control input-sm\">";
                            $sql = "select * from agency";
                            foreach ($conn->query($sql) as $row) {
                                echo "<b><option value='" . $row["medicaltype"] . "'>" . $row["medicaltype"] . "</option></b>";
                            }
                            echo"</select>";
                            ?>
                        </div>
                    </div>



                    <div class="form-group"></div>
                    <div class="form-group-sm">
                      
                        
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for='c_code'>Age</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="age_txt" class="form-control  input-sm">
                        </div>


                        <label class="col-sm-1" for='c_code'>Cust.Remarks</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="custrem_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group"></div>
                    <div class="form-group">
                         
                           <label class="col-sm-1" for='c_code'>Add Remark1</label>
                      
                        <div class="col-sm-8">
                            <input type="text" placeholder=""  id="doctor1_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div>
                    <div class="form-group">
                         
                           <label class="col-sm-1" for='c_code'>Add Remark2</label>
                    
                        <div class="col-sm-8">
                            <input type="text" placeholder=""  id="doctor2_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                                    
                    </div> <div class="form-group">
                         
                           <label class="col-sm-1" for='c_code'>Add Remark3</label>

                                    
                       <div class="col-sm-8">
                            <input type="text" placeholder=""  id="doctor3_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    
                    </div> <div class="form-group">
                         
                           <label class="col-sm-1" for='c_code'>Remark 1(NP)</label>
                             
                        <div class="col-sm-8">
                            <input type="text" placeholder=""  id="doctor4_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div> <div class="form-group">
                         
                           <label class="col-sm-1" for='c_code'>Remark 2(NP)</label>
                    
                        <div class="col-sm-8">
                            <input type="text" placeholder=""  id="doctor5_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div>
                   

                    <div class="form-group"></div>
                    <div class="form-group">
                        <label class="col-sm-1" for='c_code'>Lab</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="lab1_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="lab2_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    
                     
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="lab3_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group">
                        <label class="col-sm-1" for='c_code'>X-Ray</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="xray1_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                                      
                    <div class="col-sm-2">
                            <input type="text" placeholder=""  id="xray2_txt" class="form-control  input-sm">
                            <!--hidden-->
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>

</section>
<script src="js/medical_inquiry.js"></script>
 <!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>  -->


<script>newent();</script>




