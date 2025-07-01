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
              <!-- {{ username }} -->
                <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້:</label>
                <input type="text" class="form-control" v-model="username" id="username" name="username" placeholder="...." >
              </div>

              <div class="mb-6">
                <label for="email" class="form-label">ອີເມວລ໌:</label>
                <input type="text" class="form-control" v-model="email" id="email" name="email-username" placeholder="...." >
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">ລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" v-model="password" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
               <div class="mb-6 form-password-toggle">
                <label class="form-label" for="confirm-password">ຢືນຢັນລະຫັດຜ່ານ:</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password" class="form-control" v-model="confirmPassword" name="confirm-password" placeholder="············" aria-describedby="confirm-password">
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>

              <div class="alert alert-warning" role="alert" v-if="message_error" > {{ message_error }} </div>
            
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" @click="register()" type="submit">ລົງທະບຽນບັນຊີຜູ້ໃຊ້ໃໝ່</button>
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
    data() {
      return {
        username: '',
        email: '',
        password: '',
        confirmPassword: '',
        message_error: '',
      }
    },
    methods: {
      register() {
        // console.log('Click Register Button');
          if(!this.username || !this.email || !this.password || !this.confirmPassword) {
            this.message_error = 'ກະລຸນາໃສ່ຂໍ້ມູນທັງໝົດ';
            return;
          } else if (this.password !== this.confirmPassword) {
            this.message_error = 'ລະຫັດຜ່ານທີ່ໃສ່ບໍ່ກົງ';
            return;
          } else {
            this.message_error = '';

            // Proceed with registration logic
            axios.post('/api/register', {
              UserName: this.username,
              Email: this.email,
              Password: this.password,
            }).then(response => {
              
              console.log(response);

              if(response.data.success){
                // Handle successful registration
                this.$router.push('/login');
                this.message_error = '';

              } else {
                // Handle registration error
                this.message_error = response.data.message;
              }

            }).catch(error => {
              // Handle registration error
              console.error('Registration error:', error);
              this.message_error = error.response.data.message;
            });

          }
      }
    }
}
</script>
<style lang="">
    
</style>