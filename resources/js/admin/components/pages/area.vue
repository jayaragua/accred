<template>
	<div>
		<div class="content">
			<div class="container-fluid">
			   <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Area &nbsp; <Button @click="addModal=true"><Icon type="md-add" /> Add Area</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>Area</th>
								<th>Created at</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(area, i) in areas" :key="i" v-if="areas.length">
								<td>{{area.id}}</td>
								<td class="_table_name">{{area.areaName}}</td>
								<td >{{area.created_at}}</td>
								<td>
									<Button type="info" size="small" @click="showEditModal(area, i)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(area, i)" :loading="area.isDeleting">Delete</Button>
								</td>
							</tr>

						</table>


					</div>
					<!-- add modal-->
					 <Modal
				        v-model="addModal"
				        title="Add Area"
				        :mask-closable="false"
				        :closable="false"
				        >
				        <Input v-model="data.areaName" placeholder="Area"  />
				        <div slot="footer">
				        	<Button type="default" @click="addModal=false">Close</Button>
				        	<Button type="primary" @click="addArea" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add Area'}}</Button>
				        </div>
				    </Modal>



				    <!-- edit modal-->
					 <Modal
				        v-model="editModal"
				        title="edit Area"
				        :mask-closable="false"
				        :closable="false"
				        >
				        <Input v-model="editData.areaName" placeholder="Edit area name"  />
				        <div slot="footer">
				        	<Button type="default" @click="editModal=false">Close</Button>
				        	<Button type="primary" @click="editArea" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing...' : 'edit Area'}}</Button>
				        </div>
				    </Modal>

				    <!--delete modal-->
				     <Modal v-model="showDeleteModal" width="360">
				        <p slot="header" style="color:#f60;text-align:center">
				            <Icon type="ios-information-circle"></Icon>
				            <span>Delete confirmation</span>
				        </p>
				        <div style="text-align:center">
				            <p>Are you sure youo want to delete area?</p>
				           
				        </div>
				        <div slot="footer">
				            <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteArea">Delete</Button>
				        </div>
				    </Modal>

				</div>
				

    		</div>
    	</div>
    </div>
</template>
<script>
    export default {

    	data(){
    		return {
    			data:{
    				areaName:''
    			},
    			addModal:false,
    			editModal:false,
    			isAdding:false,

    			areas: [],

    			editData:{
    				areaName:''
    			},
    			index : -1,
    			isDeleting: false,
    			showDeleteModal : false,
    			deleteItem: {},
    			deletingIndex : -1,

    		}
    	},

    	methods:{
    		async addArea(){
    			if(this.data.areaName.trim()=='') return this.error('Area is required')
    				const res = await this.callApi('post', 'app/create_area', this.data)
    			if(res.status===201){
    				this.areas.unshift(res.data)
    				this.success('Area has been added successfully!')
    				this.addModal = false
    				this.data.areaName=''
                    this.$Loading.finish();

    			}else{
    				if(res.status==422){
    					if(res.data.errors.areaName){
                            this.$Loading.error();
    						this.info(res.data.errors.areaName[0])
                             
    					}
    				}else{
    					this.swr()
    				}
    			}
    		},

    		async editArea(){
    			if(this.editData.areaName.trim()=='') return this.error('Area is required')
    				const res = await this.callApi('post', 'app/edit_area', this.editData)
    			if(res.status===200){
    				this.areas[this.index].areaName = this.editData.areaName
    				this.success('Area has been edited successfully!')
    				this.editModal = false
                    this.$Loading.finish();
    			}else{
    				if(res.status==422){
    					if(res.data.errors.areaName){
                            this.$Loading.error();
    						this.info(res.data.errors.areaName[0])
                             
    					}
    				}else{
    					this.swr()
    				}
    			}
    		},

    		showEditModal(area, index){
    			let obj = {
    				id : area.id,
    				areaName : area.areaName
    			}
    			this.editData=obj
    			this.editModal=true
    			this.index = index
    		},

    		async deleteArea(){
    			this.isDeleting= true
    			
    			// this.$set(area, 'isdeleting', true)
    			const res = await this.callApi('post', 'app/delete_area', this.deleteItem)
    			if(res.status===200){
    				this.areas.splice(this.deletingIndex, 1)
    				this.success('Area has been deleted successfully!')
    			}else{
    				this.swr()
    			}
    			this.isDeleting= false
    			this.showDeleteModal = false
    			

    		},

    		 showDeletingModal(area, i){
    			this.deleteItem = area
                console.log(this.deleteItem)
    			this.deletingIndex = i
    			this.showDeleteModal = true
    		}

    		
    	
    	},


    	async created(){
    			const res = await this.callApi('get', 'app/get_area')
    			if(res.status==200){
    				this.areas = res.data
    			}else{
                     this.$Loading.error();
    				this.swr()

    			}
    	}

    	// async created(){
    	// 	const res = await this.callApi('post','/app/create_area', {areaName:'testdate'});
    		
    	// 	if(res.status==200){
    	// 		// console.log(res)
    	// 	}else{
    	// 		console.log(res)
    	// 		console.log('running')
    	// 	}
    	// }
    }

   
</script>
