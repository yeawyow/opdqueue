<?php $this->load->view('header');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Module</h1>
          <p>หน้าจอทำงานต่างๆ</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">โมดูล</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-6">
        <a href="<?php echo base_url();?>index.php/DisplayWaitScreen">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            
            <div class="info">
              <h4>แสดงคิวรอซักประวัติ</h4>
              <p>จากห้องบัดร หรือ KIOS ส่งตรวจ</p>
            </div>
            
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
              <div class="info">
                <h4>เรียกซักประวัติใช้หน้าเรียกคิวของ HOSxP</h4>
              </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/DisplayWaitExamination">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>แสดงคิวรอพบแพทย์</h4>
              <p>จากพยาบาลซักประวัติ</p>
            </div>
          </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/ContronDisplayWaitExamination">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
              <div class="info">
                <h4>เรียกเข้าห้องตรวจ</h4>
                <p>เรียกพบแพทย์</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/DisplayWaitPhamacy">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>แสดงคิวรอรับยา มอนิเตอร์ 1</h4>
                <p>เครื่องรับใบยาที่ 1</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/ControlDisplayWaitPhamacy">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
                <div class="info">
                  <h4>เรียกรับยา 1 </h4>
                  <p>จากเภสัชกรรับใบสั่งยา</p>
                </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/DisplayWaitPhamacy2">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                  <h4>แสดงคิวรอรับยา มอนิเตอร์ 2 </h4>
                  <p>เครื่องรับใบยาที่ 2</p>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/ControlDisplayWaitPhamacy2">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
                <div class="info">
                  <h4>เรียกรับยา 2 </h4>
                  <p>จากเภสัชกรรับใบสั่งยา</p>
                </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <a href="<?php echo base_url();?>index.php/DisplayWaitScreenNCD">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                  <h4>แสดงคิวรอซักประวัติคลินิกพิเศษ </h4>
                  <p>จากห้องบัดร หรือ KIOS ส่งตรวจ</p>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
          <a href="#">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
                <div class="info">
                  <h4>เรียกซักประวัติใช้หน้าเรียกคิวของ HOSxP</h4>
                </div>
            </div>
          </a>
        </div>


      </div>
     
    
    </main>
  <?php $this->load->view('footer');?>