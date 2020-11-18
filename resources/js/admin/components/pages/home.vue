<template>
	<div>
            <div class="content">
                    <div class="container-fluid">

                        <div>
                            <h2>GADTC Accreditation</h2>
                        </div>
                             <div class="_1adminOverveiw_card _box_shadow _border_radious _mar_b30 _1adminOverveiw_bg_one">
                                        <div class="container-fluid mt-2">
                                                <p class="_1adminOverveiw_card_left_title">Findings/Recommendations</p>
                                                <div class="columns">
                                                    <div class="column">
                                                        <b-field 
                                                            label="Area">
                                                            <b-select placeholder="Select Area" @input="fetchArea" v-model="n_area" size="is-medium" expanded>
                                                                <option v-for="area_list in area_lists" :key="area_list.id" :value="area_list.id">{{area_list.id}} {{area_list.areaName}}</option>
                                                               
                                                            </b-select>
                                                        </b-field>
                                                    </div>    
                                                    <div class="column">
                                                                <b-field 
                                                                    label="Program">
                                                                    <b-select placeholder="Select Program" @input="fetchProgram" v-model="n_prog" size="is-medium" :disabled="prog_disabled" expanded>
                                                                        <option v-for="prog_list in prog_lists" :key="prog_list.id" :value="prog_list.id">{{ prog_list.progName }}</option>
                                                                       
                                                                    </b-select>
                                                                </b-field>
                                                    </div>
                                                </div>

                                            <div class="container-fluid">
                                                    <b-table 
                                                            :data="finding_list"
                                                            ref="table"
                                                            :paginated="isPaginated"
                                                            :per-page="perPage"
                                                            :current-page.sync="currentPage"
                                                            :pagination-simple="isPaginationSimple"
                                                            :pagination-position="paginationPosition"
                                                            :default-sort-direction="defaultSortDirection"
                                                            :pagination-rounded="isPaginationRounded"
                                                            :sort-icon="sortIcon"
                                                            :sort-icon-size="sortIconSize"
                                                            default-sort="user.first_name"
                                                            aria-next-label="Next page"
                                                            aria-previous-label="Previous page"
                                                            aria-page-label="Page"
                                                            aria-current-label="Current page">
                                                            <b-table-column field="tab_num" centered label="Tab#" width="60" sortable numeric v-slot="props">
                                                                {{ props.row.tab_num }}
                                                            </b-table-column>
                                                            <b-table-column searchable field="title" class="demo-table-info-row" label="Findings/Recommendation" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                                                    {{ props.row.title }}
                                                            </b-table-column>
                                                             <b-table-column searchable field="deliverable" label="Deliverable" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                                                     {{ props.row.deliverable }}
                                                            </b-table-column>
                                                             <b-table-column  field="Action" label="" sortable placeholder="" icon="magnify" size="is-small" v-slot="props">   
                                                                <div class="buttons">          
                                                                    <b-button size="is-small" @click="getLink(props.row.deli_data)" type="is-primary">View</b-button>
                                                                </div>
                                                            </b-table-column>                                             
                                                        </b-table>
                                            </div>                                        
                                        </div>
                                    </div>
                                <!-- </div> -->
                               
                            <!-- </div> -->

                    </div>                         
            </div>
    </div>

</template>

<script >
    export default{
        data(){
            return{

                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: false,
                paginationPosition: 'bottom',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage: 20,
                loading: true,
                prog_list: '',
                prog_lists:[],
                area_list: '',
                area_lists:[],
                finding_list:[],
                progName:'',
                findings:'',
                editData:[],
                n_area: '',
                tab_num:'',
                n_prog: '',
                val:1,
                prog_disabled:true,
            }

        },
       mounted(){

            this.getProgram();
            this.getArea();
            this.getFindings();

        },

        // created(){
        //     this.fetchArea();
        // },

       methods:{
            async getProgram(){
                const res = await this.callApi('get', 'app/prog_view')
                if(res.status==200){
                    this.prog_lists = res.data
                }else{
                    console.log(res.data)
                }
            },

             async getArea(){
                const res = await this.callApi('get', 'app/area_view')
                if(res.status==200){
                    this.area_lists = res.data
                }else{
                    console.log(res.data)
                }
            },

            async fetchArea(){

                const res = await this.callApi('get', 'app/findings_view/'+ this.n_area)
                if(res.status==200){
                     
                    this.finding_list = res.data
                    this.$Loading.finish();
                    this.prog_disabled= false

                    // console.log(this.finding_list)   
                }else{
                    console.log(res.data)
                    this.prog_disabled= true
                    this.$Loading.error();
                }
            },

            async fetchProgram(){
                const res = await this.callApi('get', 'app/findings_view_prog/'+ this.n_prog + '/' + this.n_area)
                if(res.status==200){
                     this.$Loading.finish();
                    this.finding_list = res.data
                    // console.log(this.finding_list)
                }else{
                    console.log(res.data)
                    this.$Loading.error();
                }
            },

            async getFindings(){
            this.token = window.Laravel.csrfToken
                const res = await this.callApi('get', 'app/get_finding_home')
                if(res.status==200){
                    this.$Loading.finish();
                    this.finding_list = res.data
                    this.loading= false
                }else{
                    this.$Loading.error();
                    this.swr()
                }
            },

            async getLink(deli_data){

                        this.finding_list.deli_data = deli_data
                        window.open("" + this.finding_list.deli_data, "_blank");
            },

            prog_enable(){
                return  this.prog_disabled = false;

            },
        },
    }
</script>
