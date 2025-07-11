<template lang="">
    <div class="row">
        <div class="col-md-8">
                <div class=" card mb-2">
                    <div class="card-body">
                        <div class="d-flex">
                            <select class="form-select w-auto me-2">
                                <option selected="">Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="input-group ">
                            <input type="text" class="form-control"  placeholder="ຄົ້ນຫາ..." >
                            <button class="btn btn-primary px-3" type="button" ><i class='bx bx-search fs-5' ></i></button>
                        </div>
                        </div>
                    </div>

                </div>

                <PerfectScrollbar>
                <div class="row" style="height: 70vh;">
                            <div class="col-md-3" v-for="item in ProductData" :key="item">
                                <div class="card mt-4 cursor-pointer" @click="AddToList(item.id)" style="position: relative;">
                                    
                                    <span v-for="i in ListOrder" :key="i">
                                        <span class="onum" v-if="item.id == i.id" >{{ i.qty }}</span>
                                    </span>


                                    <span class="box-nostore" v-if="item.Qty<=0">ສິນຄ້າໝົດ!</span>
                                    <img class="card-img-top imgbox" :src=" url + '/' + item.ImagePath" v-if="item.ImagePath" alt="Card image cap">
                                    <img class="card-img-top imgbox" :src=" url + '/assets/img/no_img.png'" v-else alt="Card image cap">
                                    <div class="card-body p-1 text-center">
                                    <p class="card-text">{{item.ProductName}}</p>
                                    <p class="card-text">{{FormPrice(item.PriceSell)}} ກີບ</p>
                                    </div>
                                </div>
                            </div>
                </div>
                </PerfectScrollbar>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-4">
                        <label  class="form-label">ຊື່ລູກຄ້າ:</label>
                        <input type="text" class="form-control mb-2">

                        <label  class="form-label">ເບີໂທ:</label>
                        <input type="text" class="form-control">
                    </div>
                     <!-- {{ListOrder}} -->
                    <div class="p-4 bg-info text-white fw-bold">
                        ລາຍການສິນຄ້າ
                    </div>
                    <PerfectScrollbar>
                        <div style="height: 46vh; position: relative;"> 
                           
                            <div v-if="ListOrder.length==0" class=" text-muted fs-5" style="position: absolute; top: 50%; left: 42%; }">ບໍ່ມີລາຍການ</div>
                                <table class="table table-bordered">
                                        <tr v-for="item in ListOrder" :key="item">
                                            <td class="p-0 ">
                                                <div class="d-flex p-2">
                                                    <img :src="url + '/'+item.image" v-if="item.image" class=" img-fluid img-list">
                                                    <img :src="url + '/assets/img/no_img.png'" v-else class=" img-fluid img-list">
                                                    <div class="w-100 px-2">
                                                        <div>{{item.name}}</div>
                                                        <div class="text-end">{{item.qty}} x {{ FormPrice(item.price) }}</div>
                                                        <div class=" d-flex justify-content-between">
                                                            <span><i class='bx bxs-plus-circle text-info cursor-pointer' @click="AddToList(item.id)"></i> | <i class='bx bxs-minus-circle text-warning cursor-pointer' @click="RemoveFromList(item.id)"></i> | <i class='bx bxs-trash text-danger cursor-pointer' @click="DeleteFromList(item.id)" ></i></span>
                                                            <span>{{ FormPrice(item.qty*item.price) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                    </table>
                        </div>
                    
                    </PerfectScrollbar>
                    <div class="p-4 bg-info text-white fw-bold d-flex justify-content-between">
                        <span>
                            ລວມທັງໝົດ:
                        </span>
                        <span>
                            {{ FormPrice(SumTotal) }} ກີບ
                        </span>
                    </div>

                    <div class="p-2">
                        <button type="button" class="btn rounded-pill btn-success w-100 ">ຊຳລະເງິນ</button>
                    </div>

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
            url: window.location.origin,
            SeclectCategory:'all',
            CategoryData:[],
            ProductData:[],
            ListOrder:[]
        }
    },
    computed:{
        SumTotal(){
            return this.ListOrder.reduce((total,item)=>{
                return total + (item.price * item.qty)
            }, 0 );
        }
    },
    methods:{
         FormPrice(value) {
             let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        AddToList(id){

            console.log('add ID:'+id)

            let item = this.ProductData.find(i=>i.id === id); // ນຳ id ໄປຄົ້ນຫາ ຂໍ້ມູນ ຢູ່ໃນ ProductData

            console.log('Data:'+item)

            let old_item = this.ListOrder.find(i=>i.id === id)

            if(item.Qty<=0){
                 this.$swal({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: 'ສິນຄ້າບໍ່ມີໃນສະຕ໋ອກ',
                    timer: 5500
                });
                return
            }


            if(old_item){
                old_item.qty++
                return
            }

            // add to order list
            this.ListOrder.push(
                    {
                        id: item.id,
                        name: item.ProductName,
                        price: item.PriceSell,
                        image: item.ImagePath,
                        qty: 1
                    }
            );

        },
        RemoveFromList(id){
            let item = this.ListOrder.find(i=>i.id === id)
            if(item){
                if(item.qty>1){
                    item.qty--
                } else {
                    // remove 
                    this.ListOrder = this.ListOrder.filter(i=>i.id !== id)
                }
            }
        },
        DeleteFromList(id){
            // remove 
                    this.ListOrder = this.ListOrder.filter(i=>i.id !== id)
        },
        GetListProduct(){
           axios.get(`/api/product/list?category_id=${this.SeclectCategory}`, { headers: { Authorization: `Bearer ${this.store.getToken}` }
            }).then(response => {

                this.ProductData = response.data.products;
                this.CategoryData = response.data.category;

                // console.log(this.ProductData)

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
            })
        }
    },
    created(){
        this.GetListProduct()
    }
}
</script>
<style >
    .img-list{

        height: 80px;
    width: 80px;
    object-fit: cover;
    object-position: center;
    border-radius: 5px;
    border: 1px solid #b1b1b1;
    padding: 3px;
    }

    .imgbox{
            height: 120px;
    width: auto;
    object-fit: cover;
    object-position: center;
    }

    .box-nostore{
            position: absolute;
    top: 80px;
    width: 100%;
    background-color: #ff2d2d8f;
    color: white;
    padding: 5px;
    text-align: center;
    }

    .onum{
        position: absolute;
    background-color: #9a00ff;
    top: 0px;
    right: 0px;
    padding: 5px;
    border-radius: 0px 10px 0px 10px;
    color: white;
    font-weight: bold;
    }
</style>