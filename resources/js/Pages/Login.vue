<template lang="">

    <div class="row d-flex justify-content-center">

   

    <div class="col-md-6 col-lg-4  authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
           
               
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1">ສະບາຍດີ! 👋</h4>
            <p class="mb-6">ກະລຸນາເຂົ້າສູ່ບັນຊີຂອງເຈົ້າ ແລະ ເລີ່ມນຳໃຊ້ລະບົບ</p>

           
              <div class="mb-6">
                <label for="email" class="form-label">ອີເມວລ໌:</label>
                <input type="text" class="form-control" id="email" name="email-username" placeholder="...." autofocus="">
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember-me">
                    <label class="form-check-label" for="remember-me"> ຈື່ຂ້ອຍໄວ້ໃນລະບົບ </label>
                  </div>
             
                </div>
              </div>
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit">ເຂົ້າສູ່ລະບົບ</button>
              </div>


            <p class="text-center">
              <span>ບໍ່ມີບັນຊີຜູ້ໃຊ້ເທື່ອ?</span>
              <router-link to="/register" >
                <span>ສ້າງບັນຊີໃໝ່</span>
              </router-link>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>

     </div>
     
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>