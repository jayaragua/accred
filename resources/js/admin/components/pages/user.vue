<template>
	<div>
		<div class="content">
			<div class="container-fluid">
			   <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Users &nbsp; <Button @click="addModal=true"><Icon type="md-add" /> Add User</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>id</th>
								<th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
								<!-- <th>Created at</th> -->
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(user, i) in users" :key="i" v-if="users.length">
								<td>{{user.id}}</td>
								<td class="_table_name">{{user.name}}</td>
                                <td class="">{{user.email}}</td>
                                <td class="">{{user.userType}}</td>
								<!-- <td >{{user.created_at}}</td> -->
								<td>
									<Button type="info" size="small" @click="showEditModal(user, i)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(user, i)" :loading="user.isDeleting">Delete</Button>
								</td>
							</tr>

						</table>


					</div>
					<!-- add modal-->
					 <Modal
				        v-model="addModal"
				        title="Add User"
				        :mask-closable="false"
				        :closable="false"
				        >
                        <div class="space2">
                            <Input v-model="data.name" placeholder="Full Name"  />
                        </div>
                        <div class="space2">
                            <Input type="email" v-model="data.email" placeholder="Email"  />
                        </div>
                        <div class="space2">
                            <Input type="password" v-model="data.password" placeholder="Password"  />
                        </div>
                     
                        <div class="space2">
                            <Select v-model="data.userType"
                                placeholder="Select User">
                                <Option  value="Admin" >Admin</Option>
                                <Option value="User" >User</Option>
                            </Select>
                        </div>
				       


				        <div slot="footer">
				        	<Button type="default" @click="addModal=false">Close</Button>
				        	<Button type="primary" @click="addUser" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add User'}}</Button>
				        </div>
				    </Modal>



				    <!-- edit modal-->
					 <Modal
				        v-model="editModal"
				        title="edit User"
				        :mask-closable="false"
				        :closable="false"
				        >
				         <div class="space2">
                            <Input v-model="editData.name" placeholder="Full Name"  />
                        </div>
                        <div class="space2">
                            <Input type="email" v-model="editData.email" placeholder="Email"  />
                        </div>
                        <div class="space2">
                            <Input type="password" v-model="editData.password" placeholder="Password"  />
                        </div>
                     
                        <div class="space2">
                            <Select v-model="editData.userType"
                                placeholder="Select User">
                                <Option  value="Admin" >Admin</Option>
                                <Option value="User" >User</Option>
                            </Select>
                        </div>

                        

				        <div slot="footer">
				        	<Button type="default" @click="editModal=false">Close</Button>
				        	<Button type="primary" @click="editUser" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing...' : 'edit Area'}}</Button>
				        </div>
				    </Modal>

				    <!--delete modal-->
				     <Modal v-model="showDeleteModal" width="360">
				        <p slot="header" style="color:#f60;text-align:center">
				            <Icon type="ios-information-circle"></Icon>
				            <span>Delete confirmation</span>
				        </p>
				        <div style="text-align:center">
				            <p>Are you sure you want to delete User?</p>
				           
				        </div>
				        <div slot="footer">
				            <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteUser">Delete</Button>
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
    				name:'',
                    email:'',
                    password:'',
                    userType:'',
                    
    			},
    			addModal:false,
    			editModal:false,
    			isAdding:false,
                user_list: '',
                user_lists:[],

    			users: [],

    			editData:{
    				name:'',
                    email:'',
                    password:'',
                    userType:'',
    			},
    			index : -1,
    			isDeleting: false,
    			showDeleteModal : false,
    			deleteItem: {},
    			deletingIndex : -1,

    		}
    	},

    	methods:{
    		async addUser(){
    			if(this.data.name.trim()=='') return this.error('Fullname is required')
                if(this.data.email.trim()=='') return this.error('Email is required')
                if(this.data.password.trim()=='') return this.error('Password is required')
                if(this.data.userType.trim()=='') return this.error('User Type is required')
               
    				const res = await this.callApi('post', 'app/create_user', this.data)
    			if(res.status===201){
    				this.users.unshift(res.data)
    				this.success('User has been added successfully!')
    				this.addModal = false
    				this.data.name=''
                    this.data.email=''
                    this.data.password=''
                    this.data.userType=''
                    this.$Loading.finish();
    			}else{
    				if(res.status==422){
                        if(res.data.errors.name){
                            this.info(res.data.errors.name[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.email){
                            this.info(res.data.errors.email[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.password){
                            this.info(res.data.errors.password[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.userType){
                            this.info(res.data.errors.userType[0])
                            this.$Loading.error();
                        }
                    }else{
                        this.swr()
                    }
    			}
    		},

    		async editUser(){
    			if(this.editData.name.trim()=='') return this.error('Fullname is required')
                if(this.editData.email.trim()=='') return this.error('Email is required')
                // if(this.data.password.trim()=='') return this.error('Password is required')
                if(this.editData.userType.trim()=='') return this.error('User Type is required')
    				const res = await this.callApi('post', 'app/edit_user', this.editData)
    			if(res.status===200){
    				this.users[this.index].name = this.editData.name
                    this.users[this.index].email = this.editData.email
                    
                    this.users[this.index].userType = this.editData.userType

    				this.success('User has been edited successfully!')
    				this.editModal = false
                    this.$Loading.finish();
    			}else{
    				if(res.status==422){
                        if(res.data.errors.name){
                            this.info(res.data.errors.name[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.email){
                            this.info(res.data.errors.email[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.password){
                            this.info(res.data.errors.password[0])
                            this.$Loading.error();
                        }
                        if(res.data.errors.userType){
                            this.info(res.data.errors.userType[0])
                            this.$Loading.error();
                        }
                    }else{
                        this.swr()
                    }
    			}
    		},

    		showEditModal(user, index){
    			let obj = {
    				id : user.id,
                    name : user.name,
                    email : user.email,
                    password : user.password,
                    userType : user.userType,

    			}
    			this.editData=obj
    			this.editModal=true
    			this.index = index
    		},

    		async deleteUser(){
    			this.isDeleting= true
    			
    			// this.$set(area, 'isdeleting', true)
    			const res = await this.callApi('post', 'app/delete_User', this.deleteItem)
    			if(res.status===200){
    				this.users.splice(this.deletingIndex, 1)
                    this.$Loading.finish();
    				this.success('User has been deleted successfully!')
    			}else{
    				this.swr()
    			}
    			this.isDeleting= false
    			this.showDeleteModal = false
    			

    		},

    		 showDeletingModal(user, i){
    			this.deleteItem = user
    			this.deletingIndex = i
    			this.showDeleteModal = true
    		}

    		
    	
    	},


    	async created(){
    			const res = await this.callApi('get', 'app/get_user')
    			if(res.status==200){
    				this.users = res.data
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
