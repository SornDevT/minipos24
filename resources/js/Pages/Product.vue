<template lang="">

    <Dashgrap />
    <div class="card">
    <h5 class="card-header">ລາຍການສິນຄ້າ</h5>
    <div class="card-body">

<!-- {{FormProduct}} -->
        <div v-if="ShowForm">
            <div class="row"> 
                <div class="col-md-4" style="position: relative;">
                    <button type="button" class="btn rounded-pill btn-icon btn-danger btrm" v-if="FormProduct.ImagePath" @click="RemoveImage()">
                        <i class='bx bx-x-circle'></i>
                    </button>
                    <img :src="ImagePreview" @click="$refs.img_upload.click()" class="img-fluid mb-2 cursor-pointer" alt="Product Image" />

                    <input type="file" accept="image/*" @change="onSelect($event)" ref="img_upload" style="display: none;" class="form-control mb-2" id="image" >
                </div>
                <div class="col-md-8">
                     <!-- {{FormProduct}}  -->
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
                            <Cleave :options="options" class="form-control" v-model="FormProduct.Qty" id="quantity" placeholder="ປ້ອນຈຳນວນ" />
                        </div>
                        <div class="col-md-6 mb-2">
                        
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price">ລາຄາຊື້</label>
                            <Cleave :options="options" class="form-control" v-model="FormProduct.PriceBuy" id="price" placeholder="ປ້ອນລາຄາ"/>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price">ລາຄາຂາຍ</label>
                            <Cleave :options="options"  class="form-control" v-model="FormProduct.PriceSell" id="price" placeholder="ປ້ອນລາຄາ"/>
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
          <!-- {{Sort}} -->
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <div class=" me-2 cursor-pointer" @click="Sort = Sort === 'asc' ? 'desc' : 'asc'">
                    <i class='bx bx-sort-up fs-4' v-if="Sort === 'asc'"></i>
                    <i class='bx bx-sort-down fs-4' v-else></i>
                </div>
                <select v-model="PerPage" class="form-select w-auto me-2" >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>

                <select class="form-select w-auto" v-model="SeclectCategoryID" @change="GetAllProduct(1)">
                <option value="all">-- ທັງໝົດ --</option>
                <option :value="item.id" v-for="item in CategoryData" :key="item.id">{{ item.CategoryName }}</option>
                </select>

            </div>
            <div class="col-md-6 mb-2 d-flex justify-content-end">
                <div class="input-group w-auto me-2">
                    <input type="text" class="form-control" v-model="Search" @keyup.enter="GetAllProduct(1)" placeholder="ຄົ້ນຫາ..." >
                    <button class="btn btn-primary px-3" type="button" @click="GetAllProduct(1)"><i class='bx bx-search fs-5' ></i></button>
                </div>

                <button type="button" class="btn btn-info" @click="AddProduct()">ເພີ່ມຂໍ້ມູນ</button>

            </div>
        </div>

      <div class="table-responsive text-nowrap">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center" width="120">ຮູບພາບ</th>
              <th>ຊື່ສິນຄ້າ</th>
              <th >ໝວດໝູ່</th>
              <th class="text-center">ຈຳນວນ</th>
              <th class="text-end">ລາຄາຊື້</th>
              <th class="text-center">ຈັດການ</th>
            </tr>
          </thead>
          <tbody> 
            <tr v-for="item in ProductData.data" :key="item.id">
              <td>{{ item.id }}</td>
              <td class="text-center">
                    <img :src="item.ImagePath" v-if="item.ImagePath" alt="Product Image " class="img-fluid img_list text-center" />

                    <img :src="url+'/assets/img/no_img.png'" v-else alt="Product Image" class="img-fluid img_list text-center" />

                 </td>
              <td>{{ item.ProductName }}</td>
              <td>{{ item.CategoryName }}</td>
              <td class="text-center">{{ FormatPrice(item.Qty) }}</td>
              <td class="text-end">{{ FormatPrice(item.PriceBuy) }} ກີບ</td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item text-info" href="javascript:void(0);" @click="EditProduct(item.id)"><i class="icon-base bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                    <a class="dropdown-item text-danger" href="javascript:void(0);" @click="DeleteProduct(item.id)"><i class="icon-base bx bx-trash me-1"></i> ລົບ</a>
                  </div>
                </div>
              </td>
            </tr>
            
          </tbody>
        </table>

        <Pagination :pagination="ProductData" :offset="4" @paginate="GetAllProduct($event)" />

      </div>
      </div>



    </div>
  </div>
</template>
<script>

import axios from 'axios';
import { useStore } from '../Store/auth';
import Cleave from 'vue-cleave-component';
import Dashgrap from '../Components/Dashgrap.vue';

export default {
    setup() {
        const store = useStore();
        return { store };
    },
    data() {
        return {
            url: window.location.origin,
            ImagePreview: window.location.origin+'/assets/img/img-upload.jpg', // For image preview
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
            SeclectCategoryID: 'all',
            PerPage: 10, // Default items per page
            Sort: 'desc',
            Search:'',
            options: {
                  numeral: true,
                  numeralPositiveOnly: true,
                  noImmediatePrefix: true,
                  rawValueTrimPrefix: true,
                  numeralIntegerScale: 10,
                  numeralDecimalScale: 2,
                  numeralDecimalMark: '.',
                  delimiter: ','
                }
        }
    },
    components: {
        Cleave, Dashgrap
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
        RemoveImage(){
            this.ImagePreview = window.location.origin+'/assets/img/img-upload.jpg';
            this.FormProduct.ImagePath = '';
        },
        onSelect(e){
            console.log(e);
            if (e.target.files && e.target.files[0]) {  
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.ImagePreview = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
                this.FormProduct.ImagePath = e.target.files[0]; // Store the file in FormProduct
            } else {
                this.ImagePreview = window.location.origin+'/assets/img/img-upload.jpg'; // Reset to default image
                this.FormProduct.ImagePath = ''; // Reset the file in FormProduct
            }
        },
        FormatPrice(value) {
             let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
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
                this.ImagePreview = window.location.origin+'/assets/img/img-upload.jpg';

        },
        CancelAddProduct(){
            this.ShowForm = false;
        
        },
        EditProduct(id){
            this.EditID = id;
            // Add your logic to edit a product
            axios.get(`/api/product/edit/${id}`, { headers: { Authorization: `Bearer ${this.store.getToken}` }
            }).then(response => {
      
                    this.FormProduct = response.data;
                    this.ShowForm = true;
                    this.FormType = false; // Set to update mode

                    this.ImagePreview = response.data.ImagePath ? response.data.ImagePath : window.location.origin+'/assets/img/img-upload.jpg';
          
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
        SaveProduct(){

            if(this.FormType) {
                // Add new product
                axios.post('/api/product/add', this.FormProduct, { headers: { "Content-Type": "multipart/form-data", Authorization: `Bearer ${this.store.getToken}` }
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
                axios.post(`/api/product/update/${this.EditID}`, this.FormProduct, { headers: { "Content-Type": "multipart/form-data", Authorization: `Bearer ${this.store.getToken}` }
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
                        
                        axios.delete(`/api/product/delete/${id}`, { headers: { Authorization: `Bearer ${this.store.getToken}` }
                        }).then(response => {
                            if(response.data.success) {
                                this.GetAllProduct();
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
                });
        },
        GetAllProduct(page = 1) {

            axios.get(`/api/product?page=${page}&perpage=${this.PerPage}&sort=${this.Sort}&category_id=${this.SeclectCategoryID}&search=${this.Search}`, { headers: { Authorization: `Bearer ${this.store.getToken}` }
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
    watch: {
        PerPage() {
            this.GetAllProduct(1);
        },
        Sort() {
            this.GetAllProduct(1);
        },
        Search(val) {
            if ( val.length === 0) {
                this.GetAllProduct(1);
            }
     
        }
    }
}
</script>
<style >
    .img_list {
        width: 80px;
        height: 80px;
        object-fit: cover;
        object-position: center;
        border-radius: 5px;
    }   

    .btrm{
        position: absolute;
        top: 15px;
        right: 25px;
    }
</style>