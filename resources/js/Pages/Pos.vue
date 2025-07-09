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
                            <div class="col-md-3" v-for="item in 30" :key="item">
                                <div class="card mt-4">
                                    <img class="card-img-top" :src=" url + '/assets/img/elements/5.png'" alt="Card image cap">
                                    <div class="card-body">
                                    <p class="card-text">Some quick example</p>
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
                    <div class="p-4 bg-info text-white fw-bold">
                        ລາຍການສິນຄ້າ
                    </div>
                    <PerfectScrollbar>
                        <div style="height: 40vh;">
                                <table class="table table-bordered">
                        <tr v-for="item in 20" :key="item">
                            <td class="p-0 ">
                                <div class="d-flex p-2">
                                    <img :src="url + '/assets/img/elements/1.png'" class=" img-fluid img-list">
                                    <div>
                                        text
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                        </div>
                    
                    </PerfectScrollbar>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url: window.location.origin
        }
    },
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
</style>