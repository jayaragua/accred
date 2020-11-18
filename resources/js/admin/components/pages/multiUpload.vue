
 -->
<template>
	<!-- <div> -->
		<div class="content">
			<div class="container-fluid ">
			  

                     <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                        <p class="_title0">Accreditation Files &nbsp; <Button @click="addModal=true"><Icon type="md-cloud-download" /> Upload Multiple Files</Button></p>
                        <div class="tab_border">
                        
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

                                 	<b-table-column searchable centered  field="progName" width="250" label="Program" sortable  placeholder="Search..." icon="magnify" size="is-small" v-slot="props">
                                        {{ props.row.progName }}
                                    </b-table-column>

                                    <b-table-column searchable field="area_id" width="150" label="Area" sortable placeholder="Search..." icon="magnify" size="is-small" centered v-slot="props">
                                        {{ props.row.area_id }}
                                    </b-table-column>   

                                    <b-table-column searchable field="title" class="demo-table-info-row" label="Title" sortable placeholder="Search..." icon="magnify" size="is-small" v-slot="props">             
                                            {{ props.row.title }}
                                    </b-table-column>
                                     

                                    <b-table-column  label="Action" centered  v-slot="props" width="200">
                                        <span>
                                             
                                             <b-button type="is-danger" size="is-small" @click="showDeletingModal(props.row.id)" :loading="props.index.isDeleting" >Delete</b-button>
                                        </span>
                                    </b-table-column>

                                </b-table>





                               

                        </div>
                    </div>

                 

					<!-- add modal-->
					 <Modal
				        v-model="addModal"
				        title="Add Files"
				        :mask-closable="false"
				        :closable="false"

				        >

				        <label>Program</label>
					    <div class="space2">
					     	<Select v-model="data.prog_id"
					     		placeholder="Select Program">
						        <Option v-for="prog_list in prog_lists" :value="prog_list.id" :key="prog_list.progName">{{ prog_list.progName }}</Option>
						    </Select>
					    </div>
					    <label>Area</label>
					    <div class="space2">
					     	<Select v-model="data.area_id" @input="upload_enable"
					     		placeholder="Select Area">
						        <Option v-for="area_list in area_lists" :value="area_list.id"  :key="area_list.areaName">{{area_list.id}} &nbsp;&nbsp;&nbsp;{{area_list.areaName}}</Option>
						    </Select>
					    </div>
                        
					    <Upload
					        type="drag"
					        :disabled="isuploadActive"
					        drag-drop
					        multiple
					        :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
					        :on-success="handleSuccess"
					     	:on-error="handleError"
					     	:format="['pdf']"
					     	:on-format-error="handleFormatError"
					        action="/app/uploadmultiple">
					        <div style="padding: 20px 0">
					            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
					            <p>Click or drag files here to uploads</p>
					        </div>
					    </Upload>


					    <div slot="footer">
				        	<Button @click="addModal=false">Close</Button>
				        	<Button  id="but" type="primary"></Button>
				        </div>

				    </Modal>





				    <!--delete modal-->
				     <Modal v-model="showDeleteModal" width="360">
				        <p slot="header" style="color:#f60;text-align:center">
				            <Icon type="ios-information-circle"></Icon>
				            <span>Delete confirmation</span>
				        </p>
				        <div style="text-align:center">
				            <p>Are you sure you want to delete Deliverables?</p>
				           
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
                perPage: 20,

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


                uploadFile:'',
                uploadFile2:'',

    			isDeleting: false,
    			showDeleteModal : false,
    			deleteItem: {},
    			deletingIndex : -1,
    			token: '',
    			isEditing: false,

                ind:'',
                isuploadActive: true,


               

    
    		}
    	},
    	mounted(){
    		this.changeVisibility()
    		this.getProgram();
    		this.getArea();
    		this.updateTable();
            // this.loadAsyncData()

    	},
    	created(){
    		
    	},

    	methods:{


         
        
            onPageChange(page) {
                this.page = page
                // this.loadAsyncData()
            },

    		async addUpload(){
                this.isEditing=false
                
                // console.log(this.uploadFile2)
                if(!this.data.prog_id) return this.error('Program is required')
    			if(!this.data.area_id) return this.error('Area is required')
    			const res = await this.callApi('post', 'app/save_multi_upload/' + this.uploadFile2 + '/' + this.data.area_id + '/' + this.data.prog_id)
    			if(res.status===201){
    				// this.findings.unshift(res.data)
    				this.$Loading.finish();
    				this.success('Deliverable/s has been added successfully!')
    				this.isfileok= true
    				this.updateTable()
    				this.addModal = false
        
    				this.uploadFile2=''
    				// this.data.prog_id=''
    				// this.data.area_id=''
    				this.isuploadActive = true;
    			}else{
    				if(res.status==422){
    					
    				}else{
    					this.error('Deliverable already exist!')
    				}
    			}
    		},

    		async deleteFinding(){
    			this.isDeleting= true
                // console.log(this.deleteItem)
    			const res = await this.callApi('post', 'app/delete_deliverable/' + this.deleteItem, )
    			if(res.status===200){
    				// this.findings.splice(this.findings.indexOf(this.deleteItem), 1)
                    this.updateTable();
    				this.$Loading.finish();
    				this.success('Deliverable has been deleted successfully!')
                    
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

    			// if (this.data.prog_id.trim() ==='' && !this.data.area_id.trim() ==='') {
    			// 		// return this.error('Program is required')
    			// 		return 0;
    			// }else {
    					this.uploadFile2 = res
    					// console.log(this.uploadFile)
    					this.addUpload();   
    			// }
    			// for (let i = 0; i<this.res.length; i++){
    				 
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
	            const res = await this.callApi('get', 'app/prog_multi')
    			if(res.status==200){
    				this.prog_lists = res.data
    				// this.getArea();
    			}else{
    				console.log(res.data)
    			}
	            
        	},

        	 async getArea(){
	            const res = await this.callApi('get', 'app/area')
    			if(res.status==200){
    				this.area_lists = res.data 
    				
    				// this.isuploadActive =  false
    			}else{
    				console.log(res.data)
    			}
	            
        	},	
        	upload_enable(){
                 this.isuploadActive = false;
                 // console.log(this.isuploadActive)
            },


        	changeVisibility() {
			  document.getElementById("but").style.visibility = "hidden";
			},

	    	async updateTable(){
	    		this.token = window.Laravel.csrfToken
	    			const res = await this.callApi('get', 'app/get_uploads_all')
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

