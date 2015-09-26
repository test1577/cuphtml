<!-- login facebook -->
<script src="{{ $global['baseUrl'] }}frontend/assets/service/facebook.js"></script>
<div class="body" ng-controller="LoginCtrl">
  <div class="container">

    <!--Login-->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="tab-left">
        <div class="section">
          <button type="button" class="btn-section btn-highlight actived btn btn-default btn-xs" aria-label="Left Align">
            <h4 class="topic"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i> Login</h4>
          </button>
          <hr>
          <form class="form-horizontal" ng-submit="LoginCtrl.event.login()">
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.1s">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="username" placeholder="Email" ng-model="LoginCtrl.model.formLogin.email" required>
              </div>
            </div>
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.2s">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Password" ng-model="LoginCtrl.model.formLogin.password" required>
              </div>
            </div>
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.3s">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" ng-model="LoginCtrl.model.formLogin.isRemember"> Remember me
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.4s">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Login</button>
              </div>
            </div>
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.5s">
              <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block" onclick="javascript:facebookLogin()"><i class="fa fa-facebook"></i> Fackbook</button>
              </div>
            </div>
            <div class="form-group wow fadeInDown animated" data-wow-delay="0.6s">
              <div class="col-sm-12">
                <button type="button" class="btn btn-info btn-block" onclick="javascript:checkLoginState()"><i class="fa fa-twitter"></i> Twitter</button>
              </div>
            </div>
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" style="display:none;">
            </fb:login-button>
<!--            <div id="status">
            </div>-->
          </form>
          <hr>
        </div>
      </div>
    </div>

  </div>
</div>
