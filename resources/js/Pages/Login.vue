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
                <input type="text" class="form-control" v-model="email" id="email" name="email-username" placeholder="...." autofocus="">
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input :type="showPassword" id="password" class="form-control" v-model="password" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer" @click="showPassword = showPassword === 'password' ? 'text' : 'password'">
                    <i class="icon-base bx bx-hide" v-if="showPassword === 'password'"></i>
                    <i class="icon-base bx bx-show" v-else></i>
                    </span>
                </div>
              </div>
              <div class="mb-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" v-model="rememberMe" id="remember-me">
                    <label class="form-check-label" for="remember-me"> ຈື່ຂ້ອຍໄວ້ໃນລະບົບ </label>
                  </div>
             
                </div>
              </div>
               <div class="alert alert-warning" role="alert" v-if="message_error || message_email || message_password" > {{ message_error }} {{ message_email }} {{ message_password }} </div>

              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" :disabled="isFormValid" type="submit" @click="login()">ເຂົ້າສູ່ລະບົບ</button>
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
    data() {
      return {
        email: '',
        password: '',
        rememberMe: false,
        message_email: '',
        message_password: '',
        message_error: '',
        showPassword: 'password'
      }
    },
    computed: {
      isFormValid() {
        // Check email 
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // email regex pattern: sone@mail.com
        if(this.email){
          if(!emailPattern.test(this.email)){
            this.message_email = 'ອີເມວລ໌ບໍ່ຖືກຕາມຮູບແບບ';
          } else {
            this.message_email = '';
          }
        } else {
          this.message_email = '';
        }

        // Check password
        if(this.password){
          if(this.password.length < 6){
            this.message_password = ' ລະຫັດຜ່ານຕ້ອງມີ 6 ອັກສອນຂຶ້ນໄປ';
          } else {
            this.message_password = '';
          }
        } else {
          this.message_password = '';
        }
        
        // Check if both email and password are valid
        if(!emailPattern.test(this.email) || this.password.length < 6) {
          return true; // Disable the button if form is invalid
        } else {
          return false; // Enable the button if form is valid
        }
      }
    },
    methods: {

      login() {
        axios.post('/api/login', {
          email: this.email,
          password: this.password,
          remember_me: this.rememberMe
        })
        .then(response => {

          console.log(response);
          if(response.data.success) {
            // Handle successful login

            // Store the token in localStorage
            localStorage.setItem('web_token', response.data.token);
            localStorage.setItem('web_user', JSON.stringify(response.data.user));
            // Redirect to the home page
            this.$router.push('/');
            this.message_error = '';
          } else {
            // Handle login error
            this.message_error = response.data.message;
          }
       
        })
        .catch(error => {
          // Handle login error
          console.error('Login error:', error);
          this.message_error = error.response.data.message;
        });
      }
    }
}
</script>
<style lang="">
    
</style>