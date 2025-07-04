<template lang="">
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <h5 class="card-title m-0 me-2">ໝວດໝູ່ ສິນຄ້າ</h5>
          <button type="button" class="btn rounded-pill btn-icon btn-primary" @click="ShowCategoryModal()">
                <i class='bx bx-plus'></i>
                </button>
        </div>
        <div class="card-body pt-4">
          <ul class="p-0 m-0">
            <li class="d-flex align-items-center mb-6" v-for="item in CategoryData" :key="item.id"> 
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="fw-normal mb-0">{{ item.CategoryName }}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-2">
                  <i class='bx bxs-edit fs-5 text-danger cursor-pointer' @click="EditCategory(item.id)"></i> | <i class='bx bx-trash-alt fs-5 cursor-pointer' @click="DeleteCategory(item.id)"></i>
                </div>
              </div>
            </li>
            
            <hr>
             <button @click="showAlert">Hello world</button>

          </ul>
        </div>
      </div>
        </div>
    </div>

    <div class="modal modal-top fade" id="AddCategoryModal" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog">
                    <form class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTopTitle">ໝວດໝູ່ສິນຄ້າ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-6">
                            <label for="nameSlideTop" class="form-label">ຊື່ໝວດໝູ່</label>
                            <input type="text" id="nameSlideTop" v-model="CategoryName" class="form-control" placeholder=".....">
                          </div>
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">ປິດ</button>
                        <button type="button" class="btn btn-primary" @click="SaveCategory()">ບັນທຶກ</button>
                      </div>
                    </form>
                  </div>
                </div>

</template>
<script>



import { useStore } from '../Store/auth';

export default {
    setup(){
        const store = useStore();
        return { store }
    },
    data() {
        return {
            CategoryData: [],
            CategoryName: '',
            FormType: true,
            EditID: null,
        }
    },
    methods: {
        // Add your methods here
        showAlert() {
      // Use sweetalert2
      this.$swal({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 2500
      });
    },
        ShowCategoryModal() {
            const modal = new bootstrap.Modal(document.getElementById('AddCategoryModal'));
            modal.show();
        },
        EditCategory(id) {
           
            this.FormType = false; // Set to false for edit mode
            this.EditID = id; // Store the ID of the category being edited

            axios.get(`/api/category/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.getToken }})
                .then(response => {
                    this.CategoryName = response.data.CategoryName; // Set the category name to the input field
                    const modal = new bootstrap.Modal(document.getElementById('AddCategoryModal'));
                    modal.show(); // Show the modal for editing
                })
                .catch(error => {
                    console.log(error.response.status);
                    if(error){
                        if(error.response.status === 401){
                            // clear localstorage
                            localStorage.removeItem('web_token');
                            localStorage.removeItem('web_user');

                            // clear token
                            this.store.logOut();

                            // go to login
                            this.$router.push('/login');
                        }
                    }
                });

        },
        SaveCategory(){
            
            if(this.FormType){
                // Save new category
                // console.log('Saving new category:', this.CategoryName);
                axios.post('/api/category/add', {
                    CategoryName: this.CategoryName
                },{ headers: { Authorization: 'Bearer ' + this.store.getToken }}).then(response => {
                    if(response.data.success) {

                        this.CategoryName = ''; // Clear input after saving
                        // close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('AddCategoryModal'));
                        modal.hide();

                        // update the category list
                        this.GetCategory(); // Fetch categories again to update the list

                        this.$swal({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 2500
                        });

                    } else {
                        // console.error('Error saving category:', response.data.message);

                        this.$swal({
                                position: "center",
                                icon: "error",
                                title: "Error",
                                text: response.data.message,
                                timer: 5500
                        });
                    }
        
                    
                }).catch(error => {
                    console.log(error.response.status);
                    if(error){
                        if(error.response.status === 401){
                            // clear localstorage
                            localStorage.removeItem('web_token');
                            localStorage.removeItem('web_user');

                            // clear token
                            this.store.logOut();

                            // go to login
                            this.$router.push('/login');
                        }
                    }
                });
            } else {
                // Update existing category
                // console.log('Updating category:', this.CategoryName);
                axios.post(`/api/category/update/${this.EditID}`, {
                    CategoryName: this.CategoryName
                },{ headers: { Authorization: 'Bearer ' + this.store.getToken }}).then(response => {
                    
                    if(response.data.success) {

                        this.CategoryName = ''; // Clear input after saving
                        // close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('AddCategoryModal'));
                        modal.hide();

                        // update the category list
                        this.GetCategory(); // Fetch categories again to update the list

                        this.$swal({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 2500
                        });

                    } else {

                       this.$swal({
                                position: "center",
                                icon: "error",
                                title: "Error",
                                text: response.data.message,
                                timer: 5500
                        });
                    }

                }).catch(error => {
                    console.log(error.response.status);
                    if(error){
                        if(error.response.status === 401){
                            // clear localstorage
                            localStorage.removeItem('web_token');
                            localStorage.removeItem('web_user');

                            // clear token
                            this.store.logOut();

                            // go to login
                            this.$router.push('/login');
                        }
                    }
                });
            }
        },
        DeleteCategory(id) {


            this.$swal({
                title: "ທ່ານແນ່ໃຈບໍ່?",
                text: "ທີ່ຈະລຶບຂໍ້ມູນນີ້.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ຕົກລົງ",
                cancelButtonText: "ຍົກເລີກ"
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        axios.delete(`/api/category/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.getToken }}).then(response=>{
                                if(response.data.success){
                                    this.GetCategory();
                                    this.$swal({
                                            toast: true,
                                            position: "top-end",
                                            icon: "success",
                                            title: response.data.message,
                                            showConfirmButton: false,
                                            timer: 2500
                                    });
                                } else{
                                    this.$swal({
                                            position: "center",
                                            icon: "error",
                                            title: "Error",
                                            text: response.data.message,
                                            timer: 5500
                                    });
                                }

                            }).catch(error => {
                                console.log(error.response.status);
                                    if(error){
                                        if(error.response.status === 401){
                                            localStorage.removeItem('web_token');
                                            localStorage.removeItem('web_user');
                                            this.store.logOut();
                                            this.$router.push('/login');
                                        }
                                    }
                            });
                    
                    }
                });



            
        },
        GetCategory() {
            axios.get('/api/category',{ headers: { Authorization: 'Bearer ' + this.store.getToken }}).then(response => {
                    this.CategoryData = response.data;
                })
                .catch(error => {
                    console.log(error.response.status);
                    if(error){
                        if(error.response.status === 401){
                            // clear localstorage
                            localStorage.removeItem('web_token');
                            localStorage.removeItem('web_user');

                            // clear token
                            this.store.logOut();

                            // go to login
                            this.$router.push('/login');
                        }
                    }
                });
        },
        
    },
    created() {
            this.GetCategory(); // Fetch categories when the component is created
        }
}
</script>
<style lang="">
    
</style>