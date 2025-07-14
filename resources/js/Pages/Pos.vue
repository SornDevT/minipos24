<template lang="">
    <div class="row">
        <div class="col-md-8">
                <div class=" card mb-2">
                    <div class="card-body">
                        <div class="d-flex">
                            <select v-model="SeclectCategory" class="form-select w-auto me-2" @change="GetListProduct()">
                                <option value="all" >-- ທັງໝົດ --</option>
                                <option :value="item.id" v-for="item in CategoryData" :key="item.id" >{{ item.CategoryName }}</option>
                            </select>
                            <div class="input-group ">
                            <input type="text" class="form-control" v-model="Search"  placeholder="ຄົ້ນຫາ..." >
                            <button class="btn btn-primary px-3" type="button" @click="GetListProduct()" ><i class='bx bx-search fs-5' ></i></button>
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
                                    <p class="card-text">{{FormatPrice(item.PriceSell)}} ກີບ</p>
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
                        <input type="text" class="form-control mb-2" v-model="customer_name">

                        <label  class="form-label">ເບີໂທ:</label>
                        <input type="text" class="form-control" v-model="customer_tel">
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
                                                        <div class="text-end">{{item.qty}} x {{ FormatPrice(item.price) }}</div>
                                                        <div class=" d-flex justify-content-between">
                                                            <span><i class='bx bxs-plus-circle text-info cursor-pointer' @click="AddToList(item.id)"></i> | <i class='bx bxs-minus-circle text-warning cursor-pointer' @click="RemoveFromList(item.id)"></i> | <i class='bx bxs-trash text-danger cursor-pointer' @click="DeleteFromList(item.id)" ></i></span>
                                                            <span>{{ FormatPrice(item.qty*item.price) }}</span>
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
                            {{ FormatPrice(SumTotal) }} ກີບ
                        </span>
                    </div>

                    <div class="p-2">
                        <button type="button" @click="ShowConfirm()" :disabled="!SumTotal" class="btn rounded-pill btn-success w-100 ">ຊຳລະເງິນ</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sh_showconfirm" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">ການຊຳລະເງິນ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        <div class="col-md-6">
                            <div class=" d-flex justify-content-between">
                                <span>ລວມຍອດເງິນ:</span>
                                <span>{{ FormatPrice(SumTotal) }} ກີບ</span>
                            </div>
                            <div class=" d-flex justify-content-between text-danger" v-if="(CashAmount-SumTotal)>0">
                                <span>ເງິນທອນ:</span>
                                <span>{{ FormatPrice(CashAmount-SumTotal) }} ກີບ</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <label>ຮັບເງິນນຳລູກຄ້າ</label>
                            <cleave :options="options" v-model="CashAmount" class=" form-control text-end" />
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <!-- <button type="button" class=" btn btn-primary w-100" @click="AddNum(500)" >500</button> -->
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-danger w-100"  @click="CashAmount = SumTotal">{{FormatPrice(SumTotal)}}</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100" @click="AddNum(500)" >500</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(1000)">1,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(2000)" >2,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(5000)">5,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(10000)">10,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(20000)" >20,000</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(50000)">50,000</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class=" btn btn-primary w-100"  @click="AddNum(100000)" >100,000</button>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>

                      <div class="modal-footer">
                            <button type="button" class="btn btn-primary me-2" :disabled="CheckBTPay"  @click="ConfirmPay()" >ບັນທຶກ</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ປິດ</button>
                      </div>
                    </div>
                  </div>
                </div>

</template>
<script>


// response => {

//                 this.ProductData = response.data.products;
//                 this.CategoryData = response.data.category;

//             }

// function response(response){
//     this.ProductData = response.data.products;
//     this.CategoryData = response.data.category;

// }

// response(44444)


// // arrow function
//     res => {
//         return res;
//     }




import axios from 'axios';
import { useStore } from '../Store/auth';
import Cleave from 'vue-cleave-component';

export default {
    setup() {
        const store = useStore();
        return { store };
        
    },
    data() {
        return {
            customer_name:'',
            customer_tel:'',
            url: window.location.origin,
            SeclectCategory:'all',
            CategoryData:[],
            ProductData:[],
            ListOrder:[],
            Search:'',
            CashAmount:0,
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
    components:{
        Cleave
    },  
    computed:{
        CheckBTPay(){
            return parseInt(this.CashAmount?this.CashAmount:0) < parseInt(this.SumTotal);
        },
        SumTotal(){
            return this.ListOrder.reduce((total,item)=>{
                return total + (item.price * item.qty)
            }, 0 );
        },

    },
    methods:{
        async openLink(link){
            const response = await fetch(`${link}`,{ headers:{ Authorization: 'Bearer '+ this.store.getToken}});
            const html = await response.text();
            const blob = new Blob([html],{ type: "text/html"});
            const blobUrl = URL.createObjectURL(blob);
            window.open(blobUrl, "_blank");
        },
        AddNum(num){

            // let price = 0;
            // if(this.CashAmount){
            //     price = this.CashAmount
            // }

            this.CashAmount = parseInt(this.CashAmount?this.CashAmount:0) + parseInt(num) // 0012 = 12
        },
        ShowConfirm(){
            $('#sh_showconfirm').modal('show');
        },
         FormatPrice(value) {
             let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        ConfirmPay(){

            axios.post('/api/transection/add',{
                customer_name: this.customer_name,
                customer_tel: this.customer_tel,
                listorder: this.ListOrder
            },{ headers:{ Authorization: 'Bearer ' + this.store.getToken} }).then(response =>{
                console.log(response.data);

                if(response.data.success){
                    this.CashAmount = '';
                    this.customer_name = '';
                    this.customer_tel = '';
                    this.ListOrder = [];
                    $('#sh_showconfirm').modal('hide');

                    // update list product
                    this.GetListProduct();

                     this.$swal({
                                            toast: true,
                                            position: "top-end",
                                            icon: "success",
                                            title: response.data.message,
                                            showConfirmButton: false,
                                            timer: 2500
                                    });

                /// check bill id and print
                if(response.data.bill_id){
                    // window.open('api/bill/print/' + response.data.bill_id, '_blank');
                    this.openLink('api/bill/print/' + response.data.bill_id)
                }

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

        },
        AddToList(id){

            console.log('add ID:'+id)

            let item = this.ProductData.find(i => i.id === id); // ນຳ id ໄປຄົ້ນຫາ ຂໍ້ມູນ ຢູ່ໃນ ProductData

            console.log('Data:'+item)

            let old_item = this.ListOrder.find(i => i.id === id)

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
           axios.get(`/api/product/list?category_id=${this.SeclectCategory}&search=${this.Search}`, { headers: { Authorization: `Bearer ${this.store.getToken}` }
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
    watch:{
        Search(val){
            if(val == ''){
                this.GetListProduct();
            }
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