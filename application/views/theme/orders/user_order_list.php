        <!--start of modal container-->
        <div class="container">
         
    </div><!-- end of modal container -->
    
    <!-- wrapper page -->
    <div class="wrapper">

      <!-- body-content -->
      <div class="body-content clearfix" >

        <div class="bg-color2">
          <div class="container">
            <div class="row">
              <div class="col-md-9">

                <!-- box listing -->
                <div class="block-section-sm box-list-area">
                  <div class="box-list">                  
                    <?php 
                     if(empty($orders)){
                         $orders=array();
                    }
                    foreach ($orders as $row) {
			    $now=date("Y-m-d h:i");
			    $datetime1 = new DateTime($row->created_at);
			    $datetime2 = new DateTime($now);
			    $interval = $datetime1->diff($datetime2);

			    $year = $interval->y;
			    $month= $interval->m;
			    $day= $interval->d;
			    $hour= $interval->h;
			    $min = $interval->i;

			    $timelag="";
			    if($year>0)
				    $timelag .= $year." yrs ";
			    if($month>0)
				    $timelag.=$month." mnths ";
			    if($day>0)
				    $timelag.=$day." days ";
			    if($hour>0)
				    $timelag.=$hour." hrs ";
			    if($min)
				    $timelag.=$min." min "; 
				    
			    //set deadline for each group i.e writers 60%, editor A 35% and Editor B 15% of total time
		            $endtime=0;    
		            $start = strtotime($row->created_at);
		            $end= strtotime($row->deadline);
		            if($this->session->userdata('groupid')==2)
	                    {
				    $inter=($end-$start)*0.6;
				    $endtime=$start+$inter;
		            }elseif($this->session->userdata('groupid')==3){
		                   $inter=($end-$start)*0.85;
		                   $endtime=$start+$inter;
		            }elseif($this->session->userdata('groupid')==4){
		                   $inter=($end-$start)*1;
		                   $endtime=$start+$inter;
		            }
		            $deadline=date("Y-m-d h:i:s",$endtime);
                 ?>
                    <!-- item list -->
                    <div class="item">
                      <div class="row">
                        <div class="col-md-1 hidden-sm hidden-xs"><div class="img-item"><img src="./assets/theme/images/company-logo/4.jpg" alt=""></div></div>
                        <div class="col-md-11">
                          <h3 class="no-margin-top"><a href="<?= base_url() ?>orders/all_orders/<?php echo $row->orderid; ?>" class=""><?php echo $row->subject.",  ".$row->papertype; ?></a></h3>
                          Topic: <B><?php echo $row->topic; ?></B><br>
                          by Client <B><?php echo $row->client; ?></B> 
                          <p class=""><?php echo $row->paper_instructions; ?></p>
                          <div>
                            <B>created: <?php echo $timelag; ?> <?php ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Deadline:<?php echo $deadline; ?></span><B>
                          </div>
                          <div style="text-align:right; "><a href="<?= base_url() ?>orders/load_papers/<?php echo $row->orderid; ?>" data-toggle="modal">View Papers</a></div>
                          <?php if($row->orderstatusid==1 or $row->orderstatusid==4){ ?>
                          <div style="text-align:right; "><a href="<?= base_url() ?>orders/submit_paper/<?php echo $row->orderid; ?>" data-toggle="modal">Submit Paper</a></div>
                          <?php if($this->session->userdata('groupid')==3 or $this->session->userdata('groupid')==4){ ?>
                          <div style="text-align:right; "><a href="<?= base_url() ?>orders/send_paper_for_revison/<?php echo $row->orderid; ?>" data-toggle="modal">Send Paper For Revision</a></div>
                          <?php } 
                          }
                          ?>
                        </div>
                      </div>
                    </div><!-- end item list -->
                    <?php } ?>
                  </div>
                </div><!-- end box listing -->


              </div>


      