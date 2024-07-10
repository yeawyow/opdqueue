<?php $this->load->view('header');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> โหลดไฟล์เสียง</h1>
          <p> </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">โหลดไฟล์เสียง</a></li>
        </ul>
      </div>
      <div class="row">
      <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form id="frm">
                    <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <button id ="num" class="btn btn-primary btn-lg btn-block" type="button">โหลดไฟล์เสียง</button>
                    </div>
                </form>
              </div>
              <div class="col-lg-6">
                
              </div>
             
            
            </div>
       <!--      <div class="tile-footer">
              <button class="btn btn-primary " type="submit" id ="submit">Submit</button>
            </div> -->
          </div>
        </div>
      </div>
    
    </main>

<?php $this->load->view('footer');?>