<template lang="">
    <div class="card">
    <h5 class="card-header">ລາຍການສິນຄ້າ</h5>
    <div class="card-body">


        <div v-if="ShowForm">
            <div class="row">
                <div class="col-md-4">
                    Image 
                </div>
                <div class="col-md-8">
                     <!-- {{FormProduct}} | {{CheckFormProduct}} -->
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name">ຊື່ສິນຄ້າ</label>
                            <input type="text" class="form-control" v-model="FormProduct.ProductName" id="name" placeholder="ປ້ອນຊື່ສິນຄ້າ">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label >ໝວດໝູ່</label>
                            <select class="form-select" v-model="FormProduct.CategoryID">
                                <option selected>ເລືອກໝວດໝູ່</option>
                                <option :value="item.id" v-for="item in CategoryData" :key="item.id">{{ item.CategoryName }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price">ຈຳນວນ</label>
                            <input type="text" class="form-control" v-model="FormProduct.Qty" id="quantity" placeholder="ປ້ອນຈຳນວນ">
                        </div>
                        <div class="col-md-6 mb-2">
                        
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price">ລາຄາຊື້</label>
                            <input type="text" class="form-control" v-model="FormProduct.PriceBuy" id="price" placeholder="ປ້ອນລາຄາ">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price">ລາຄາຂາຍ</label>
                            <input type="text" class="form-control" v-model="FormProduct.PriceSell" id="price" placeholder="ປ້ອນລາຄາ">
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="row">
                        <div class="col-md-12 mb-2 text-center mt-4">
                            <button type="button" class="btn btn-success me-2" :disabled="!CheckFormProduct" @click="SaveProduct()">ບັນທຶກ</button>
                            <button type="button" class="btn btn-danger" @click="CancelAddProduct()">ຍົກເລີກ</button>
                        </div>
                    </div>
        </div>

        <div v-else>
         <div class="row">
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <div class=" me-2">
                    <i class='bx bx-sort-up fs-4'></i>
                    <i class='bx bx-sort-down fs-4' ></i>
                </div>
                <select class="form-select w-auto me-2" >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>

                <select class="form-select w-auto">
                <option selected="">-- ທັງໝົດ --</option>
                <option :value="item.id" v-for="item in CategoryData" :key="item.id">{{ item.CategoryName }}</option>
                </select>

            </div>
            <div class="col-md-6 mb-2 d-flex justify-content-end">
                <div class="input-group w-auto me-2">
                    <input type="text" class="form-control" placeholder="ຄົ້ນຫາ..." >
                    <button class="btn btn-primary px-3" type="button" ><i class='bx bx-search fs-5' ></i></button>
                </div>

                <button type="button" class="btn btn-info" @click="AddProduct()">ເພີ່ມຂໍ້ມູນ</button>

            </div>
        </div>

      <div class="table-responsive text-nowrap">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span></td>
              <td>Albert Cook</td>
              <td>
                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td>
              <td><span class="badge bg-label-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><i class="icon-base bx bxl-react icon-md text-info me-4"></i> <span>React Project</span></td>
              <td>Barry Hunter</td>
              <td>
                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td>
              <td><span class="badge bg-label-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><i class="icon-base bx bxl-vuejs icon-md text-success me-4"></i> <span>VueJs Project</span></td>
              <td>Trevor Baker</td>
              <td>
                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td>
              <td><span class="badge bg-label-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><i class="icon-base bx bxl-bootstrap icon-md text-primary me-4"></i> <span>Bootstrap Project</span></td>
              <td>Jerry Milton</td>
              <td>
                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td>
              <td><span class="badge bg-label-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>



    </div>
  </div>
</template>
<script>

import axios from 'axios';
import { useStore } from '../Store/auth';

export default {
    setup() {
        const store = useStore();
        return { store };
    },
    data() {
        return {
            CategoryData: [],
            ProductData: [],
            ShowForm: false,
            FormType: true, // true = add, false = update
            EditID: null, // ID of the product being edited
            FormProduct: {
                ProductName: '',
                CategoryID: '',
                ImagePath: '',
                Qty: '',
                PriceBuy: '',
                PriceSell: '',
            },
        }
    },
    computed: {
        CheckFormProduct() {
            return this.FormProduct.ProductName !== '' &&
                   this.FormProduct.CategoryID !== '' &&
                   this.FormProduct.Qty !== '' &&
                   this.FormProduct.PriceBuy !== '' &&
                   this.FormProduct.PriceSell !== '';
        },
    },
    methods:{
        AddProduct(){
           this.ShowForm = true;
           this.FormType = true; // Set to add mode

              this.FormProduct = {
                 ProductName: '',
                 CategoryID: '',
                 ImagePath: '',
                 Qty: '',
                 PriceBuy: '',
                 PriceSell: '',
                };

        },
        CancelAddProduct(){
            this.ShowForm = false;
        
        },
        EditProduct(id){
            this.EditID = id;
            // Add your logic to edit a product
  
        },
        SaveProduct(){

            if(this.FormType) {
                // Add new product
                axios.post('/api/product/add', this.FormProduct, { headers: { Authorization: `Bearer ${this.store.getToken}` }
                }).then(response => {
                    
                    if(response.data.success) {
                        this.GetAllProduct();
                        this.ShowForm = false;
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
                                            localStorage.removeItem('web_token');
                                            localStorage.removeItem('web_user');
                                            this.store.logOut();
                                            this.$router.push('/login');
                                        }
                                    }
                });
            } else {
                // Update existing product
                axios.post(`/api/product/update/${this.EditID}`, this.FormProduct, { headers: { Authorization: `Bearer ${this.store.getToken}` }
                }).then(response => {
                    if(response.data.success) {
                        this.GetAllProduct();
                        this.ShowForm = false;
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
                                            localStorage.removeItem('web_token');
                                            localStorage.removeItem('web_user');
                                            this.store.logOut();
                                            this.$router.push('/login');
                                        }
                                    }
                });
            }

        },
        DeleteProduct(id){
            // Add your logic to delete a product
        },
        GetAllProduct(){

            axios.get('/api/product', { headers: { Authorization: `Bearer ${this.store.getToken}` }
            }).then(response => {

                this.ProductData = response.data.products;
                this.CategoryData = response.data.category;

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

        },
    },
    created() {
        this.GetAllProduct();
    },
}
</script>
<style lang="">
    
</style>