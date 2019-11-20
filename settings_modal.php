<style>
  #setting_modal_body{
    padding: 20px 30px 30px;
    color: #666;
  }
  #setting_modal_body label{
    font-family: Roboto;
    font-weight: 600;
    font-size: 16px;
  }
  .sub-divs{
    text-align: center;
    font-size: 14px;
  }
  .sub-divs1{
    text-align: left;
    font-size: 14px;
  }
  .setting-rows{
    margin-bottom: 8px;
  }
  .color-div-circles{
    width: 90%;
    display: flex;
    margin: 10px auto; 
  }
  .color-circles{
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin: 0 auto;
  }
  #color1{background-color: #212733;}
  #color2{background-color: #800000;}
  #color3{background-color: #1E90FF;}
  #color4{background-color: #006400;}
  #color5{background-color: #DC143C;}
  #color1-1{background-color: #1ec28a;}
  #color2-1{background-color: #c21e56;}
  #color3-1{background-color: #DAA520;}
  #color4-1{background-color: #9ACD32;}
  #color5-1{background-color: #9932CC;}
  #color1:hover, #color2:hover, #color3:hover, #color4:hover, #color5:hover, #color6:hover, #color7:hover, #color8:hover, #color1-1:hover, #color2-1:hover, #color3-1:hover, #color4-1:hover, #color5-1:hover, #color6-1:hover, #color7-1:hover, #color8-1:hover{
    border: 3px solid #cccc;
    cursor: pointer;
  }
  /*//////////////////////////custom check status button//////////////////////////////////////////*/
.custom_check_settings {
  color: #c21e56;
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.custom_check_settings input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}
.custom_check_settings .checkmark {
    position: absolute;
    top: 2px;
    left: 17px;
    height: 17px;
    width: 17px;
    background-color: #ccc;
    border-radius: 2px;
    box-shadow: inset 0px 3px 3px rgba(0, 0, 0, 0.5), 0px 1px 0px rgba(255, 255, 255, 0.4);
}
.custom_check_settings:hover input ~ .checkmark {
    background-color: #bbb;
}
.custom_check_settings input:checked ~ .checkmark {
    background-color: #c21e56;
}
.custom_check_settings .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}
.custom_check_settings input:checked ~ .checkmark:after {
    display: block;
}
.custom_check_settings .checkmark:after {
    left: 5.4px;
    top: 2px;
    width: 6.3px;
    height: 11px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<div class="modal fade" id="setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-cog fa-lg"></i> Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>
      <div class="modal-body" id="setting_modal_body">
        <label>Appearance</label>
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6 sub-divs">
            Side Panel background
            <div class="color-div-circles">
              <div class="color-circles" id="color1"></div>
              <div class="color-circles" id="color2"></div>
              <div class="color-circles" id="color3"></div>
              <div class="color-circles" id="color4"></div>
              <div class="color-circles" id="color5"></div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 sub-divs">
            Header background
            <div class="color-div-circles">
              <div class="color-circles" id="color1-1"></div>
              <div class="color-circles" id="color2-1"></div>
              <div class="color-circles" id="color3-1"></div>
              <div class="color-circles" id="color4-1"></div>
              <div class="color-circles" id="color5-1"></div>
            </div>
          </div>
        </div>
        <hr>
        <label>Other settings</label>
        <div class="row setting-rows">
          <div class="col-sm-10 col-md-10 col-lg-10 sub-divs1">
            Enable side panel toggle button
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2">
            <label class="custom_check_settings">
              <input type="checkbox" name="check" id="toggle-en-btn">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
        <div class="row setting-rows">
          <div class="col-sm-10 col-md-10 col-lg-10 sub-divs1">
            Hide header title bar
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2">
            <label class="custom_check_settings">
              <input type="checkbox" name="check" id="title-hide-btn">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>