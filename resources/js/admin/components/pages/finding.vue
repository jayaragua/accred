<!-- /*
<style>
    .demo-table-info-row {
    
        color: blue !important;
    }
    .ivu-table td.demo-table-info-column{
   
        display: -webkit-box;
        max-height: 3.2rem;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        -webkit-line-clamp: 2;
     
        overflow:hidden;
        text-overflow:ellipsis;
        white-space:nowrap

    }




</style>*/
 -->
<template>
	<!-- <div> -->
		<div class="content">
			<div class="container-fluid ">
			   <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<!-- <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Findings/Recommedation &nbsp; <Button @click="addModal=true"><Icon type="md-add" /> Add Findings</Button></p>



					




					 <div class="_overflow _table_div">
						<table class="_table"> 
							
                             
							<tr>
								<th>id</th>
								<th>Program</th>
								<th>Area</th>
								<th>Findings/Recommendation</th>
								<th>Deliverable</th>
								
								<th>Action</th>
							</tr>
								
							<tr v-for="(finding, i) in findings" :key="i" v-if="findings.length">
								<td>{{finding.id}}</td>
								<td >{{finding.progName}}</td>
								<td >{{finding.area_id}}</td>
								<td class="_table_name">{{finding.title}}</td>
								<td class="_table_desc">{{finding.deliverable}}</td>
								 <td >{{finding.created_at | formatDate}}</td> 
								<td>
									<Button type="info" size="small" @click="showEditModal(finding, i)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(finding, i)" :loading="finding.isDeleting">Delete</Button>
								</td>
							</tr>

						</table>
					</div> -->

                     <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                        <p class="_title0">Findings/Recommedation &nbsp; <Button @click="addModal=true"><Icon type="md-add" /> Add Findings</Button></p>
                        <div class="tab_border">
                         <!--    <b-table 

                                :data="findings" 
                                :loading="loading"
                                :columns="columns"
                                ref="table"
                                paginated  
                                per-page="10" 
                                detail-key="id"
                                aria-next-label="Next page"
                                aria-previous-label="Previous page"
                                aria-page-label="Page"
                                aria-current-label="Current page"
                                >
                                 <b-button type="is-info">Info</b-button>
                          
                                
                                <template v-for="column in columns">
                                    <b-table-column :key="column.id" v-bind="column">
                                        <template
                                            v-if="column.searchable && !column.numeric"
                                            slot="searchable"
                                            slot-scope="props">
                                            <b-input
                                                v-model="props.filters[props.column.field]"
                                                placeholder="Search..."
                                                icon="magnify"
                                                size="is-small" />
                                        </template>
                                        <template v-slot="props">
                                            {{ props.row[column.field] }}
                                        </template>

                                        <template slot-scope="props" slot="action">
                                            <b-button type="is-info" size="small" style="margin-right: 5px" @click="show(index)">View</b-button>
                                            
                                        </template>
                                    </b-table-column>
                                </template>
                            </b-table> -->

                            <b-table 
                                    :data="findings"
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


                                    <b-table-column field="id"  label="ID" width="60" sortable numeric v-slot="props">
                                        {{ props.row.id }}
                                    </b-table-column>

                                    <b-table-column searchable centered  field="tab_num" width="150" label="Tab#" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.tab_num }}
                                    </b-table-column>
                                    <b-table-column searchable centered  field="progName" width="150" label="Program" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.progName }}
                                    </b-table-column>

                                    <b-table-column searchable field="area_id" width="150" label="Area" sortable placeholder="Search..." icon="magnify" size="is-small" centered v-slot="props">
                                        {{ props.row.area_id }}
                                    </b-table-column>

                                    <b-table-column searchable field="title" class="demo-table-info-row" label="Title" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                            {{ props.row.title }}
                                    </b-table-column>
                                     <b-table-column searchable field="deliverable" label="Deliverable" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                            {{ props.row.deliverable }}
                                    </b-table-column>

                                    <b-table-column  label="Action" centered  v-slot="props" width="200">
                                        <span>
                                             <b-button type="is-info" size="is-small"  @click="showEditModal(props.row.id, props.row.tab_num, props.row.prog_id,props.row.area_id,props.row.title, props.row.deliverable, props.row.deli_data)" >Edit</b-button>
                                             <b-button type="is-danger" size="is-small" @click="showDeletingModal(props.row.id)" :loading="props.index.isDeleting" >Delete</b-button>
                                        </span>
                                    </b-table-column>

                                </b-table>





                                <!-- <Table :className="rowClassName" :loading="loading" border :columns="columns7" :data="findings"></Table> -->

                               <!--  <iviewTablePage
                                  border
                                  :columns="columns7"
                                  :data="findings"
                                  :total='total'
                                  >
                                </iviewTablePage> -->

                                <!-- :total='total' -->
<!-- 
                                <b-table
                                    :data="findings"
                                    :loading="loading"

                                    paginated
                                    backend-pagination
                                    :total="total"
                                    :columns="columns"
                                    :per-page="perPage"
                                    @page-change="onPageChange"
                                    aria-next-label="Next page"
                                    aria-previous-label="Previous page"
                                    aria-page-label="Page"
                                    aria-current-label="Current page"
                                 
                                    >
                                </b-table> -->

                               

                                <!-- :data="data"
            ref="table"
            paginated
            per-page="5"
            :opened-detailed="defaultOpenedDetails"
            detailed
            detail-key="id"
            @details-open="(row) => $buefy.toast.open(`Expanded ${row.user.first_name}`)"
            :show-detail-icon="showDetailIcon"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"> -->


            
          <!--   :opened-detailed="defaultOpenedDetails"
            detailed
            
            @details-open="(row) => $buefy.toast.open(`Expanded ${row.user.first_name}`)"
            :show-detail-icon="showDetailIcon" -->
            


                        </div>
                    </div>

                 

					<!-- add modal-->
					 <Modal
				        v-model="addModal"
				        title="Add finding/Recommendation"
				        :mask-closable="false"
				        :closable="false"

				        >
                        <label>Tab #</label>
                        <div class="space2">
                            <Input v-model="data.tab_num" type="textarea" :autosize="true" placeholder="add Tab Number"  />
                        </div>
				        <label>Program</label>
					    <div class="space2">
					     	<Select v-model="data.prog_id"
					     		placeholder="Select Program">
						        <Option v-for="prog_list in prog_lists" :value="prog_list.id" :key="prog_list.progName">{{ prog_list.progName }}</Option>
						    </Select>
					    </div>
					    <label>Area</label>
					    <div class="space2">
					     	<Select v-model="data.area_id"
					     		placeholder="Select Area">
						        <Option v-for="area_list in area_lists" :value="area_list.id" :key="area_list.areaName">{{area_list.id}} &nbsp;&nbsp;&nbsp;{{area_list.areaName}}</Option>
						    </Select>
					    </div>
					    <label>Finding/Recommendation</label>
					    <div class="space2">
					    	<Input v-model="data.title" type="textarea" :autosize="true" placeholder="add Finding/Recommendation"  />
					    </div>
					    <label>Deliverable</label>
					    <div class="space2">
					    	<Input v-model="data.deliverable" type="textarea" :autosize="true" placeholder="add Deliverable" required  />
					    </div>

					    <Upload
					        type="drag"
					        :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
					        :on-success="handleSuccess"
					     	:on-error="handleError"
					     	:format="['pdf']"
					     	:on-format-error="handleFormatError"
					        action="/app/upload">
					        <div style="padding: 20px 0">
					            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
					            <p>Click or drag files here to uploads</p>
					        </div>
					    </Upload>

				        <div slot="footer">
				        	<Button type="default" @click="addModal=false">Close</Button>
				        	<Button type="primary" @click="addFinding" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add Finding'}}</Button>
				        </div>
				    </Modal>



				    <!-- edit modal-->
					 <Modal
				        v-model="editModal"
				        title="Edit finding"
				        :mask-closable="false"
				        :closable="false"
				        >
                        <label>Tab #</label>
                        <div class="space2">
                            <Input v-model="editData.tab_num" type="textarea" :autosize="true" placeholder="add Tab Number"  />
                        </div>
				        <label>Program</label>
					    <div class="space2">
					     	<Select v-model="editData.prog_id"
					     		placeholder="Select Program">
						        <Option v-for="prog_list in prog_lists" :value="prog_list.id" :key="prog_list.progName">{{ prog_list.progName }}</Option>
						    </Select>
					    </div>
					    <label>Area</label>
					    <div class="space2">
					     	<Select v-model="editData.area_id"
					     		placeholder="Select Area">
						        <Option v-for="area_list in area_lists" :value="area_list.id" :key="area_list.areaName">{{area_list.id}}</Option>
						    </Select>
					    </div>
					    <label>Finding/Recommendation</label>
					    <div class="space2">
					    	<Input v-model="editData.title" type="textarea" :autosize="true" placeholder="add Finding/Recommendation"  />
					    </div>
					    <label>Deliverable</label>
					    <div class="space2">
					    	<Input v-model="editData.deliverable" type="textarea" :autosize="true" placeholder="add Deliverable" required  />
					    </div>

					    <Upload
					        type="drag"
					        :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
					        :on-success="handleSuccess"
					     	:on-error="handleError"
					     	:format="['pdf']"
					     	:on-format-error="handleFormatError"
					        action="/app/upload">
					        <div style="padding: 20px 0">
					            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
					            <p>Click or drag files here to uploads</p>
					        </div>
					    </Upload>


				        
				        <div slot="footer">
				        	<Button type="default" @click="editModal=false">Close</Button>
				        	<Button type="primary" @click="editFinding" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing...' : 'Edit Finding'}}</Button>
				        </div>
				    </Modal>




                    <!-- edit modal-->
                    <!--  <Modal
                        v-model="editModal"
                        title="Edit finding"
                        :mask-closable="false"
                        :closable="false"
                        >
                        <label>Program</label>
                        <div class="space2">
                            <Select v-model="editData.prog_id"
                                placeholder="Select Program">
                                <Option v-for="prog_list in prog_lists" :value="prog_list.id.toString()" :key="prog_list.progName">{{ prog_list.progName }}</Option>
                            </Select>
                        </div>
                        <label>Area</label>
                        <div class="space2">
                            <Select v-model="editData.area_id"
                                placeholder="Select Area">
                                <Option v-for="area_list in area_lists" :value="area_list.id.toString()" :key="area_list.areaName">{{area_list.id}}</Option>
                            </Select>
                        </div>
                        <label>Finding/Recommendation</label>
                        <div class="space2">
                            <Input v-model="editData.title" type="textarea" :autosize="true" placeholder="add Finding/Recommendation"  />
                        </div>
                        <label>Deliverable</label>
                        <div class="space2">
                            <Input v-model="editData.deliverable" type="textarea" :autosize="true" placeholder="add Deliverable" required  />
                        </div>

                        <Upload
                            type="drag"
                            :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                            :on-success="handleSuccess"
                            :on-error="handleError"
                            :format="['pdf']"
                            :on-format-error="handleFormatError"
                            action="/app/upload">
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to uploads</p>
                            </div>
                        </Upload>


                        
                        <div slot="footer">
                            <Button type="default" @click="editModal=false">Close</Button>
                            <Button type="primary" @click="editFinding" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing...' : 'Edit Finding'}}</Button>
                        </div>
                    </Modal> -->



				    <!--delete modal-->
				     <Modal v-model="showDeleteModal" width="360">
				        <p slot="header" style="color:#f60;text-align:center">
				            <Icon type="ios-information-circle"></Icon>
				            <span>Delete confirmation</span>
				        </p>
				        <div style="text-align:center">
				            <p>Are you sure you want to delete Finding/Recommendation?</p>
				           
				        </div>
				        <div slot="footer">
				            <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteFinding()">Delete</Button>
				        </div>
				    </Modal>

				</div>
				

    		</div>
    	</div>
    <!-- </div> -->
</template>

<script>

    // import iviewTablePage from 'iview-table-page'
    export default {
        // components: { iviewTablePage },
    	data(){
    		return {

                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: false,
                paginationPosition: 'bottom',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage:20,

                // selected: findings[id],
    			data:{
    				title:'',
    				deliverable:'',
    				area_id:'',
    				prog_id:'',
    				deli_data:'',
                    tab_num:'',


    			},

                loading: true,

    			addModal:false,
    			editModal:false,
    			isAdding:false,
    			isfileok:false,

    			finding:'',
    			findings: [],
               



    			prog_list: '',
    			prog_lists:[],
    			area_list: '',
    			area_lists:[],
    			progName:'',

                // n:1,

    			editData:{
    				title:'',
    				deliverable:'',
    				area_id:'',
    				prog_id:'',
    				deli_data:'',
                    tab_num:'',
    			},
    			prog:'',

    			index : -1,

                t_title:'',
                t_deliverable:'',
                t_area_id:'',
                t_prog_id:'',
                t_deli_data:'',
                t_tab_num:'',




    			isDeleting: false,
    			showDeleteModal : false,
    			deleteItem: {},
    			deletingIndex : -1,
    			token: '',
    			isEditing: false,

                ind:'',


                //style
            

                // columns: [
                //     {
                //         fields: 'id',
                //         key: 'id',
                //         width: 70,
                //         align:'center',
                        
                        
                //     },
                //     {
                //         fields: 'Program',
                //         key: 'progName',
                //         width: 120,
                //     },
                //     {
                //         fields: 'Area',
                //         key: 'area_id',
                //         width: 70,
                //         align:'center',
                //     },
                //     {
                //         fields: 'Title',
                //         key: 'title',
                //         // width: 250,
                //         // color: 'blue',
                //         className: 'demo-table-info-column'

                //     },
                //     {
                //         fields: 'Deliverable',
                //         key: 'deliverable',
                //         align: 'left',

                //         className: 'demo-table-info-column'
                //     },
                //     {
                //         fields: 'Action',
                //         key: 'action',
                //         width: 150,
                //         align: 'center',
                //         render: (h, params) => {
                //             return h('div', [
                //                 h('Button', {
                //                     props: {
                //                         type: 'primary',
                //                         size: 'small'
                //                     },
                //                     style: {
                //                         marginRight: '5px'
                //                     },
                //                     on: {
                //                         click: () => {
                //                             this.showEditModal(params.index)
                //                             this.isEditing = true
                //                         }
                //                     }
                //                 }, 'Edit'),
                //                 h('Button', {
                //                     props: {
                //                         type: 'error',
                //                         size: 'small'
                //                     },
                //                     on: {
                //                         click: () => {
                //                             this.remove(params.index)
                //                         }
                //                     }
                //                 }, 'Delete')
                //             ]);
                //         }
                //     }
                // ],
                // total: 5,

                columns: [
                    {
                        field: 'id',
                        label: 'ID',
                        width: '50',
                        numeric: true
                    },
                    {
                        field: 'progName',
                        label: 'Program',
                        width: '150',
                        searchable: true,
                        centered: false
                    },
                    {
                        field: 'area_id',
                        label: 'Area',
                        width: '150',
                        searchable: true,
                    },
                    {
                        field: 'title',
                        label: 'Title',
                        searchable: true,
                    },
                    {
                        field: 'deliverable',
                        label: 'Deliverable',
                        searchable: true,
                    },
                    {
                        field: 'b-button',
                        Action: 'Deliverable',
                        
                    },
                    
                    
                    ]



    
    		}
    	},
    	mounted(){

    		this.getProgram();
    		this.getArea();
    		this.updateTable();
            // this.loadAsyncData()

    	},

    	methods:{


            //  loadAsyncData() {
            //     const params = [
            //         'api_key=bb6f51bef07465653c3e553d6ab161a8',
            //         'language=en-US',
            //         'include_adult=false',
            //         'include_video=false',
            //         `sort_by=${this.sortField}.${this.sortOrder}`,
            //         `page=${this.page}`
            //     ].join('&')

            //     this.loading = true
            //     this.$http.get(`https://api.themoviedb.org/3/discover/movie?${params}`)
            //         .then(({ data }) => {
            //             // api.themoviedb.org manage max 1000 pages
            //             this.data = []
            //             let currentTotal = data.total_results
            //             if (data.total_results / this.perPage > 1000) {
            //                 currentTotal = this.perPage * 1000
            //             }
            //             this.total = currentTotal
            //             data.results.forEach((item) => {
            //                 item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
            //                 this.data.push(item)
            //             })
            //             this.loading = false
            //         })
            //         .catch((error) => {
            //             this.data = []
            //             this.total = 0
            //             this.loading = false
            //             throw error
            //         })
            // },
            /*
        * Handle page-change event
        */
            onPageChange(page) {
                this.page = page
                // this.loadAsyncData()
            },
            /*
        * Handle sort event
        */
           
        
        

            // show (index) {
            //     this.$Modal.info({
            //         title: 'User Info',
            //         content: `Name：${this.data6[index].name}<br>Age：${this.data6[index].age}<br>Address：${this.data6[index].address}`
            //     })
            // },

    		async addFinding(){
                this.isEditing=false
                // console.log(this.data.tab_num)
                if(this.data.tab_num.trim()=='') return this.error('Tab # is required')
    			if(!this.data.prog_id) return this.error('Program is required')
    			if(!this.data.area_id) return this.error('Area is required')
    			if(this.data.title.trim()=='') return this.error('Findings/Recommendation is required')
    			if(this.data.deliverable.trim()=='') return this.error('Deliverable is required')
    			if(this.data.deli_data.trim()=='') return this.error('Deliverable file is required')
    			this.data.deli_data = `/uploads/${this.data.deli_data}`	
                // console.log(this.data.deli_data)
    			const res = await this.callApi('post', 'app/create_finding', this.data)
    			if(res.status===201){
    				this.findings.unshift(res.data)
    				this.$Loading.finish();
    				this.success('Findings has been added successfully!')

    				this.updateTable()
    				this.addModal = false
                    this.data.tab_num=''
    				this.data.prog_id=''
    				this.data.area_id=''
    				this.data.title=''
    				this.data.deliverable=''
    				this.data.deli_data=''
    			}else{
    				if(res.status==422){
    					if(res.data.errors.tab_num){
    						this.info(res.data.errors.tab_num[0])
    						this.$Loading.error();
    					}
                        if(res.data.errors.prog_id){
                            this.info(res.data.errors.prog_id[0])
                            this.$Loading.error();
                        }
    					if(res.data.errors.area_id){
    						this.info(res.data.errors.area_id[0])
    						this.$Loading.error();
    					}
    					if(res.data.errors.title){
    						this.info(res.data.errors.title[0])
    						this.$Loading.error();
    					}
    					if(res.data.errors.deliverable){
    						this.info(res.data.errors.deliverable[0])
    						this.$Loading.error();
    					}
    				}else{
    					this.swr()
    				}
    			}
    		},

    		async editFinding(){
                if(!this.editData.tab_num) return this.error('Tab # is required')
    			if(!this.editData.prog_id) return this.error('Program is required')
    			if(!this.editData.area_id) return this.error('Area is required')
    			if(this.editData.title.trim()=='') return this.error('Findings/Recommendation is required')
    			if(this.editData.deliverable.trim()=='') return this.error('Deliverable is required')
    			if(this.editData.deli_data.trim()=='') return this.error('Deliverable file is required')

                // console.log(this.editData.tab_num )
                // if(!this.editData.prog_id) return this.error('Program is required')
                // if(!this.editData.area_id) return this.error('Area is required')
                // if(this.editData.title.trim()=='') return this.error('Findings/Recommendation is required')
                // if(this.editData.deliverable.trim()=='') return this.error('Deliverable is required')
                // if(this.editData.deli_data.trim()=='') return this.error('Deliverable file is required')
    			const res = await this.callApi('post', 'app/edit_finding', this.editData)
    			if(res.status===200){
                    this.findings.tab_num = this.editData.tab_num   
    				this.findings.title = this.editData.title
    				this.findings.deliverable = this.editData.deliverable
    				this.findings.progName = this.editData.progName
    				this.findings.area_id = this.editData.area_id
    				this.$Loading.finish();
    				this.success('Finding has been edited successfully!')
    				this.updateTable()
    				this.editModal = false
                    this.isEditing=false
    			}else{
    				if(res.status==422){
    					if(res.data.errors.tab_num){
    						this.info(res.data.errors.tab_num[0])
    						this.$Loading.error();
    					}
                        if(res.data.errors.prog_id){
                            this.info(res.data.errors.prog_id[0])
                            this.$Loading.error();
                        }
    					if(res.data.errors.area_id){
    						this.info(res.data.errors.area_id[0])
    						this.$Loading.error();
    					}
    					if(res.data.errors.title){
    						this.info(res.data.errors.title[0])
    						this.$Loading.error();
    					}
    					if(res.data.errors.deliverable){
    						this.info(res.data.errors.deliverable[0])
    						this.$Loading.error();
    					}
    				}else{
    					this.swr()
    				}
    			}
    		},

            // props.row.id,props.row.tab_num,props.row.prog_id,props.row.area_id,props.row.title,props.row.deliverable
    	
    		showEditModal(id,tab,prog_id,area_id, title,deliverable, deli_data){
                // console.log(index1, index2 ,index3 ,index4, index5,index6)
    			let obj = {
    				id : id ,
                    tab_num : tab,
    				title : title,
    				deliverable : deliverable,
    				area_id : area_id,
    				prog_id : prog_id,
    				deli_data : deli_data

    			}
                // console.log(obj.tab_num)
    			this.editData=obj
    			this.editModal=true
    			// this.index = index
                this.t_title=title
                this.t_deliverable= tab
                this.t_area_id=area_id
                this.t_prog_id =prog_id
                this.t_deli_data =deli_data
                this.t_tab_num =tab

    			this.isEditing=true
    		},


            // getValTable(id){

            //     if()

            // },






            //  showEditModal(index) {
            //     // this.$Modal.info({
            //         let obj = {
            //         id : `${this.findings[index].id}`,
            //         title: `${this.findings[index].title}`,
            //         deliverable : `${this.findings[index].deliverable}`,
            //         area_id : `${this.findings[index].area_id}`,
            //         prog_id : `${this.findings[index].prog_id}`,
            //         deli_data : `${this.findings[index].deli_data}`,

            //         // content: `title${this.findings[index].title}<br>deliverable：${this.findings[index].deliverable}<br>area_id：${this.findings[index].area_id}`
            //     // })
            //     }
            //     // console.log(obj.progName)
            //     this.editData=obj
            //     // console.log(this.editData)
            //     this.editModal=true
            //     this.index = index
            //     this.isEditing=true
            // },



            //  showEditModal(finding, index) {
            //     // this.$Modal.info({
            //         console.log(`${this.finding.index}`)
            //         let obj = {
            //         id : `${this.finding.id}`,
            //         title: `${this.finding.title}`,
            //         deliverable : `${this.finding.deliverable}`,
            //         area_id : `${this.finding.area_id}`,
            //         prog_id : `${this.finding.prog_id}`,
            //         deli_data : `${this.finding.deli_data}`,

            //         // content: `title${this.findings[index].title}<br>deliverable：${this.findings[index].deliverable}<br>area_id：${this.findings[index].area_id}`
            //     // })
            //     }
            //     // console.log(obj.progName)
            //     this.editData=obj
            //     // console.log(this.editData)
            //     this.editModal=true
            //     this.index = index
            //     this.isEditing=true
            // },



            

    		async deleteFinding(){
    			this.isDeleting= true
                console.log(this.deleteItem)
    			const res = await this.callApi('post', 'app/delete_finding/' + this.deleteItem)
    			if(res.status===200){
    				// this.findings.splice(this.findings.indexOf(this.deleteItem), 1)
                    this.updateTable();
    				this.$Loading.finish();
    				this.success('Findings/Recommendations has been deleted successfully!')
                    
    			}else{
    				this.$Loading.error();
    				this.swr()
    			}
    			this.isDeleting= false
    			this.showDeleteModal = false
    			

    		},

    		 showDeletingModal(id){
    			this.deleteItem = id
                // console.log(this.deleteItem)
    			this.deletingIndex = id
    			this.showDeleteModal = true
    			
    		},

    		handleSuccess (res, file) {
    			res = `${res}`
    			if (this.isEditing) {
    				return this.editData.deli_data = `/uploads/${res}`
    			}

                // if (this.isEditing=false) {
                //     return 
                   
                // }
                this.data.deli_data = res
                this.isfileok= true
                

            },

            
            handleError (res, file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: `${file.errors.file.length ? file.errors.file[0] : 'Someting went wrong!'}`
                });

            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select pdf file.'
                });
            },  

            async getProgram(){
	            const res = await this.callApi('get', 'app/prog')
    			if(res.status==200){
    				this.prog_lists = res.data
    			}else{
    				console.log(res.data)
    			}
	            
        	},

        	 async getArea(){
	            const res = await this.callApi('get', 'app/area')
    			if(res.status==200){
    				this.area_lists = res.data
    			}else{
    				console.log(res.data)
    			}
	            
        	},	


    	async updateTable(){
    		this.token = window.Laravel.csrfToken
    			const res = await this.callApi('get', 'app/get_finding')
    			if(res.status==200){
    				this.$Loading.finish();
    				this.findings = res.data
                    this.loading= false
    			}else{
    				this.$Loading.error();
    				this.swr()
    			}
    	},

         
        
        }
    	// async created(){
    	// 		// this.token = window.Laravel.csrfToken
    	// 		// const res = await this.callApi('get', 'app/get_finding')
    	// 		// if(res.status==200){
    	// 		// 	this.findings = res.data
    	// 		// }else{
    	// 		// 	this.swr()
    	// 		// }
    	// }
    }

   
</script>

