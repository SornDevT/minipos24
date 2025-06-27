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

            <p class="mb-6">ລົງທະບຽນບັນຊີຜູ້ໃຊ້ໃໝ່</p>

            <div class="mb-6">
                <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="...." >
              </div>

              <div class="mb-6">
                <label for="email" class="form-label">ອີເມວລ໌:</label>
                <input type="text" class="form-control" id="email" name="email-username" placeholder="...." >
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
               <div class="mb-6 form-password-toggle">
                <label class="form-label" for="confirm-password">ຢືນຢັນລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password" class="form-control" name="confirm-password" placeholder="············" aria-describedby="confirm-password">
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
            
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit">ລົງທະບຽນບັນຊີຜູ້ໃຊ້ໃໝ່</button>
              </div>


            <p class="text-center">
              <span>ມີບັນຊີແລ້ວ?</span>
              <router-link to="/login" >
                <span>ເຂົ້າສູ່ບັນຊີ</span>
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