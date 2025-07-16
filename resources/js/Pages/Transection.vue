<template lang="">
    <div class="card">
    <h5 class="card-header">ການເຄື່ອນໄຫວ ທຸລະກຳ</h5>
    <div class="card-body">

        <div class="row"> 
          <!-- {{Sort}} -->
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <div class=" me-2 cursor-pointer" @click="Sort = Sort === 'asc' ? 'desc' : 'asc'">
                    <i class='bx bx-sort-up fs-4' v-if="Sort === 'asc'"></i>
                    <i class='bx bx-sort-down fs-4' v-else></i>
                </div>
                <select v-model="PerPage" class="form-select w-auto me-2" @change="GetTran()" >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>



            </div>
            <div class="col-md-6 mb-2 d-flex justify-content-end">
                <div class="btn-group me-2" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-secondary" @click="month_type = 'm'"> <i class='bx bx-chevron-right' v-if="month_type =='m'"></i> ເດືອນ</button>
                  <button type="button" class="btn btn-secondary" @click="month_type = 'y'"> <i class='bx bx-chevron-right' v-if="month_type == 'y'"></i> ປີ</button>
                </div>
                <input type="date" v-model="dmy" class=" form-control w-auto">
            </div>
        </div>

      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ວັນທີ່</th>
              <th>ເລກທີ່</th>
              <th>ປະເພດທຸລະກຳ</th>
              <th>ລາຍລະອຽດ</th>
              <th>ມູນຄ່າ</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in TransectionData.data" :key="item.id">
                <td>{{ date(item.created_at) }}</td>
                <td>{{ item.TranID }}</td>
                <td>{{ item.TranType }}</td>
                <td>{{ item.Detail }}</td>
                <td class="text-end"> {{ FormatPrice(item.Price) }} ກີບ</td>
            </tr>
          </tbody>
        </table>
         <Pagination :pagination="TransectionData" :offset="4" @paginate="GetTran($event)" />
      </div>
    </div>
  </div>
    <!-- <TC /> -->
</template>
<script>
import axios from 'axios';
import { useStore } from '../Store/auth';
import momen from 'moment'

// import TC from '../Components/TestComponent.vue';

export default {
    setup() {
        const store = useStore();
        return { store };
    },
    data() {
        return {
            Sort:'desc',
            PerPage:10,
            dmy:new Date().toISOString().split('T')[0],
            month_type:'m',
            TransectionData:{
                data:[]
            },

        }
    },
    components: {
        // TC
        momen
    },
    methods:{
        date(val){
            return momen(val).format('DD/MM/YYYY ເວລາ h:mm:ss');
        },
        FormatPrice(value) {
             let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        GetTran(page=1){
            axios.get(`/api/transection?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&month_type=${this.month_type}&dmy=${this.dmy}`,
            { headers: { Authorization: `Bearer ${this.store.getToken}` }
        }).then(response => {
      
                    this.TransectionData = response.data;
              
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
    created(){
        this.GetTran()
    },
    watch:{
        Sort(){
            this.GetTran()
        },
        month_type(){
            this.GetTran()
        },
        dmy(){
            this.GetTran()
        }
    }
    
}
</script>
<style lang="">
    
</style>